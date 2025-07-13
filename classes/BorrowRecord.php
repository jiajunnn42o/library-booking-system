<?php
class BorrowRecord {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function updateOverdueStatus($userId) {
        $stmt = $this->conn->prepare("
            UPDATE borrow_records 
            SET status = 'overdue' 
            WHERE user_id = ? AND status = 'borrowed' AND due_date < CURDATE()
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function getUserRecords($userId) {
        $stmt = $this->conn->prepare("
            SELECT br.id, b.title, br.borrow_date, br.due_date, br.return_date, br.status 
            FROM borrow_records br
            JOIN books b ON br.book_id = b.id
            WHERE br.user_id = ?
            ORDER BY br.id ASC
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close();
        return $records;
    }

    public function updateAllOverdueStatus() {
    $stmt = $this->conn->prepare("
        UPDATE borrow_records 
        SET status = 'overdue' 
        WHERE status = 'borrowed' AND due_date < CURDATE()
    ");
    $stmt->execute();
    $stmt->close();
    }

    public function getAllRecords() {
        $stmt = $this->conn->prepare("
            SELECT br.id, u.name AS user_name, u.email, b.title AS book_title, b.author,
                br.borrow_date, br.due_date, br.return_date, br.status
            FROM borrow_records br
            JOIN users u ON br.user_id = u.id
            JOIN books b ON br.book_id = b.id
            ORDER BY br.id ASC
        ");
        $stmt->execute();
        $result = $stmt->get_result();

        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close();
        return $records;
    }

    public function returnBook($borrowId) {
    $today = date('Y-m-d');
    $stmt = $this->conn->prepare("
        UPDATE borrow_records 
        SET return_date = ?, status = 'returned' 
        WHERE id = ?
    ");
    $stmt->bind_param("si", $today, $borrowId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
    }

}
?>
