<?php 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="../../pic/scr/book.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">   
    <title>Borrowing</title>
</head>


<body>
    
<?php 
include 'include/header.php';
include 'include/navbar.php'; 
include '../config.php'; // Include the configuration file for database connection

echo "<h1>Borrow</h1>";

// Fetch all available book_copies along with their authors
$query = "SELECT * 
FROM book 
join book_copies 
WHERE status = 'available'";
$result = $conn->query($query); // Execute the query
?>


<center>
<form action="include/BorrowConnect.php" method="POST">
    <label for="IDno">User ID:</label>
    <input type="text" id="IDno" name="IDno" required>
    <br>
    <br>
    <h3>Select Books to Borrow:</h3>
    <br>
    <?php
    if ($result && $result->num_rows > 0) {
        // Start the table structure
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>L</th>
                        <th>Book ID</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $result->fetch_assoc()) {
            // For each book, output a table row
            echo "
            <tr>
                <td>{$row['B_title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['circulationType']}</td>
                <td>{$row['ID']}</td>
                <td><input type='checkbox' name='ID[]' value='{$row['ID']}'></td>
            </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No available books.</p>";
    }
    ?>
    
    <br>
    <button type="submit">Borrow Selected Books</button>
</form>
</center>
</body>
</html>
