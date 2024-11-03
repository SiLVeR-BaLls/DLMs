<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && !empty($_SESSION['borrow_cart'])) {
    $user_id = $_POST['user_id'];
    $borrow_date = date("Y-m-d H:i:s");
    
    foreach ($_SESSION['borrow_cart'] as $book_id) {
        // Insert into borrowed_books table
        $stmt = $conn->prepare("INSERT INTO borrowed_books (user_id, book_id, borrow_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $book_id, $borrow_date);
        $stmt->execute();
        
        // Update book status to 'borrowed'
        $updateBook = $conn->prepare("UPDATE books SET status = 'borrowed' WHERE id = ?");
        $updateBook->bind_param("i", $book_id);
        $updateBook->execute();
    }

    // Clear the cart
    $_SESSION['borrow_cart'] = [];
    echo "Books successfully borrowed!";
    echo "<br><a href='borrow_book.php'>Borrow More Books</a>";
    echo "<br><a href='display_borrowed_books.php'>View Borrowed Books</a>";
} else {
    echo "Error: Missing user ID or cart is empty.";
}
$conn->close();
?>
