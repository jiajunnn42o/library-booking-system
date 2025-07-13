<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Book.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid book ID.");
}

$book_id = intval($_GET['id']);

$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

$success = $book->deleteBook($book_id);

if ($success) {
  header("Location: ../frontend/manage_books.php?delete=success");
  exit();
} else {
  echo "Failed to delete book or book not found.";
}
?>
?>
