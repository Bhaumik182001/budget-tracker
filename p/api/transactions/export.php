<?php
require_once __DIR__ . '/../../includes/config.php';
require_auth();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="transactions.csv"');

$output = fopen('php://output', 'w');

// Write CSV headers
fputcsv($output, [
    'ID', 
    'Type', 
    'Category', 
    'Amount', 
    'Description',
    'Date',
    'Recurring'
]);

// Fetch data
$result = $conn->query("
    SELECT id, type, category, amount, description, 
           DATE(created_at) as date, 
           IF(is_recurring, 'Yes', 'No') as recurring
    FROM transactions
    WHERE user_id = " . intval($_SESSION['user_id']) . "
    ORDER BY created_at DESC
");

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>