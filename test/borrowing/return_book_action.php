<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $borrow_id = $_POST["borrow_id"];
    
    // Update the return date for the borrowed book entry
    $stmt = $conn->prepare("UPDATE borrowed_books SET return_date = NOW() WHERE id = ?");
    $stmt->bind_param("i", $borrow_id);
    $stmt->execute();
    
    // Fetch the book_id to update the book status
    $stmt = $conn->prepare("SELECT book_id FROM borrowed_books WHERE id = ?");
    $stmt->bind_param("i", $borrow_id);
    $stmt->execute();
    $stmt->bind_result($book_id);
    $stmt->fetch();
    $stmt->close();
    
    // Update the book's status to 'available'
    $updateBook = $conn->prepare("UPDATE books SET status = 'available' WHERE id = ?");
    $updateBook->bind_param("i", $book_id);
    $updateBook->execute();
    $updateBook->close();
    
    echo "Book returned successfully!";
    echo "<br><a href='display_borrowed_books.php'>Back to Borrowed Books</a>";
}
$conn->close();
?>
