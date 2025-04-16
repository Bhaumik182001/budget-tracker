<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<form method="POST" class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4">Sign Up</h2>
    <input name="name" placeholder="Name" required class="block w-full mb-3 p-2 border">
    <input name="email" type="email" placeholder="Email" required class="block w-full mb-3 p-2 border">
    <input name="password" type="password" placeholder="Password" required class="block w-full mb-3 p-2 border">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
</form>
</body>
</html>