<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/email_tracking.php';

function assert_same(mixed $expected, mixed $actual, string $message): void
{
    if ($expected !== $actual) {
        fwrite(STDERR, $message . "\nExpected: " . var_export($expected, true) . "\nActual: " . var_export($actual, true) . "\n");
        exit(1);
    }
}

$logPath = sys_get_temp_dir() . '/wgs-email-tracking-' . bin2hex(random_bytes(6)) . '.jsonl';
putenv('WGS_EMAIL_TRACKING_LOG=' . $logPath);

assert_same('campaign-wgs-123-a1b2c3d4', wgs_tracking_normalize_id(' Campaign-WGS-123-A1B2C3D4 '), 'Valid IDs normalize.');
assert_same('', wgs_tracking_normalize_id('../private'), 'Path-like IDs are rejected.');
assert_same('', wgs_tracking_normalize_id(str_repeat('a', 81)), 'Overlong IDs are rejected.');
assert_same('Gmail image proxy', wgs_tracking_client('GoogleImageProxy'), 'Gmail proxy is classified.');
assert_same('https://webgirl.studio/email-track/open.php?id=campaign-wgs-123-a1b2c3d4', wgs_tracking_pixel_url('campaign-wgs-123-a1b2c3d4'), 'Pixel URL is stable.');
assert_same(['liana', 'secret:with-colon'], wgs_tracking_basic_credentials(['HTTP_AUTHORIZATION' => 'Basic ' . base64_encode('liana:secret:with-colon')]), 'Forwarded Basic auth is parsed.');

$first = new DateTimeImmutable('2026-09-18T10:00:00+00:00');
$second = new DateTimeImmutable('2026-09-18T11:30:00+00:00');
assert_same(true, wgs_tracking_record_open('campaign-wgs-123-a1b2c3d4', $second, 'GoogleImageProxy'), 'First event writes.');
assert_same(true, wgs_tracking_record_open('campaign-wgs-123-a1b2c3d4', $first, 'Microsoft Outlook'), 'Second event writes.');

$events = wgs_tracking_read_events($logPath);
assert_same(2, count($events), 'Both events are read.');
$summary = wgs_tracking_summarize($events);
assert_same(1, count($summary), 'Events are grouped by recipient.');
assert_same(2, $summary[0]['open_count'], 'Open loads are counted.');
assert_same('2026-09-18T10:00:00+00:00', $summary[0]['first_opened_at_utc'], 'Earliest open is selected.');
assert_same('2026-09-18T11:30:00+00:00', $summary[0]['last_opened_at_utc'], 'Latest open is selected.');

@unlink($logPath);
putenv('WGS_EMAIL_TRACKING_LOG');
echo "email_tracking_test: OK\n";
