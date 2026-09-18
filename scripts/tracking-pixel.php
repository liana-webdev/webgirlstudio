<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/email_tracking.php';

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$leadId = strtolower(trim((string) ($argv[1] ?? '')));
$campaign = strtolower(trim((string) ($argv[2] ?? gmdate('Ym'))));
$campaign = trim((string) preg_replace('/[^a-z0-9]+/', '-', $campaign), '-');

if (preg_match('/^wgs-\d{3,6}$/', $leadId) !== 1 || $campaign === '' || strlen($campaign) > 32) {
    fwrite(STDERR, "Usage: php scripts/tracking-pixel.php wgs-123 [campaign]\n");
    exit(1);
}

$recipientId = $campaign . '-' . $leadId . '-' . bin2hex(random_bytes(4));
$url = wgs_tracking_pixel_url($recipientId);
$html = '<img src="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" width="1" height="1" alt="" style="display:block;width:1px;height:1px;border:0;opacity:0">';

echo "Recipient ID: " . $recipientId . "\n";
echo "Pixel URL: " . $url . "\n";
echo "HTML: " . $html . "\n";
