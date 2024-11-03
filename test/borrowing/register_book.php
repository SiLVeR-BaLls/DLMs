<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'navbar.php'; // Include the navbar at the top of the page

?>


    <h2>Register Book</h2>
    <form action="register_book_action.php" method="POST">
        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br>
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>
        <br>
        <button type="submit">Register Book</button>
    </form>
</body>
</html>
