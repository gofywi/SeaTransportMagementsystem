<?php require '../php/config.php'; $trips = readJson(TRIPS_FILE); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fiji Sea Travel - Home</title>
<style>
    body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
    header { background: #1e5a8a; color: #fff; padding: 15px 20px; }
    header a { color: #fff; float: right; text-decoration: none; }
    .container { width: 90%; max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #eee; }
    .btn { background: #1e5a8a; color: #fff; padding: 5px 10px; text-decoration: none; }
</style>
</head>
<body>
<header>
    <a href="<?= isAdmin() ? 'admin.php' : 'login.php' ?>"><?= isAdmin() ? 'Admin Console' : 'Admin Login' ?></a>
    <strong>Fiji Sea Travel Management System</strong>
</header>
<div class="container">
    <h2>Fiji Inter-Island Ferries &amp; Routes</h2>
    <?php if (!$trips): ?>
        <p>No trips available.</p>
    <?php else: ?>
    <table>
        <tr><th>Boat</th><th>From</th><th>To</th><th>Date</th><th>Time</th><th>Price</th><th>Seats</th><th></th></tr>
        <?php foreach ($trips as $t): ?>
        <tr>
            <td><?= e($t['boat']) ?></td>
            <td><?= e($t['from']) ?></td>
            <td><?= e($t['to']) ?></td>
            <td><?= e($t['date']) ?></td>
            <td><?= e($t['time']) ?></td>
            <td>FJ$<?= e($t['price']) ?></td>
            <td><?= e($t['seats']) ?></td>
            <td>
                <?php if ($t['seats'] > 0): ?>
                    <a class="btn" href="booking.php?id=<?= $t['id'] ?>">Book</a>
                <?php else: ?>Full<?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
</body>
</html>
