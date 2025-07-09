<?php
session_start();
require_once("../backend/db_connect.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$books_by_subject = [];
$result = $conn->query("SELECT * FROM books ORDER BY subject, title");
while ($row = $result->fetch_assoc()) {
  $books_by_subject[$row['subject']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book List</title>
  <link rel="stylesheet" href="book_list.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
</head>
<body>
  <div class="book-page">
    <div class="page-header">
      <div class="header-left">
        <img src="school-logo.png" alt="School Logo" class="header-logo">
      </div>
      <div class="header-center">
        <h2 class="page-title">AVAILABLE BOOKS</h2>
      </div>
      <div class="header-right">
        <a href="index.php" class="back-btn">Back to Home</a>
      </div>
    </div>

    <?php if (isset($_GET['reserved']) && $_GET['reserved'] === 'success'): ?>
      <div class="toast toast-success">Book reserved successfully!</div>
      <script>
        setTimeout(() => {
          document.querySelector('.toast').style.display = 'none';
        }, 3000);
      </script>
    <?php elseif (isset($_GET['reserved']) && $_GET['reserved'] === 'exists'): ?>
      <div class="toast toast-error">You’ve already reserved this book.</div>
      <script>
        setTimeout(() => {
          document.querySelector('.toast').style.display = 'none';
        }, 3000);
      </script>
    <?php endif; ?>

    <?php foreach ($books_by_subject as $subject => $books): ?>
      <div class="subject-section">
        <h3><?= htmlspecialchars($subject) ?></h3>
        <div class="book-row">
          <?php foreach ($books as $book): ?>
            <div class="book-card">
              <img src="<?= htmlspecialchars($book['cover_image']) ?>" alt="Cover">
              <p class="book-title"><?= htmlspecialchars($book['title']) ?></p>
              <p class="author">by <?= htmlspecialchars($book['author']) ?></p>
              <form action="../backend/reserve.php" method="POST">
                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                <button type="submit" class="reserve-btn">Reserve</button>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
