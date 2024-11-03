<!-- borrow_book_action.php -->
<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IDno = $_POST["IDno"];
    $ID = $_POST["ID"]; // This will be an array of book ID

    if (!empty($ID)) {
        foreach ($ID as $ID) {
            // Check if the book is available
            $bookCheck = $conn->prepare("SELECT status FROM book_copies WHERE id = ? AND status = 'available'");
            $bookCheck->bind_param("i", $ID);
            $bookCheck->execute();
            $bookCheck->store_result();
            
            if ($bookCheck->num_rows > 0) {
                // Borrow the book
                $stmt = $conn->prepare("INSERT INTO borrow_book (IDno, ID, borrow_date) VALUES (?, ?, NOW())");
                $stmt->bind_param("si", $IDno, $ID);
                $stmt->execute();
                $stmt->close();
                
                // Update book status to 'borrowed'
                $updateBook = $conn->prepare("UPDATE book_copies SET status = 'borrowed' WHERE ID = ?");
                $updateBook->bind_param("i", $ID);
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
