<?php
class Reservation {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function hasUserReserved($userId, $bookId) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM borrow_records WHERE user_id = ? AND book_id = ? AND status = 'borrowed'"
        );
        $stmt->bind_param("ii", $userId, $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function isBookBorrowed($bookId) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM borrow_records WHERE book_id = ? AND status = 'borrowed'"
        );
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function reserveBook($userId, $bookId, $dueDate) {
        $stmt = $this->conn->prepare(
            "INSERT INTO borrow_records (user_id, book_id, due_date) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("iis", $userId, $bookId, $dueDate);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
?>
