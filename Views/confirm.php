<?php
require '../php/config.php';
$booking = null;
foreach (readJson(BOOKINGS_FILE) as $b) {
    if ($b['ref'] === ($_GET['ref'] ?? '')) $booking = $b;
}
if (!$booking) { header('Location: home.php'); exit; }
$trip = findTrip($booking['trip_id']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fiji Sea Travel - Booking Confirmed</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .box { width: 420px; margin: 40px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
    h2 { color: green; }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 6px; border-bottom: 1px solid #eee; }
    td:first-child { font-weight: bold; width: 40%; }
</style>
</head>
<body>
<div class="box">
    <h2>Booking Confirmed!</h2>
    <p>Thank you, <?= e($booking['name']) ?>. Your booking details are below.</p>
    <table>
        <tr><td>Reference</td><td><?= e($booking['ref']) ?></td></tr>
        <?php if ($trip): ?>
        <tr><td>Boat</td><td><?= e($trip['boat']) ?></td></tr>
        <tr><td>Route</td><td><?= e($trip['from']) ?> &rarr; <?= e($trip['to']) ?></td></tr>
        <tr><td>Date / Time</td><td><?= e($trip['date']) ?> <?= e($trip['time']) ?></td></tr>
        <?php endif; ?>
        <tr><td>Email</td><td><?= e($booking['email']) ?></td></tr>
        <tr><td>Phone</td><td><?= e($booking['phone']) ?></td></tr>
        <tr><td>Passengers</td><td><?= e($booking['passengers']) ?></td></tr>
        <tr><td>Total Paid</td><td>FJ$<?= e($booking['total']) ?></td></tr>
    </table>
    <p><a href="home.php">&larr; Back to Home</a></p>
</div>
</body>
</html>
