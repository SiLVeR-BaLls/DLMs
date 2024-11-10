<!-- booksearch.php -->
<?php
// Include the database configuration file for the connection
include '../config.php';

// Get the bookID from the request (use GET to fetch the search query)
$bookID = isset($_GET['bookID']) ? $_GET['bookID'] : '';

// Prevent SQL Injection and sanitize the input
$bookID = htmlspecialchars($bookID);

// Query to search for books by a partial or exact match of the book ID
$sql = "SELECT book_copies.ID, book_copies.copy_ID, book_copies.B_title, book_copies.status, book_copies.callNumber, 
               book_copies.circulationType, book_copies.dateAcquired, book_copies.description1, book_copies.description2, book_copies.description3,
               book.B_title AS book_title, book.author, book.ISBN, book.publisher, book.Pdate
        FROM book_copies
        LEFT JOIN book ON book_copies.B_title = book.B_title
        WHERE book_copies.ID LIKE ?";

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$searchParam = "%" . $bookID . "%"; // Using wildcards to search for partial matches
$stmt->bind_param("s", $searchParam);
$stmt->execute();

// Get the results
$result = $stmt->get_result();

// Check if any books were found
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book-item'>";
        echo "<h5>Book ID: " . htmlspecialchars($row['ID']) . "</h5>";
        echo "<p><strong>Title:</strong> " . htmlspecialchars($row['B_title']) . "</p>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($row['callNumber']) . "</p>"; // assuming 'author' is a column
        echo "<p><strong>Genre:</strong> " . htmlspecialchars($row['author']) . "</p>";   // assuming 'genre' is a column
        echo "<p><strong>Publication Year:</strong> " . htmlspecialchars($row['publisher']) . "</p>"; // assuming 'pub_year' is a column
        echo "<p><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</p>";
        echo "</div><hr>"; // Add a line break between results
    }
} else {
    echo "<div class='no-results'>No book found with ID: " . htmlspecialchars($bookID) . "</div>";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
