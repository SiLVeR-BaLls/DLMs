<?php
$book_id = $_GET['book_id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'library_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the book details
$book_result = $conn->query("SELECT * FROM books WHERE book_id = $book_id");
$book = $book_result->fetch_assoc();

// Fetch the copies for this book
$copies_result = $conn->query("SELECT * FROM book_copies WHERE book_id = $book_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Copies of <?php echo htmlspecialchars($book['title']); ?></title>
</head>
<body>
    <div class="body_contain">
        <h1 class="text-center">Copies of <?php echo htmlspecialchars($book['title']); ?></h1>

        <div class="text-right mb-3">
            <form action="add_copy_form.php" method="post">
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <button type="submit" class="btn btn-primary">Add Copy</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Copy ID</th>
                    <th>Status</th>
                    <th>Source</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($copies_result->num_rows > 0): ?>
                    <?php while ($copy = $copies_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $copy['copy_id']; ?></td>
                        <td><?php echo ucfirst($copy['status']); ?></td>
                        <td><?php echo ucfirst($copy['source']); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <form action="edit_copy.php" method="post" style="display:inline;">
                                <input type="hidden" name="copy_id" value="<?php echo $copy['copy_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>

                            <!-- Delete Button -->
                            <form action="delete_copy.php" method="post" style="display:inline;">
                                <input type="hidden" name="copy_id" value="<?php echo $copy['copy_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this copy?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No copies available for this book.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <form action="view_books.php" method="post">
            <button type="submit" class="btn btn-secondary">Return to Book List</button>
        </form>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
