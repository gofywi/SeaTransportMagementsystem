<?php
require 'config.php';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
    $_SESSION['admin'] = true;
    header('Location: ../views/admin.php');
} else {
    header('Location: ../views/login.php?error=1');
}
exit;
