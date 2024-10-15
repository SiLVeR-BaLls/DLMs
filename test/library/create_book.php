<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year_published'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO books (title, author, year_published) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $author, $year);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect back to the view_books.php after creating a book
    header("Location: view_books.php");
    exit();
}
?>
