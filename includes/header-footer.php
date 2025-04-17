<?php
// ==================== HEADER SECTION ====================
function render_header($title = 'Budget Tracker') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($title); ?></title>
  <link href="/assets/styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00ff9d;
      --secondary: #00b8ff;
      --text: #e0e0e0;
    }
  </style>
</head>
<body>
  <header class="terminal-header">
    <a href="/dashboard.php" class="logo">budget_tracker</a>
    <nav>
      <a href="/dashboard.php">dashboard</a>
      <a href="/logout.php">logout</a>
    </nav>
  </header>
  <main class="container">

<?php
}

// ==================== FOOTER SECTION ====================
function render_footer() {
?>
  </main>
  <footer class="terminal-footer">
    <p>budget_tracker v1.0 | © <?php echo date('Y'); ?></p>
  </footer>
</body>
</html>
<?php
}
?>