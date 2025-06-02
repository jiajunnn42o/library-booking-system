<?php
require_once("db_connect.php");

$name = $_POST['name'];
$student_id = $_POST['student_id'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, student_id, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $student_id, $email, $password);

if ($stmt->execute()) {
  echo "Registration successful! <a href='../frontend/login.html'>Go to Login</a>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
