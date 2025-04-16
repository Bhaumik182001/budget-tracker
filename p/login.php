<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
        }
    } else {
        echo "Invalid Credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<form method="POST" class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <input name="email" type="email" placeholder="Email" required class="block w-full mb-3 p-2 border">
    <input name="password" type="password" placeholder="Password" required class="block w-full mb-3 p-2 border">
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Login</button>
</form>
</body>
</html>