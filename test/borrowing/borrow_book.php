<?php
include 'db.php';

// Handle borrowing books
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $user_id = $_POST['user_id'];
    $book_ids = $_POST['book_ids']; // This will be an array

    // Check if the user exists
    $user_check_sql = "SELECT * FROM users WHERE id = ?";
    $user_check_stmt = $conn->prepare($user_check_sql);
    $user_check_stmt->bind_param("i", $user_id);
    $user_check_stmt->execute();
    $user_check_result = $user_check_stmt->get_result();

    // Check if all selected books are available
    $available_books = [];
    $unavailable_books = [];
    foreach ($book_ids as $book_id) {
        $availability_check_sql = "SELECT * FROM books WHERE book_id = ? AND book_id NOT IN (SELECT book_id FROM borrowed_books WHERE return_date IS NULL)";
        $availability_check_stmt = $conn->prepare($availability_check_sql);
        $availability_check_stmt->bind_param("i", $book_id);
        $availability_check_stmt->execute();
        $availability_check_result = $availability_check_stmt->get_result();

        if ($availability_check_result->num_rows > 0) {
            $available_books[] = $book_id; // Book is available
        } else {
            $unavailable_books[] = $book_id; // Book is unavailable
        }
    }

    // If user exists and all selected books are available, proceed to borrow
    if ($user_check_result->num_rows > 0 && empty($unavailable_books)) {
        foreach ($available_books as $book_id) {
            $sql = "INSERT INTO borrowed_books (user_id, book_id, borrow_date) VALUES (?, ?, CURRENT_TIMESTAMP)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $book_id);
            $stmt->execute();
        }
        echo "<script>alert('Books borrowed successfully!');</script>";
    } else {
        if ($user_check_result->num_rows === 0) {
            echo "<script>alert('User does not exist.');</script>";
        }
        if (!empty($unavailable_books)) {
            echo "<script>alert('Some books are unavailable for borrowing.');</script>";
        }
    }
}

// Fetch all users
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);

// Fetch all books
$books_sql = "SELECT * FROM books";
$books_result = $conn->query($books_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Borrow Book</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .users, .books {
            flex: 1; /* Distribute space evenly */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Borrow a Book</h2>
    <div class="container">
        <div class="users">
            <h3>Available Users</h3>
            <form method="POST" action="">
                <label for="user_id">Select User:</label>

                <!-- for my vendors need this fucntio -->
                <select name="user_id" required>
                    <option value="" disabled selected>Select a user</option>
                    <?php while ($user = $users_result->fetch_assoc()) : ?>
                    <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['username']); ?></option>
                    <?php endwhile; ?>
                </select>
        </div>

        <div class="books">
            <h3>Available Books</h3>
            <table>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Select</th>
                </tr>
                <?php while ($book = $books_result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['book_id']); ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td>
                        <input type="checkbox" name="book_ids[]" value="<?php echo htmlspecialchars($book['book_id']); ?>">
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <button type="submit" name="borrow">Borrow</button>
    </form>
</body>
</html>
