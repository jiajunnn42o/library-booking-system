<?php
session_start();
require_once("db_connect.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();

  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role']; 


    if ($user['role'] === 'admin') {
      header("Location: ../frontend/admin_dashboard.php");
    } else {
      header("Location: ../frontend/index.php");
    }
    exit();

  } else {
    header("Location: ../frontend/login_fail.html");
    exit();
  }
} else {
  header("Location: ../frontend/login_fail.html");
  exit();
}

$stmt->close();
$conn->close();
?>
