<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $status = $_POST['status'];
    $source = $_POST['source'];
    $copies = $_POST['copies'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    for ($i = 0; $i < $copies; $i++) {
        $stmt = $conn->prepare("INSERT INTO book_copies (book_id, status, source) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $book_id, $status, $source);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the view_copies.php after adding copies
    header("Location: view_copies.php?book_id=$book_id");
    exit();
}
?>
