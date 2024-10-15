<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $copy_id = $_POST['copy_id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'library_db');

    // Fetch the current copy details
    $result = $conn->query("SELECT * FROM book_copies WHERE copy_id = $copy_id");
    $copy = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Book Copy</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Copy Details</h1>
        <form action="process_edit_copy.php" method="POST">
            <input type="hidden" name="copy_id" value="<?php echo $copy['copy_id']; ?>">
            <input type="hidden" name="book_id" value="<?php echo $copy['book_id']; ?>">

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available" <?php if ($copy['status'] == 'available') echo 'selected'; ?>>Available</option>
                    <option value="unavailable" <?php if ($copy['status'] == 'unavailable') echo 'selected'; ?>>Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="source">Source:</label>
                <select name="source" id="source" class="form-control" required>
                    <option value="purchase" <?php if ($copy['source'] == 'purchase') echo 'selected'; ?>>Purchase</option>
                    <option value="replace" <?php if ($copy['source'] == 'replace') echo 'selected'; ?>>Replace</option>
                    <option value="donation" <?php if ($copy['source'] == 'donation') echo 'selected'; ?>>Donation</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Copy</button>
        </form>

        <form action="view_copies.php?book_id=<?php echo $copy['book_id']; ?>" method="post">
            <button type="submit" class="btn btn-secondary">Return to Copies List</button>
        </form>
    </div>
</body>
</html>
