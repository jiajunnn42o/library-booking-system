<?php
require_once("db_connect.php");

$name = trim($_POST['name']);
$student_id = trim($_POST['student_id']);
$email = trim($_POST['email']);
$password_raw = $_POST['password'];

if (empty($name) || empty($student_id) || empty($email) || empty($password_raw)) {
  die("All fields are required.");
}

$password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

$check_sql = "SELECT * FROM users WHERE email = ? OR student_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $email, $student_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
  header("Location: ../frontend/email_exist.html");
  exit();
}
$check_stmt->close();

$sql = "INSERT INTO users (name, student_id, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $student_id, $email, $password_hashed);

if ($stmt->execute()) {
  header("Location: ../frontend/login.html?register=success");
  exit();
} else {
  error_log("Registration failed: " . $stmt->error); 
  header("Location: ../frontend/register_fail.html"); 
  exit();
}

$stmt->close();
$conn->close();
