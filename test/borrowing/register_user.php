<!-- register_user.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'navbar.php'; // Include the navbar at the top of the page

?>


    <h2>Register User</h2>
    <form action="register_user_action.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button type="submit">Register User</button>
    </form>
</body>
</html>
