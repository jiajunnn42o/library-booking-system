<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/BorrowRecord.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$db = new Database();
$conn = $db->getConnection();
$record = new BorrowRecord($conn);

$user_id = $_SESSION['user_id'];

$record->updateOverdueStatus($user_id);

$records = $record->getUserRecords($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Borrowing History</title>
  <link rel="stylesheet" href="book_list.css" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
</head>

<?php if (isset($_GET['returned']) && $_GET['returned'] === 'success'): ?>
  <div class="toast toast-success">Book returned successfully!</div>
  <script>
    setTimeout(() => {
      document.querySelector('.toast').style.display = 'none';
    }, 3000);
  </script>
<?php endif; ?>

<body>
  <div class="book-page">
    <div class="page-header">
      <div class="header-left">
        <img src="school-logo.png" alt="School Logo" class="header-logo">
      </div>
      <div class="header-center">
        <h2 class="page-title">BORROWING HISTORY</h2>
      </div>
      <div class="header-right">
        <a href="index.php" class="back-btn">Back to Home</a>
      </div>
    </div>

    <table class="borrowing-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Borrow Date</th>
          <th>Due Date</th>
          <th>Return Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
            <?php if (!empty($records)): ?>
              <?php foreach ($records as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['borrow_date']) ?></td>
              <td><?= $row['due_date'] ? htmlspecialchars($row['due_date']) : '-' ?></td>
              <td><?= $row['return_date'] ? htmlspecialchars($row['return_date']) : '-' ?></td>
              <td>
              <?php
              $status = $row['status'];
              $returned = !empty($row['return_date']);
              $due_passed = (!empty($row['due_date']) && $row['due_date'] < date('Y-m-d'));
              ?>

              <?php if (($status === 'borrowed' || $status === 'overdue') && !$returned): ?>
              <form action="../backend/return_book.php" method="POST">
                <input type="hidden" name="borrow_id" value="<?= $row['id'] ?>">
                <button type="submit" class="return-btn">Return</button>
              </form>
            <?php elseif ($status === 'returned' && $due_passed): ?>
              <span class="status-text" style="color: red;">Overdue</span>
            <?php else: ?>
              <span class="status-text"><?= ucfirst($status) ?></span>
            <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="padding: 15px; text-align: center;">You haven't reserved any books yet.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px; color: #666;">
    Please contact the library at 
    <a href="mailto:library@raffles-university.edu.my" style="color: darkred">library@raffles-university.edu.my</a> 
    if you have overdue books that have not been returned.
</div>

  </div>
</body>
</html>

<?php
$conn->close();
?>
