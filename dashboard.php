<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
$user_id = $_SESSION['user_id'];
$filter = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['type'])) {
        $filter .= " AND type='" . $_GET['type'] . "'";
    }
    if (!empty($_GET['category'])) {
        $filter .= " AND category='" . $_GET['category'] . "'";
    }
}

$transactions = $conn->query("SELECT * FROM transactions WHERE user_id=$user_id $filter ORDER BY created_at DESC");

$chart_query = $conn->query("SELECT category, SUM(amount) as total FROM transactions WHERE user_id=$user_id AND type='expense' GROUP BY category");
$chart_data = ["labels" => [], "data" => []];
while ($row = $chart_query->fetch_assoc()) {
    $chart_data["labels"][] = $row["category"];
    $chart_data["data"][] = $row["total"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/charts.js" defer></script>
    <script src="assets/export.js" defer></script>
</head>
<body class="bg-gray-100 p-4">
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
    <a href="logout.php" class="text-red-500">Logout</a>

    <form method="GET" class="mb-4 flex gap-2">
        <select name="type" class="p-2 border rounded">
            <option value="">All Types</option>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>
        <input type="text" name="category" placeholder="Category" class="p-2 border rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        <button type="button" onclick="exportTableToCSV('transactions.csv')" class="bg-green-500 text-white px-4 py-2 rounded">Export CSV</button>
    </form>

    <canvas id="expenseChart" class="mb-6 max-w-xl"></canvas>
    <script type="application/json" id="chartData"><?= json_encode($chart_data) ?></script>

    <table class="table-auto w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Amount (₹)</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $transactions->fetch_assoc()): ?>
            <tr>
                <td class="border px-4 py-2"><?= $row['type'] ?></td>
                <td class="border px-4 py-2"><?= $row['category'] ?></td>
                <td class="border px-4 py-2"><?= $row['amount'] ?></td>
                <td class="border px-4 py-2"><?= $row['description'] ?></td>
                <td class="border px-4 py-2"><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>