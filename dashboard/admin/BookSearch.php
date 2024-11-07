<!-- BookSearch.php -->
<?php
// Example for searching books
include '../config.php';

// Get the bookID from the request
$bookID = $_GET['bookID'];

// Query to search for the book by bookID
$sql = "SELECT * FROM book_copies WHERE ID LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%$bookID%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>Book ID: " . htmlspecialchars($row['ID']) . " - Title: " . htmlspecialchars($row['B_title']) . "</div>";
    }
} else {
    echo "<div>No book found with ID: $bookID</div>";
}

// Close the connection
$stmt->close();
$conn->close();
?>
