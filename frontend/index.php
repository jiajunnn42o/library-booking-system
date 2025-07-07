<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Library Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
</head>
<body>
  <div class="dashboard-container">
    <!-- Left: Background image -->
    <div class="dashboard-left"></div>

    <!-- Right: Functional area -->
    <div class="dashboard-right">
      <img src="school-logo.png" alt="School Logo" class="logo" />
      <h2 class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>

      <h3 class="section-title">Choose an option</h3>

      <div class="option-card">
        <img src="icons/books.jpg" class="card-img" alt="Books" />
        <div class="card-text">
          <h4>View Available Books</h4>
          <p>Browse and borrow books from our library.</p>
        </div>
        <a class="select-btn" href="book_list.php">Select</a>
      </div>

      <div class="option-card">
        <img src="icons/history.jpg" class="card-img" alt="History" />
        <div class="card-text">
          <h4>View Borrowing History</h4>
          <p>See your past and current borrowings.</p>
        </div>
        <a class="select-btn" href="my_bookings.php">Select</a>
      </div>

      <div class="option-card">
        <img src="icons/logout.jpg" class="card-img" alt="Logout" />
        <div class="card-text">
          <h4>Logout</h4>
          <p>End session and return to login page.</p>
        </div>
        <a class="select-btn" href="../backend/logout.php">Select</a>
      </div>
    </div>
  </div>
</body>
</html>
