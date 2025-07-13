<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/BorrowRecord.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.html");
  exit();
}

$db = new Database();
$conn = $db->getConnection();
$record = new BorrowRecord($conn);

$record->updateAllOverdueStatus();

$records = $record->getAllRecords();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Reservations</title>
  <link rel="stylesheet" href="book_list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
  <style>
    .status-overdue {
      color: red;
    }
  </style>
</head>
<body>
  <div class="book-page">
    <div class="page-header">
      <div class="header-left">
        <img src="school-logo.png" alt="School Logo" class="header-logo">
      </div>
      <div class="header-center">
        <h2 class="page-title">ALL RESERVATIONS</h2>
      </div>
      <div class="header-right">
        <a href="admin_dashboard.php" class="back-btn">Back to Admin</a>
      </div>
    </div>

    <table class="borrowing-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Email</th>
          <th>Book Title</th>
          <th>Author</th>
          <th>Borrow Date</th>
          <th>Due Date</th>
          <th>Return Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($records as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['user_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['book_title']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= htmlspecialchars($row['borrow_date']) ?></td>
            <td><?= $row['due_date'] ?? '-' ?></td>
            <td><?= $row['return_date'] ?? '-' ?></td>
            <td>
            <?php
              $status = $row['status'];
              $due_date = $row['due_date'];
              $return_date = $row['return_date'];
              $isLateReturn = $status === 'returned' && !empty($due_date) && !empty($return_date) && $return_date > $due_date;
            ?>

            <?php if ($status === 'overdue'): ?>
              <span class="status-overdue">Overdue</span>
            <?php elseif ($isLateReturn): ?>
              <span style="color: orange;">Returned (Late)</span>
            <?php else: ?>
              <span class="status-text"><?= ucfirst($status) ?></span>
            <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>