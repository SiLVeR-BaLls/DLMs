<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IDno = $_POST["IDno"];
    $bookID = $_POST["bookID"];

    // Check if the book is available
    $bookCheck = $conn->prepare("SELECT status FROM book_copies WHERE ID = ? AND status = 'available'");
    $bookCheck->bind_param("i", $bookID);
    $bookCheck->execute();
    $bookCheck->store_result();

    if ($bookCheck->num_rows > 0) {
        // Approve the borrow request
        $stmt = $conn->prepare("INSERT INTO borrow_book (IDno, ID, borrow_date) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $IDno, $bookID);
        $stmt->execute();
        $stmt->close();

        // Update book status to 'borrowed'
        $updateBook = $conn->prepare("UPDATE book_copies SET status = 'borrowed' WHERE ID = ?");
        $updateBook->bind_param("i", $bookID);
        $updateBook->execute();
        $updateBook->close();

        echo "Borrow request approved successfully!";
    } else {
        echo "Book is not available for borrowing.";
    }
    $bookCheck->close();
}

$conn->close();
?>
