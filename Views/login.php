<?php require '../php/config.php'; if (isAdmin()) { header('Location: admin.php'); exit; } ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Fiji Sea Travel - Admin Login</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .box { width: 300px; margin: 80px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
    input { width: 100%; padding: 8px; margin: 5px 0 12px; box-sizing: border-box; }
    button { width: 100%; padding: 8px; background: #1e5a8a; color: #fff; border: none; cursor: pointer; }
    .error { color: red; }
</style>
</head>
<body>
<div class="box">
    <h2>Admin Login</h2>
    <?php if (isset($_GET['error'])): ?><p class="error">Invalid username or password.</p><?php endif; ?>
    <form method="post" action="../php/login_process.php">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p><a href="home.php">Back to Home</a></p>
</div>
</body>
</html>
