<?php
session_start();
require_once("db_connect.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid book ID.");
}

$book_id = intval($_GET['id']);

$get_sql = "SELECT cover_image FROM books WHERE id = ?";
$get_stmt = $conn->prepare($get_sql);
$get_stmt->bind_param("i", $book_id);
$get_stmt->execute();
$get_result = $get_stmt->get_result();

if ($get_result->num_rows === 1) {
  $book = $get_result->fetch_assoc();
  $cover_path = $book['cover_image'];

  $del_sql = "DELETE FROM books WHERE id = ?";
  $del_stmt = $conn->prepare($del_sql);
  $del_stmt->bind_param("i", $book_id);

  if ($del_stmt->execute()) {
    if (!empty($cover_path) && file_exists("../frontend/" . $cover_path)) {
      unlink("../frontend/" . $cover_path);
    }
    header("Location: ../frontend/manage_books.php?delete=success");
    exit();
  } else {
    echo "Error deleting book: " . $del_stmt->error;
  }

  $del_stmt->close();
} else {
  echo "Book not found.";
}

$get_stmt->close();
$conn->close();
?>
