<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
</head>
<body>
  <div class="dashboard-container">
    <!-- Left: Background image -->
    <div class="dashboard-left"></div>

    <!-- Right: Admin Panel -->
    <div class="dashboard-right">
      <img src="school-logo.png" alt="School Logo" class="logo" />
      <h2 class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> (Admin)</h2>
      <h3 class="section-title">Administrator Panel</h3>

      <!-- Manage Books -->
      <div class="option-card">
        <img src="icons/books.jpg" class="card-img" alt="Manage Books" />
        <div class="card-text">
          <h4>Manage Books</h4>
          <p>Add, edit, or remove books from the system.</p>
        </div>
        <a class="select-btn" href="manage_books.php">Select</a>
      </div>

      <!-- View All Reservations -->
      <div class="option-card">
        <img src="icons/history.jpg" class="card-img" alt="Reservations" />
        <div class="card-text">
          <h4>View All Reservations</h4>
          <p>See who borrowed what and manage returns.</p>
        </div>
        <a class="select-btn" href="view_reservations.php">Select</a>
      </div>

      <!-- Logout -->
      <div class="option-card">
        <img src="icons/logout.jpg" class="card-img" alt="Logout" />
        <div class="card-text">
          <h4>Logout</h4>
          <p>Sign out of the admin session.</p>
        </div>
        <a class="select-btn" href="../backend/logout.php">Logout</a>
      </div>
    </div>
  </div>
</body>
</html>
