<?php
session_start();
require_once("../backend/db_connect.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user_id'];

$overdue_sql = "UPDATE borrow_records 
                SET status = 'overdue' 
                WHERE user_id = ? AND status = 'borrowed' AND due_date < CURDATE()";
$overdue_stmt = $conn->prepare($overdue_sql);
$overdue_stmt->bind_param("i", $user_id);
$overdue_stmt->execute();
$overdue_stmt->close();

$sql = "
  SELECT br.id, b.title, br.borrow_date, br.due_date, br.return_date, br.status 
  FROM borrow_records br
  JOIN books b ON br.book_id = b.id
  WHERE br.user_id = ?
  ORDER BY br.id ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['borrow_date']) ?></td>
              <td><?= $row['due_date'] ? htmlspecialchars($row['due_date']) : '-' ?></td>
              <td><?= $row['return_date'] ? htmlspecialchars($row['return_date']) : '-' ?></td>
              <td>
                <?php if ($row['status'] === 'borrowed'): ?>
                  <form action="../backend/return_book.php" method="POST">
                    <input type="hidden" name="borrow_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="return-btn">Return</button>
                  </form>
                <?php elseif ($row['status'] === 'overdue'): ?>
                  <span class="status-text" style="color: red; ">Overdue</span>
                <?php else: ?>
                  <span class="status-text"><?= htmlspecialchars($row['status']) ?></span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="padding: 15px; text-align: center;">You haven't reserved any books yet.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
