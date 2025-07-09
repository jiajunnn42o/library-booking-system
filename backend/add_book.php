<?php
require_once("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $author = trim($_POST['author']);
  $subject = trim($_POST['subject']);

  if (empty($title) || empty($author) || empty($subject)) {
    header("Location: ../frontend/manage_books.php?add=fail");
    exit();
  }

  if (!isset($_FILES['cover']) || $_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../frontend/manage_books.php?add=fail");
    exit();
  }

  $uploadDir = '../frontend/books/';
  $filename = basename($_FILES['cover']['name']);
  $targetPath = $uploadDir . $filename;

  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetPath)) {
    $coverImagePath = 'books/' . $filename;

    $sql = "INSERT INTO books (title, author, subject, cover_image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $author, $subject, $coverImagePath);

    if ($stmt->execute()) {
      header("Location: ../frontend/manage_books.php?added=success");
      exit();
    } else {
      header("Location: ../frontend/manage_books.php?added=fail");
      exit();
    }
  } else {
    header("Location: ../frontend/manage_books.php?added=fail");
    exit();
  }
} else {
  header("Location: ../frontend/manage_books.php");
  exit();
}
?>
