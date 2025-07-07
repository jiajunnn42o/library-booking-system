<?php
session_start();
require_once("../backend/db_connect.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user_id'];
$sql = "
  SELECT b.title, br.borrow_date, br.return_date, br.status 
  FROM borrow_records br
  JOIN books b ON br.book_id = b.id
  WHERE br.user_id = ?
  ORDER BY br.borrow_date DESC
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
      <th>Return Date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['title']); ?></td>
          <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
          <td>
            <?php echo $row['return_date'] ? htmlspecialchars($row['return_date']) : '-'; ?>
          </td>
          <td class="status">
            <?php
              $status = $row['status'];
              if ($status == 'borrowed') echo 'Borrowed';
              elseif ($status == 'returned') echo 'Returned';
              elseif ($status == 'overdue') echo 'Overdue';
              else echo htmlspecialchars($status);
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="4" style="padding: 15px; text-align: center;">You haven't reserved any books yet.</td>
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
