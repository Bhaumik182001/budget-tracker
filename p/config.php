<?php
// Prevent direct access
// if (defined('CONFIG_LOADED')) {
//     header('HTTP/1.1 403 Forbidden');
//     exit('Direct config access not allowed');
// }
// define('CONFIG_LOADED', true);

// Session Configuration 
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 86400, // 1 day
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => isset($_SERVER['HTTPS']), // Auto-enable HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Database Connection 
$conn = new mysqli("localhost", "root", "", "finance_db");

// Enhanced Error Handling (recommended addition)
if ($conn->connect_error) {
    error_log("Database connection failed: ".$conn->connect_error);
    
    // User-friendly message while logging details
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION['error'] = "System temporarily unavailable";
    }
    
    // Show maintenance page if exists
    if (file_exists(__DIR__.'/maintenance.html')) {
        include __DIR__.'/maintenance.html';
    } else {
        die("System maintenance in progress. Please try again later.");
    }
    exit();
}

// UTF-8 Encoding
$conn->set_charset("utf8mb4");

// Timezone Configuration
date_default_timezone_set('Asia/Kolkata'); // Adjust to your timezone
?>