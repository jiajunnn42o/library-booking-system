<?php
session_start();

require_once '../classes/Database.php';
require_once '../classes/Reservation.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_POST['book_id'])) {
  die("Invalid request. Book ID is required.");
}

$db = new Database();
$conn = $db->getConnection();
$reservation = new Reservation($conn);

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);
$due_date = date('Y-m-d', strtotime('+5 days'));

if ($reservation->hasUserReserved($user_id, $book_id)) {
  header("Location: ../frontend/book_list.php?reserved=exists");
  exit();
}

if ($reservation->isBookBorrowed($book_id)) {
  header("Location: ../frontend/book_list.php?reserved=unavailable");
  exit();
}

if ($reservation->reserveBook($user_id, $book_id, $due_date)) {
  header("Location: ../frontend/book_list.php?reserved=success");
  exit();
} else {
  echo "Failed to reserve book.";
}
?>
