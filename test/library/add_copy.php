<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the next copy number for the book
    $copy_number_result = $conn->query("SELECT COUNT(*) AS count FROM book_copies WHERE book_id = $book_id");
    $copy_count = $copy_number_result->fetch_assoc()['count'] + 1;

    $stmt = $conn->prepare("INSERT INTO book_copies (book_id, copy_number) VALUES (?, ?)");
    $stmt->bind_param("ii", $book_id, $copy_count);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect back to the view_books.php after adding the copy
    header("Location: view_books.php");
    exit();
}
?>
