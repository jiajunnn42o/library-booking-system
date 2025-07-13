<?php
session_start();

require_once '../classes/Database.php';
require_once '../classes/BorrowRecord.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_POST['borrow_id']) || !is_numeric($_POST['borrow_id'])) {
  die("Invalid request: missing borrow ID.");
}

$borrow_id = intval($_POST['borrow_id']);

$db = new Database();
$conn = $db->getConnection();
$record = new BorrowRecord($conn);

if ($record->returnBook($borrow_id)) {
  header("Location: ../frontend/my_bookings.php?returned=success");
  exit();
} else {
  echo "Failed to return book.";
}
?>