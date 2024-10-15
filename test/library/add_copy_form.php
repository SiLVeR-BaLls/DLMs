<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Book Copies</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Add Copies for Book</h1>
        <form action="process_add_copy.php" method="POST">
            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <div class="form-group">
                <label for="source">Source:</label>
                <select name="source" id="source" class="form-control" required>
                    <option value="purchase">Purchase</option>
                    <option value="replace">Replace</option>
                    <option value="donation">Donation</option>
                </select>
            </div>

            <div class="form-group">
                <label for="copies">Number of Copies:</label>
                <input type="number" id="copies" name="copies" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Copies</button>
        </form>

        <form action="view_copies.php?book_id=<?php echo $book_id; ?>" method="post">
            <button type="submit" class="btn btn-secondary">Return to Copies List</button>
        </form>
    </div>
</body>
</html>
