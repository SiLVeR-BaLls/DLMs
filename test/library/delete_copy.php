<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $copy_id = $_POST['copy_id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    // Delete the copy
    $stmt = $conn->prepare("DELETE FROM book_copies WHERE copy_id = ?");
    $stmt->bind_param("i", $copy_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect back to the view_books.php after deleting
    header("Location: view_books.php");
    exit();
}
?>
