<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    $sql = "INSERT INTO books (title, author) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $author);
    $stmt->execute();

    header("Location: view_books.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Register Book</title>
</head>
<body>
    <h2>Register Book</h2>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
