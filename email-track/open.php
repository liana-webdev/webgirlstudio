<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/email_tracking.php';

header('Content-Type: image/gif');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('X-Robots-Tag: noindex, noarchive, nosnippet');

$recipientId = wgs_tracking_normalize_id($_GET['id'] ?? '');
if ($recipientId !== '') {
    wgs_tracking_record_open($recipientId, null, (string) ($_SERVER['HTTP_USER_AGENT'] ?? ''));
}

$pixel = base64_decode('R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=', true);
if (is_string($pixel)) {
    header('Content-Length: ' . strlen($pixel));
    echo $pixel;
}
