<!-- borrow_book_action.php -->
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $book_ids = $_POST["book_ids"]; // This will be an array of book IDs

    if (!empty($book_ids)) {
        foreach ($book_ids as $book_id) {
            // Check if the book is available
            $bookCheck = $conn->prepare("SELECT status FROM books WHERE id = ? AND status = 'available'");
            $bookCheck->bind_param("i", $book_id);
            $bookCheck->execute();
            $bookCheck->store_result();
            
            if ($bookCheck->num_rows > 0) {
                // Borrow the book
                $stmt = $conn->prepare("INSERT INTO borrowed_books (user_id, book_id, borrow_date) VALUES (?, ?, NOW())");
                $stmt->bind_param("ii", $user_id, $book_id);
                $stmt->execute();
                $stmt->close();
                
                // Update book status to 'borrowed'
                $updateBook = $conn->prepare("UPDATE books SET status = 'borrowed' WHERE id = ?");
                $updateBook->bind_param("i", $book_id);
                $updateBook->execute();
                $updateBook->close();
            }
            $bookCheck->close();
        }

        echo "Books borrowed successfully!";
    } else {
        echo "No books selected.";
    }
}

$conn->close();
?>
