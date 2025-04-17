<?php
function require_auth() {
    // No session_start() here! Rely on config.php
    if (empty($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>