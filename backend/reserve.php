<?php
session_start();
require_once("db_connect.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_POST['book_id'])) {
  die("Invalid request. Book ID is required.");
}

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);

// 🔒 检查当前用户是否已预约该书且未归还
$check_user_sql = "SELECT * FROM borrow_records WHERE user_id = ? AND book_id = ? AND status = 'borrowed'";
$check_user_stmt = $conn->prepare($check_user_sql);
$check_user_stmt->bind_param("ii", $user_id, $book_id);
$check_user_stmt->execute();
$user_result = $check_user_stmt->get_result();

if ($user_result->num_rows > 0) {
  header("Location: ../frontend/book_list.php?reserved=exists");
  exit();
}
$check_user_stmt->close();

$check_book_sql = "SELECT * FROM borrow_records WHERE book_id = ? AND status = 'borrowed'";
$check_book_stmt = $conn->prepare($check_book_sql);
$check_book_stmt->bind_param("i", $book_id);
$check_book_stmt->execute();
$book_result = $check_book_stmt->get_result();

if ($book_result->num_rows > 0) {
  header("Location: ../frontend/book_list.php?reserved=unavailable");
  exit();
}
$check_book_stmt->close();

$sql = "INSERT INTO borrow_records (user_id, book_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $book_id);

if ($stmt->execute()) {
  header("Location: ../frontend/book_list.php?reserved=success");
  exit();
} else {
  echo "Failed to reserve book: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
