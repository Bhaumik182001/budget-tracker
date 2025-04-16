<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finance_db";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query("CREATE DATABASE IF NOT EXISTS $dbname") === TRUE) {
    echo "✅ Database '$dbname' ready.<br>";
} else {
    die("❌ Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

$users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($users);

$transactions = "CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('income', 'expense'),
    category VARCHAR(100),
    amount DECIMAL(10,2),
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$conn->query($transactions);

$budgets = "CREATE TABLE IF NOT EXISTS budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category VARCHAR(100),
    amount DECIMAL(10,2),
    month INT,
    year INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$conn->query($budgets);

$conn->close();
?>