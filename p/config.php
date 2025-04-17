<?php
session_set_cookie_params([
    'lifetime' => 86400, // 1 day
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,     // Enable in production (HTTPS)
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finance_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>