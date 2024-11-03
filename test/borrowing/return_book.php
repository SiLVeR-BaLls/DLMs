<!-- return_book.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'navbar.php'; // Include the navbar at the top of the page

?>


    <h2>Return Book</h2>
    <form action="return_book_action.php" method="POST">
        <label for="borrow_id">Borrow ID:</label>
        <input type="text" id="borrow_id" name="borrow_id" required>
        <br>
        <button type="submit">Return Book</button>
    </form>
</body>
</html>
