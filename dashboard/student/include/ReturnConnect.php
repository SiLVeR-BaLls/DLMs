<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID = $_POST["ID"];
    
    // Update the return date for the borrowed book entry
    $stmt = $conn->prepare("UPDATE borrow_book SET return_date = NOW() WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    
    // Fetch the book_id to update the book status
    $stmt = $conn->prepare("SELECT ID FROM borrow_book WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $stmt->bind_result($book_id);
    $stmt->fetch();
    $stmt->close();
    
    // Update the book's status to 'available'
    $updateBook = $conn->prepare("UPDATE book_copies SET status = 'Available' WHERE ID = ?");
    $updateBook->bind_param("s", $book_id);
    $updateBook->execute();
    $updateBook->close();
    
    echo "Book returned successfully!";
    echo "<br><a href='../Borrow.php'>Back to Borrowed Books</a>";
}
$conn->close();
?>
