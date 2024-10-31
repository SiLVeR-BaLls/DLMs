<?php
include 'db.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>View Books</title>
</head>
<body>
    <h2>Books</h2>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['book_id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td>
                <a href="edit_book.php?book_id=<?php echo $row['book_id']; ?>">Edit</a> |
                <a href="delete_book.php?book_id=<?php echo $row['book_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a> |
                <a href="borrow_book.php?book_id=<?php echo $row['book_id']; ?>">Borrow</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
