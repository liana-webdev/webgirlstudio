<?php
declare(strict_types=1);

function wgs_tracking_normalize_id(mixed $value): string
{
    $id = strtolower(trim((string) $value));
    return preg_match('/^[a-z0-9][a-z0-9_-]{2,79}$/', $id) === 1 ? $id : '';
}

function wgs_tracking_log_path(): string
{
    $configured = trim((string) getenv('WGS_EMAIL_TRACKING_LOG'));
    return $configured !== '' ? $configured : dirname(__DIR__) . '/storage/email-opens.jsonl';
}

function wgs_tracking_client(string $userAgent): string
{
    $agent = strtolower($userAgent);
    if ($agent === '') return 'Unknown';
    if (str_contains($agent, 'googleimageproxy')) return 'Gmail image proxy';
    if (str_contains($agent, 'outlook') || str_contains($agent, 'microsoft office')) return 'Outlook';
    if (str_contains($agent, 'thunderbird')) return 'Thunderbird';
    if (str_contains($agent, 'applewebkit')) return 'Apple/WebKit';
    return 'Other';
}

function wgs_tracking_record_open(
    string $recipientId,
    ?DateTimeImmutable $openedAt = null,
    string $userAgent = ''
): bool {
    $id = wgs_tracking_normalize_id($recipientId);
    if ($id === '') return false;

    $path = wgs_tracking_log_path();
    $directory = dirname($path);
    if (!is_dir($directory) || !is_writable($directory)) return false;

    $event = [
        'recipient_id' => $id,
        'opened_at_utc' => ($openedAt ?? new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->setTimezone(new DateTimeZone('UTC'))
            ->format(DateTimeInterface::ATOM),
        'client' => wgs_tracking_client($userAgent),
    ];
    $line = json_encode($event, JSON_UNESCAPED_SLASHES);
    if (!is_string($line)) return false;

    $handle = @fopen($path, 'ab');
    if ($handle === false || !flock($handle, LOCK_EX)) {
        if (is_resource($handle)) fclose($handle);
        return false;
    }

    $written = fwrite($handle, $line . "\n");
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
    return $written !== false;
}

function wgs_tracking_read_events(?string $path = null): array
{
    $logPath = $path ?? wgs_tracking_log_path();
    if (!is_file($logPath) || !is_readable($logPath)) return [];

    $events = [];
    $handle = @fopen($logPath, 'rb');
    if ($handle === false) return [];

    while (($line = fgets($handle)) !== false) {
        $event = json_decode($line, true);
        if (!is_array($event)) continue;
        $id = wgs_tracking_normalize_id($event['recipient_id'] ?? '');
        $openedAt = (string) ($event['opened_at_utc'] ?? '');
        if ($id === '' || strtotime($openedAt) === false) continue;
        $events[] = [
            'recipient_id' => $id,
            'opened_at_utc' => $openedAt,
            'client' => wgs_tracking_client_name($event['client'] ?? ''),
        ];
    }
    fclose($handle);
    return $events;
}

function wgs_tracking_client_name(mixed $value): string
{
    $client = trim((string) $value);
    $allowed = ['Unknown', 'Gmail image proxy', 'Outlook', 'Thunderbird', 'Apple/WebKit', 'Other'];
    return in_array($client, $allowed, true) ? $client : 'Unknown';
}

function wgs_tracking_summarize(array $events): array
{
    $summary = [];
    foreach ($events as $event) {
        $id = wgs_tracking_normalize_id($event['recipient_id'] ?? '');
        $openedAt = (string) ($event['opened_at_utc'] ?? '');
        if ($id === '' || strtotime($openedAt) === false) continue;
        if (!isset($summary[$id])) {
            $summary[$id] = [
                'recipient_id' => $id,
                'open_count' => 0,
                'first_opened_at_utc' => $openedAt,
                'last_opened_at_utc' => $openedAt,
                'clients' => [],
            ];
        }
        $summary[$id]['open_count']++;
        if (strtotime($openedAt) < strtotime($summary[$id]['first_opened_at_utc'])) {
            $summary[$id]['first_opened_at_utc'] = $openedAt;
        }
        if (strtotime($openedAt) > strtotime($summary[$id]['last_opened_at_utc'])) {
            $summary[$id]['last_opened_at_utc'] = $openedAt;
        }
        $client = wgs_tracking_client_name($event['client'] ?? '');
        $summary[$id]['clients'][$client] = true;
    }

    foreach ($summary as &$row) {
        $row['clients'] = implode(', ', array_keys($row['clients']));
    }
    unset($row);
    usort($summary, static fn(array $a, array $b): int =>
        strcmp($b['last_opened_at_utc'], $a['last_opened_at_utc'])
    );
    return $summary;
}

function wgs_tracking_pixel_url(string $recipientId, string $baseUrl = 'https://webgirl.studio'): string
{
    $id = wgs_tracking_normalize_id($recipientId);
    if ($id === '') return '';
    return rtrim($baseUrl, '/') . '/email-track/open.php?id=' . rawurlencode($id);
}

function wgs_tracking_basic_credentials(array $server): array
{
    $user = (string) ($server['PHP_AUTH_USER'] ?? '');
    $password = (string) ($server['PHP_AUTH_PW'] ?? '');
    if ($user !== '' || $password !== '') return [$user, $password];

    $authorization = (string) ($server['HTTP_AUTHORIZATION'] ?? $server['REDIRECT_HTTP_AUTHORIZATION'] ?? '');
    if (preg_match('/^Basic\s+([A-Za-z0-9+\/=]+)$/i', trim($authorization), $matches) !== 1) {
        return ['', ''];
    }
    $decoded = base64_decode($matches[1], true);
    if (!is_string($decoded) || !str_contains($decoded, ':')) return ['', ''];
    return explode(':', $decoded, 2);
}
