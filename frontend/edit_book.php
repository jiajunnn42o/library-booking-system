<?php
session_start();
require_once("../backend/db_connect.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.html");
  exit();
}

if (!isset($_GET['id'])) {
  die("No book ID provided.");
}

$book_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
  die("Book not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Book</title>
  <link rel="stylesheet" href="book_list.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet" />
  <style>
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
    font-family: "DM Serif Text", serif;
    font-weight: 400;
    font-style: normal;
      display: block;
      margin-bottom: 8px;
    }
    .form-group input[type="text"],
    .form-group input[type="file"] {
      width: 100%;
      padding: 10px;
      font-family: "DM Serif Text", serif;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .cover-preview {
      max-width: 120px;
      margin-top: 10px;
      border-radius: 6px;
    }

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
<?php if (isset($_GET['updated']) && $_GET['updated'] === 'success'): ?>
  <div class="toast toast-success">Book updated successfully!</div>
  <script>
    setTimeout(() => {
      document.querySelector('.toast').style.display = 'none';
    }, 3000);
  </script>
<?php elseif (isset($_GET['updated']) && $_GET['updated'] === 'fail'): ?>
  <div class="toast toast-error">Failed to update book.</div>
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
        <img src="school-logo.png" alt="School Logo" class="header-logo" />
      </div>
      <div class="header-center">
        <h2 class="page-title">EDIT BOOK</h2>
      </div>
      <div class="header-right">
        <a href="manage_books.php" class="back-btn">Back to Manage</a>
      </div>
    </div>

    <div class="form-section">
      <form action="../backend/update_book.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $book['id'] ?>" />

        <div class="form-group">
          <label>Title:</label>
          <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required />
        </div>

        <div class="form-group">
          <label>Author:</label>
          <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required />
        </div>

        <div class="form-group">
          <label>Subject:</label>
          <input type="text" name="subject" value="<?= htmlspecialchars($book['subject']) ?>" required />
        </div>

        <div class="form-group">
          <label>Current Cover:</label><br>
          <img src="<?= htmlspecialchars($book['cover_image']) ?>" class="cover-preview" alt="Cover Preview" />
        </div>

        <div class="form-group">
          <label>Replace Cover (optional):</label>
          <input type="file" name="cover" accept="image/*" />
        </div>

        <button type="submit" class="submit-btn">Update Book</button>
      </form>
    </div>
  </div>
</body>
</html>
