<?php
require 'config.php';
requireAdmin();

$id = $_GET['id'] ?? '';
$trips = array_filter(readJson(TRIPS_FILE), fn($t) => $t['id'] != $id);
writeJson(TRIPS_FILE, $trips);

header('Location: ../views/admin.php?msg=deleted');
exit;
