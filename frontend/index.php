<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library Book Catalog</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>

  <p><a href="../backend/logout.php">Logout</a></p>

  <h3>Available Books</h3>
  <table border="1">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Available</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Introduction to Algorithms</td>
        <td>Thomas H. Cormen</td>
        <td>Yes</td>
      </tr>
      <tr>
        <td>Clean Code</td>
        <td>Robert C. Martin</td>
        <td>No</td>
      </tr>
      <tr>
        <td>Database System Concepts</td>
        <td>Silberschatz</td>
        <td>Yes</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
