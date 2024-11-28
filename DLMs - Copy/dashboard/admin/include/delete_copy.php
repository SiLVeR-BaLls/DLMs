<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the copy ID from the URL
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';

// Handle deletion
if ($ID) {
    $delete_sql = "DELETE FROM book_copies WHERE ID = '" . $conn->real_escape_string($ID) . "'";

    if ($conn->query($delete_sql) === TRUE) {
        $message = "Copy deleted successfully.";
        $message_type = "success";
    } else {
        $message = "Error deleting copy: " . $conn->error;
        $message_type = "error";
    }
} else {
    $message = "No copy ID specified.";
    $message_type = "warning";
}

// Redirect to the book list after a short delay using JavaScript
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Copy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Use JavaScript to handle the page redirection -->
    <script>
        setTimeout(function() {
            history.go(-2); // Go back 2 pages in history (the previous pages)
        }, 2000); // 2-second delay before navigating back
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2>Delete Copy</h2>
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <button onclick="history.go(-2);" class="btn btn-secondary mb-3">Back to Browse</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
