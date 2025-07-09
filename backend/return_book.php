<?php
session_start();
require_once("db_connect.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: ../frontend/login.html");
  exit();
}

if (!isset($_POST['borrow_id'])) {
  die("Invalid request: missing borrow ID.");
}

$borrow_id = intval($_POST['borrow_id']);

$sql = "UPDATE borrow_records 
        SET return_date = CURRENT_DATE, status = 'returned' 
        WHERE id = ? AND status = 'borrowed'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $borrow_id);

if ($stmt->execute()) {
  header("Location: ../frontend/my_bookings.php?returned=success");
  exit();
} else {
  echo "Failed to return book: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
