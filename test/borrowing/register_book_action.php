<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    
    // Insert into books table
    $stmt = $conn->prepare("INSERT INTO books (title, author, isbn) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $isbn);
    $stmt->execute();
    $stmt->close();
    
    echo "Book registered successfully!";
}
$conn->close();
?>
