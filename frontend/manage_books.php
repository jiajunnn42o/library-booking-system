<?php
session_start();
require_once("../backend/db_connect.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.html");
  exit();
}

$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Books</title>
  <link rel="stylesheet" href="book_list.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
  <style>
    .manage-container {
      background-color: #fffaf5;
      width: 90%;
      max-width: 1000px;
      margin: 50px auto;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      font-family: "DM Serif Text", serif;
      font-weight: 400;
      font-style: normal;
    }
    .manage-container h2 {
      text-align: center;
      font-size: 36px;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 40px;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }
    th {
      background-color: #fff2df;
      color: #333;
      font-size: 16px;
      font-family: "DM Serif Text", serif;
      font-weight: 400;
      font-style: normal;
    }
    td img {
      width: 50px;
      height: auto;
      border-radius: 6px;
    }
    .form-section h3 {
      margin-bottom: 15px;
    }
    .form-section input {
      width: 100%;
      padding: 10px;
      margin: 6px 0 15px 0;
      font-family: "DM Serif Text", serif;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .submit-btn {
      padding: 10px 22px;
      background: rgb(255, 202, 137);
      border: none;
      border-radius: 30px;
      cursor: pointer;
      text-decoration: none;
      font-family: "DM Serif Text", serif;
      font-weight: 400;
      font-style: normal;
      font-size: 16px;
      color: #222;
      transition: background 0.3s;
    }
    .submit-btn:hover {
      background: rgb(255, 220, 178); 
    }
    .delete-link {
      color: #c44;
      text-decoration: none;
    }
    .delete-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<?php if (isset($_GET['added']) && $_GET['added'] === 'success'): ?>
  <div class="toast toast-success">Book added successfully!</div>
  <script>
    setTimeout(() => {
      document.querySelector('.toast').style.display = 'none';
    }, 3000);
  </script>
<?php elseif (isset($_GET['added']) && $_GET['added'] === 'fail'): ?>
  <div class="toast toast-error">Failed to add book.</div>
  <script>
    setTimeout(() => {
      document.querySelector('.toast').style.display = 'none';
    }, 3000);
  </script>
<?php endif; ?>
<body>
<?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
  <div class="toast toast-success">Book deleted successfully!</div>
  <script>
    setTimeout(() => {
      document.querySelector('.toast').style.display = 'none';
    }, 3000);
  </script>
<?php endif; ?>

  <div class="manage-container">
    <div class="page-header">
      <div class="header-left">
        <img src="school-logo.png" alt="School Logo" class="header-logo">
      </div>
      <div class="header-center">
        <h2 class="page-title">MANAGE BOOKS</h2>
      </div>
      <div class="header-right">
        <a href="admin_dashboard.php" class="back-btn">Back to Home</a>
      </div>
    </div>

    <table>
      <tr>
        <th>ID</th>
        <th>Cover</th>
        <th>Title</th>
        <th>Author</th>
        <th>Subject</th>
        <th>Action</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td>
        <?php if (!empty($row['cover_image'])): ?>
          <img src="<?= htmlspecialchars($row['cover_image']) ?>" alt="cover">
        <?php else: ?>
          <span>No image</span>
        <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td><?= htmlspecialchars($row['subject']) ?></td>
        <td>
          <a href="edit_book.php?id=<?= $row['id'] ?>" class="submit-btn" style="margin-bottom: 8px; display: inline-block;">Edit</a>
          <br>
          <a href="../backend/delete_book.php?id=<?= $row['id'] ?>" class="delete-link" onclick="return confirm('Confirm delete this book?')">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>

    <div class="form-section">
      <h3>Add New Book</h3>
      <form action="../backend/add_book.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="file" name="cover" accept="image/*" required>
        <button type="submit" class="submit-btn">Add Book</button>
      </form>
    </div>
  </div>
</body>
</html>
