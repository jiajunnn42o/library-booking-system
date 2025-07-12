<?php
require_once("db_connect.php");

if (!isset($_POST['id'])) {
  die("Book ID is missing.");
}

$book_id = intval($_POST['id']);
$title = $_POST['title'];
$author = $_POST['author'];
$subject = $_POST['subject'];

$cover_image = "";
$stmt = $conn->prepare("SELECT cover_image FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $cover_image = $result->fetch_assoc()['cover_image'];
}
$stmt->close();


if (!empty($_FILES['cover']['name'])) {
  $upload_dir = '../frontend/books/';
  $image_name = basename($_FILES['cover']['name']);
  $target_path = $upload_dir . $image_name;


  if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_path)) {
    $cover_image = 'books/' . $image_name;
  }
}

$update_sql = "UPDATE books SET title = ?, author = ?, subject = ?, cover_image = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ssssi", $title, $author, $subject, $cover_image, $book_id);

if ($update_stmt->execute()) {
  header("Location: ../frontend/edit_book.php?id=$book_id&updated=success");
} else {
  header("Location: ../frontend/edit_book.php?id=$book_id&updated=fail");
}

$update_stmt->close();
$conn->close();
?>
