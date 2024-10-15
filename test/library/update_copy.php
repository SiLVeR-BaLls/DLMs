<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $copy_id = $_POST['copy_id'];
    $status = $_POST['status'];
    $source = $_POST['source'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    // Update the copy details
    $stmt = $conn->prepare("UPDATE book_copies SET status = ?, source = ? WHERE copy_id = ?");
    $stmt->bind_param("ssi", $status, $source, $copy_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect back to the view_books.php after updating
    header("Location: view_books.php");
    exit();
}
?>
