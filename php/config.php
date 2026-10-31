<?php
session_start();

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin123');

define('TRIPS_FILE', __DIR__ . '/../data/trips.json');
define('BOOKINGS_FILE', __DIR__ . '/../data/bookings.json');

function readJson($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function writeJson($file, $data) {
    if (!is_dir(dirname($file))) mkdir(dirname($file), 0777, true);
    file_put_contents($file, json_encode(array_values($data), JSON_PRETTY_PRINT));
}

function findTrip($id) {
    foreach (readJson(TRIPS_FILE) as $t) {
        if ($t['id'] == $id) return $t;
    }
    return null;
}

function isAdmin() {
    return !empty($_SESSION['admin']);
}

function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../views/login.php');
        exit;
    }
}

function e($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES);
}
