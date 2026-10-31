<?php
require '../php/config.php';
$trip = findTrip($_GET['id'] ?? '');
if (!$trip) { header('Location: home.php'); exit; }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fiji Sea Travel - Book Trip</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .box { width: 420px; margin: 40px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
    input { width: 100%; padding: 8px; margin: 5px 0 12px; box-sizing: border-box; }
    button { width: 100%; padding: 8px; background: #1e5a8a; color: #fff; border: none; cursor: pointer; }
    .error { color: red; }
    .trip { background: #eef4f9; padding: 10px; margin-bottom: 15px; }
</style>
</head>
<body>
<div class="box">
    <h2>Book Your Trip</h2>
    <div class="trip">
        <strong><?= e($trip['boat']) ?></strong><br>
        <?= e($trip['from']) ?> &rarr; <?= e($trip['to']) ?><br>
        <?= e($trip['date']) ?> at <?= e($trip['time']) ?><br>
        Price: FJ$<?= e($trip['price']) ?> per person | Seats left: <?= e($trip['seats']) ?>
    </div>

    <?php if (($_GET['error'] ?? '') === 'seats'): ?>
        <p class="error">Not enough seats available.</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p class="error">Please fill in all required fields.</p>
    <?php endif; ?>

    <form method="post" action="../php/booking_process.php">
        <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
        <label>Full Name *</label>
        <input type="text" name="name" required>
        <label>Email *</label>
        <input type="email" name="email" required>
        <label>Phone</label>
        <input type="text" name="phone">
        <label>Number of Passengers *</label>
        <input type="number" name="passengers" min="1" max="<?= $trip['seats'] ?>" value="1" required>
        <button type="submit">Confirm Booking</button>
    </form>
    <p><a href="home.php">Back to Home</a></p>
</div>
</body>
</html>
