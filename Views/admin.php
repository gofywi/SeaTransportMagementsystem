<?php
require '../php/config.php';
requireAdmin();
$trips = readJson(TRIPS_FILE);
$bookings = readJson(BOOKINGS_FILE);
$edit = isset($_GET['edit']) ? findTrip($_GET['edit']) : null;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fiji Sea Travel - Admin Console</title>
<style>
    body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
    header { background: #1e5a8a; color: #fff; padding: 15px 20px; }
    header a { color: #fff; margin-left: 15px; text-decoration: none; float: right; }
    .container { width: 90%; max-width: 950px; margin: 20px auto; background: #fff; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    th { background: #eee; }
    form label { display: inline-block; width: 120px; }
    form input { padding: 5px; margin: 4px 0; width: 220px; }
    button { padding: 6px 14px; background: #1e5a8a; color: #fff; border: none; cursor: pointer; }
    .msg { background: #dff0d8; padding: 8px; }
</style>
</head>
<body>
<header>
    <a href="../php/logout.php">Logout</a>
    <a href="home.php">Home</a>
    <strong>Admin Console</strong>
</header>
<div class="container">
    <?php if (isset($_GET['msg'])): ?><p class="msg">Trip <?= e($_GET['msg']) ?> successfully.</p><?php endif; ?>

    <h2><?= $edit ? 'Edit Trip #' . $edit['id'] : 'Add New Trip' ?></h2>
    <form method="post" action="../php/trip_save.php">
        <input type="hidden" name="id" value="<?= e($edit['id'] ?? '') ?>">
        <label>Boat Name</label><input type="text" name="boat" value="<?= e($edit['boat'] ?? '') ?>" required><br>
        <label>From</label><input type="text" name="from" value="<?= e($edit['from'] ?? '') ?>" required><br>
        <label>To</label><input type="text" name="to" value="<?= e($edit['to'] ?? '') ?>" required><br>
        <label>Date</label><input type="date" name="date" value="<?= e($edit['date'] ?? '') ?>" required><br>
        <label>Time</label><input type="time" name="time" value="<?= e($edit['time'] ?? '') ?>" required><br>
        <label>Price (FJ$)</label><input type="number" step="0.01" min="0" name="price" value="<?= e($edit['price'] ?? '') ?>" required><br>
        <label>Seats</label><input type="number" min="0" name="seats" value="<?= e($edit['seats'] ?? '') ?>" required><br><br>
        <button type="submit"><?= $edit ? 'Update Trip' : 'Add Trip' ?></button>
        <?php if ($edit): ?><a href="admin.php">Cancel</a><?php endif; ?>
    </form>

    <h2>All Trips</h2>
    <table>
        <tr><th>ID</th><th>Boat</th><th>From</th><th>To</th><th>Date</th><th>Time</th><th>Price</th><th>Seats</th><th>Action</th></tr>
        <?php foreach ($trips as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= e($t['boat']) ?></td>
            <td><?= e($t['from']) ?></td>
            <td><?= e($t['to']) ?></td>
            <td><?= e($t['date']) ?></td>
            <td><?= e($t['time']) ?></td>
            <td>FJ$<?= e($t['price']) ?></td>
            <td><?= e($t['seats']) ?></td>
            <td>
                <a href="admin.php?edit=<?= $t['id'] ?>">Edit</a> |
                <a href="../php/trip_delete.php?id=<?= $t['id'] ?>" onclick="return confirm('Delete this trip?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Bookings</h2>
    <table>
        <tr><th>Ref</th><th>Trip ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Passengers</th><th>Total</th><th>Booked At</th></tr>
        <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= e($b['ref']) ?></td>
            <td><?= e($b['trip_id']) ?></td>
            <td><?= e($b['name']) ?></td>
            <td><?= e($b['email']) ?></td>
            <td><?= e($b['phone']) ?></td>
            <td><?= e($b['passengers']) ?></td>
            <td>FJ$<?= e($b['total']) ?></td>
            <td><?= e($b['booked_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
