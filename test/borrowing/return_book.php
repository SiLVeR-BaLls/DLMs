<?php
include 'db.php';

// Handle returning a book
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['return'])) {
    $borrow_id = $_POST['borrow_id'];

    // Update the return_date when a book is returned
    $sql = "UPDATE borrowed_books SET return_date = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrow_id);
    $stmt->execute();
}

// Fetch borrowed books for displaying
$borrowed_books_sql = "SELECT bb.id, b.title, b.author, bb.borrow_date FROM borrowed_books bb JOIN books b ON bb.book_id = b.book_id WHERE bb.user_id = ?";
$user_id = 1; // Replace with actual user id based on logged-in user
$borrowed_books_stmt = $conn->prepare($borrowed_books_sql);
$borrowed_books_stmt->bind_param("i", $user_id);
$borrowed_books_stmt->execute();
$borrowed_books_result = $borrowed_books_stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Return Book</title>
</head>
<body>
    <h2>Your Borrowed Books</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Borrow Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($borrowed_book = $borrowed_books_result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo htmlspecialchars($borrowed_book['title']); ?></td>
            <td><?php echo htmlspecialchars($borrowed_book['author']); ?></td>
            <td><?php echo htmlspecialchars($borrowed_book['borrow_date']); ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="borrow_id" value="<?php echo htmlspecialchars($borrowed_book['id']); ?>">
                    <button type="submit" name="return">Return Book</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
