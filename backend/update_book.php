<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Book.php';

$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

if (!isset($_POST['id'])) {
  die("Book ID is missing.");
}

$book_id = intval($_POST['id']);
$title = $_POST['title'];
$author = $_POST['author'];
$subject = $_POST['subject'];

$cover_image = $book->getCoverImage($book_id);

if (!empty($_FILES['cover']['name'])) {
  $upload_dir = '../frontend/books/';
  $image_name = basename($_FILES['cover']['name']);
  $target_path = $upload_dir . $image_name;

  if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_path)) {
    $cover_image = 'books/' . $image_name;
  }
}

$success = $book->updateBook($book_id, $title, $author, $subject, $cover_image);

if ($success) {
  header("Location: ../frontend/edit_book.php?id=$book_id&updated=success");
} else {
  header("Location: ../frontend/edit_book.php?id=$book_id&updated=fail");
}
?>