<?php
function require_auth() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header("Location: login.php");
        exit();
    }
}

function redirect_if_logged_in() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }
}
?>