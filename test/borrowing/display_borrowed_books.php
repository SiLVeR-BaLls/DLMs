<?php
include 'db_connect.php';
include 'navbar.php'; // Include the navigation bar

echo "<h2>Borrowed Books</h2>";

// Fetch borrowed books with user and book details
$query = "
    SELECT bb.id AS borrow_id, u.username, b.title, b.author, bb.borrow_date
    FROM borrowed_books AS bb
    JOIN users AS u ON bb.user_id = u.id
    JOIN books AS b ON bb.book_id = b.id
    WHERE bb.return_date IS NULL";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Username</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Borrow Date</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['username'] . "</td>
                <td>" . $row['title'] . "</td>
                <td>" . $row['author'] . "</td>
                <td>" . $row['borrow_date'] . "</td>
                <td>
                    <form action='return_book_action.php' method='POST'>
                        <input type='hidden' name='borrow_id' value='" . $row['borrow_id'] . "'>
                        <input type='submit' value='Return'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No borrowed books found.";
}
$conn->close();
?>
