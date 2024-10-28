<?php
$conn = new mysqli('localhost', 'root', '', 'library_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the list of books
$books_result = $conn->query("SELECT * FROM books");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Library Books</title>
</head>
<body>
    <div class="body_contain">
        <h1 class="text-center">Library Books</h1>

        <div class="text-right mb-3">
            <a href="index.html" class="btn btn-primary">Add New Book</a>
        </div>

        <div class="list-group">
            <?php while ($book = $books_result->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h2>
                    <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p class="card-text"><strong>Year Published:</strong> <?php echo htmlspecialchars($book['year_published']); ?></p>
                    <a href="view_copies.php?book_id=<?php echo $book['book_id']; ?>" class="btn btn-info">View Copies</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <form action="main_page.php" method="post">
            <button type="submit" class="btn btn-secondary">Return to Main Page</button>
        </form>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
