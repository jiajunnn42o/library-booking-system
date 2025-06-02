<?php
session_start(); // 启用 session

require_once("db_connect.php");

// 获取登录表单数据
$email = $_POST['email'];
$password = $_POST['password'];

// 查询数据库中该用户
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();

  // 验证密码
  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];

    echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . ".";
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "Email not found.";
}

$stmt->close();
$conn->close();
?>
