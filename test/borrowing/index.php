<?php
// Include the database connection
include 'db.php';

// Fetch all users for display (optional)
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);

// Fetch all books for display (optional)
$books_sql = "SELECT * FROM books";
$books_result = $conn->query($books_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Library Management System</title>
</head>
<body>
    <h1>Welcome to the Library Management System</h1>
    
    <div class="button-container">
        <a href="register_user.php"><button>Register User</button></a>
        <a href="register_book.php"><button>Register Book</button></a>
        <a href="borrow_book.php"><button>Borrow Book</button></a>
        <a href="return_book.php"><button>Return Book</button></a>
        <a href="view_books.php"><button>View Books</button></a>
        <a href="view_users.php"><button>View Users</button></a>
    </div>

    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        <?php while ($user = $users_result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Available Books</h2>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
        </tr>
        <?php while ($book = $books_result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $book['book_id']; ?></td>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['author']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
