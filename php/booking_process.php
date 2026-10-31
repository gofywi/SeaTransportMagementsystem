<?php
require 'config.php';

$tripId = $_POST['trip_id'] ?? '';
$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');
$phone  = trim($_POST['phone'] ?? '');
$qty    = (int)($_POST['passengers'] ?? 1);

$trips = readJson(TRIPS_FILE);
$index = null;
foreach ($trips as $i => $t) {
    if ($t['id'] == $tripId) $index = $i;
}

if ($index === null || $name === '' || $email === '' || $qty < 1) {
    header('Location: ../views/booking.php?id=' . urlencode($tripId) . '&error=1');
    exit;
}
if ($qty > $trips[$index]['seats']) {
    header('Location: ../views/booking.php?id=' . urlencode($tripId) . '&error=seats');
    exit;
}

$trips[$index]['seats'] -= $qty;
writeJson(TRIPS_FILE, $trips);

$bookings = readJson(BOOKINGS_FILE);
$ref = 'FJ' . strtoupper(substr(uniqid(), -6));
$bookings[] = [
    'ref'        => $ref,
    'trip_id'    => $trips[$index]['id'],
    'name'       => $name,
    'email'      => $email,
    'phone'      => $phone,
    'passengers' => $qty,
    'total'      => $qty * $trips[$index]['price'],
    'booked_at'  => date('Y-m-d H:i'),
];
writeJson(BOOKINGS_FILE, $bookings);

header('Location: ../views/confirm.php?ref=' . $ref);
exit;
