<!-- borrow_book.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'navbar.php'; // Include the navbar at the top of the page
include 'db_connect.php'; // Ensure the database connection is included

// Fetch all available books
$query = "SELECT id, title, author FROM books WHERE status = 'available'";
$result = $conn->query($query);
?>

<h2>Borrow Book</h2>
<form action="borrow_book_action.php" method="POST">
    <label for="user_id">User ID:</label>
    <input type="text" id="user_id" name="user_id" required>
    <br>
    
    <h3>Select Books to Borrow:</h3>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<input type='checkbox' name='book_ids[]' value='{$row['id']}'> 
                  <label for='book_ids'>{$row['title']} by {$row['author']}</label><br>";
        }
    } else {
        echo "No available books.";
    }
    ?>
    
    <br>
    <button type="submit">Borrow Selected Books</button>
</form>

<?php
$conn->close(); // Close the database connection
?>

</body>
</html>
