<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Print array in JSON format
echo json_encode($_SESSION['username']);
?>
