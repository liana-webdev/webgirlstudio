<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/email_tracking.php';

header('Cache-Control: no-store');
header('X-Robots-Tag: noindex, noarchive, nosnippet');
header("Content-Security-Policy: default-src 'none'; style-src 'unsafe-inline'; form-action 'self'; base-uri 'none'; frame-ancestors 'none'");
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');

$expectedUser = trim((string) getenv('WGS_EMAIL_TRACKING_USER'));
$expectedPassword = (string) getenv('WGS_EMAIL_TRACKING_PASSWORD');
if ($expectedUser === '' || $expectedPassword === '') {
    http_response_code(503);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Email tracking dashboard is not configured.\n";
    exit;
}

[$providedUser, $providedPassword] = wgs_tracking_basic_credentials($_SERVER);
if (!hash_equals($expectedUser, $providedUser) || !hash_equals($expectedPassword, $providedPassword)) {
    http_response_code(401);
    header('WWW-Authenticate: Basic realm="WGS email tracking", charset="UTF-8"');
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Authentication required.\n";
    exit;
}

$rows = wgs_tracking_summarize(wgs_tracking_read_events());
$escape = static fn(mixed $value): string => htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow,noarchive">
  <title>Email opens | Web Girl Studio</title>
  <style>
    :root { color-scheme: light; font-family: system-ui, sans-serif; }
    body { margin: 0; padding: 2rem; color: #171717; background: #f5f2ee; }
    main { max-width: 72rem; margin: 0 auto; }
    h1 { margin-bottom: .35rem; }
    .note { max-width: 52rem; color: #595959; }
    .table-wrap { overflow-x: auto; margin-top: 1.5rem; background: #fff; border: 1px solid #d8d2cb; border-radius: .75rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: .8rem 1rem; text-align: left; border-bottom: 1px solid #e5e0da; white-space: nowrap; }
    th { font-size: .8rem; text-transform: uppercase; letter-spacing: .04em; }
    tbody tr:last-child td { border-bottom: 0; }
    .empty { padding: 1rem; background: #fff; border: 1px solid #d8d2cb; border-radius: .75rem; }
  </style>
</head>
<body>
<main>
  <h1>Email opens</h1>
  <p class="note">Times are UTC. Match each recipient ID to the lead ID in the CRM. Image blocking, privacy proxies, forwarding, and security scanners mean these are signals, not exact human-read receipts.</p>
<?php if ($rows === []): ?>
  <p class="empty">No tracked opens yet.</p>
<?php else: ?>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th scope="col">Recipient ID</th><th scope="col">First open</th><th scope="col">Latest open</th><th scope="col">Loads</th><th scope="col">Client signal</th></tr>
      </thead>
      <tbody>
<?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $escape($row['recipient_id']) ?></td>
          <td><time datetime="<?= $escape($row['first_opened_at_utc']) ?>"><?= $escape($row['first_opened_at_utc']) ?></time></td>
          <td><time datetime="<?= $escape($row['last_opened_at_utc']) ?>"><?= $escape($row['last_opened_at_utc']) ?></time></td>
          <td><?= $escape($row['open_count']) ?></td>
          <td><?= $escape($row['clients']) ?></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
</main>
</body>
</html>
