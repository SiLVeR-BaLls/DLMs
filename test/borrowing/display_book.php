<?php
include 'db_connect.php';
include 'navbar.php'; // Include the navbar at the top of the page

echo "<h2>Library Books</h2>";
$result = $conn->query("SELECT id, title, author, isbn, status FROM books");

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["author"] . "</td><td>" . $row["isbn"] . "</td><td>" . ucfirst($row["status"]) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No books found.";
}
$conn->close();
?>
