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
$query = "SELECT * FROM book join book_copies WHERE status = 'available'";
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
        while ($row = $result->fetch_assoc()) {
            echo " 
            <label for='ID'>
            {$row['B_title']} by {$row['author']} NO. {$row['ID']}
            </label>
            <input  type='checkbox' name='ID[]' value='{$row['ID']}'>
            <br>";
        }
    } else {
        echo "No available books.";
    }
    ?>
    
    <br>
    <button type="submit">Borrow Selected Books</button>
</form>
</center>
</body>
</html>
