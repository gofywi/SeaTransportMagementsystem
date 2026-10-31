<?php
require 'config.php';
session_destroy();
header('Location: ../views/home.php');
exit;
