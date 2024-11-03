<?php 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
?>

<center>
<h2>Return Book</h2>
<form action="include/ReturnConnect.php" method="POST">
    <label for="ID">Borrow ID:</label>
    <input type="text" id="ID" name="ID" required>
    <br>
    <button type="submit">Return Book</button>
</form>
<?php
$conn->close(); // Close the database connection
?>

<!-- return display -->

<?php

?>

</center>
</body>
</html>
