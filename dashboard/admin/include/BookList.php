<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the URL, if provided
$book_title = isset($_GET['title']) ? $_GET['title'] : '';

// Fetch book copies from the database, filtering by book title if provided
$sql = "SELECT * FROM book_copies" . ($book_title ? " WHERE B_title = '" . $conn->real_escape_string($book_title) . "'" : "");
$result = $conn->query($sql);

if (!$result) {
    $message = "Error retrieving books: " . $conn->error;
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        
        <h2>Book List</h2>
        <?php if ($book_title): ?>
            <a href="ViewBook.php?title=<?php echo urlencode($book_title); ?>" class="btn btn-primary mb-3">List</a>
        <?php endif; ?>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Copy ID</th>
                    <th>Call Number</th>
                    <th>Status</th>
                    <th>Vendor</th>
                    <th>Funding Source</th>
                    <th>Sublocation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['B_title']) . "</td>
                            <td>" . htmlspecialchars($row['copy_ID']) . "</td>
                            <td>" . htmlspecialchars($row['callNumber']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>" . htmlspecialchars($row['vendor']) . "</td>
                            <td>" . htmlspecialchars($row['fundingSource']) . "</td>
                            <td>" . htmlspecialchars($row['Sublocation']) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No books available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
