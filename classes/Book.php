<?php
class Book {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function addBook($title, $author, $subject, $coverImagePath) {
        $stmt = $this->conn->prepare(
            "INSERT INTO books (title, author, subject, cover_image) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $title, $author, $subject, $coverImagePath);
        return $stmt->execute();
    }

    public function updateBook($id, $title, $author, $subject, $coverImagePath = null) {
        if ($coverImagePath) {
            $stmt = $this->conn->prepare(
                "UPDATE books SET title = ?, author = ?, subject = ?, cover_image = ? WHERE id = ?"
            );
            $stmt->bind_param("ssssi", $title, $author, $subject, $coverImagePath, $id);
        } else {
            $stmt = $this->conn->prepare(
                "UPDATE books SET title = ?, author = ?, subject = ? WHERE id = ?"
            );
            $stmt->bind_param("sssi", $title, $author, $subject, $id);
        }
        return $stmt->execute();
    }

    public function getCoverImage($bookId) {
    $stmt = $this->conn->prepare("SELECT cover_image FROM books WHERE id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $coverImage = "";

    if ($result->num_rows > 0) {
        $coverImage = $result->fetch_assoc()['cover_image'];
    }

    $stmt->close();
    return $coverImage;
    }

    public function deleteBook($id, $basePath = '../frontend/') {
        $stmt = $this->conn->prepare("SELECT cover_image FROM books WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $book = $result->fetch_assoc();
            $cover_path = $book['cover_image'];
            $stmt->close();

            $del_stmt = $this->conn->prepare("DELETE FROM books WHERE id = ?");
            $del_stmt->bind_param("i", $id);
            if ($del_stmt->execute()) {
                $del_stmt->close();

                $fullPath = $basePath . $cover_path;
                if (!empty($cover_path) && file_exists($fullPath)) {
                    unlink($fullPath);
                }

                return true;
            } else {
                $del_stmt->close();
                return false;
            }
        }

        $stmt->close();
        return false;
    }

}
?>
