<?php
require 'config.php';
requireAdmin();

$trips = readJson(TRIPS_FILE);
$id = $_POST['id'] ?? '';

$trip = [
    'id'        => $id !== '' ? (int)$id : (count($trips) ? max(array_column($trips, 'id')) + 1 : 1),
    'boat'      => trim($_POST['boat'] ?? ''),
    'from'      => trim($_POST['from'] ?? ''),
    'to'        => trim($_POST['to'] ?? ''),
    'date'      => $_POST['date'] ?? '',
    'time'      => $_POST['time'] ?? '',
    'price'     => (float)($_POST['price'] ?? 0),
    'seats'     => (int)($_POST['seats'] ?? 0),
];

if ($id !== '') {
    foreach ($trips as $i => $t) {
        if ($t['id'] == $id) $trips[$i] = $trip;
    }
} else {
    $trips[] = $trip;
}

writeJson(TRIPS_FILE, $trips);
header('Location: ../views/admin.php?msg=saved');
exit;
