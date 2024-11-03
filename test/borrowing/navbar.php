<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic styling for the navbar */
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="register_user.php">Register User</a>
        <a href="register_book.php">Register Book</a>
        <a href="borrow_book.php">Borrow Book</a>
        <a href="return_book.php">Return Book</a>
        <a href="display_users.php">Display Users</a>
        <a href="display_book.php">Display Books</a>
        <a href="display_borrowed_books.php">Display borrowed</a>
    </div>
</body>
</html>
