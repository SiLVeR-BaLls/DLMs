<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the copy ID from the URL
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';

// Fetch copy details from the database
$sql = "SELECT * FROM book_copies WHERE ID = '" . $conn->real_escape_string($ID) . "'";
$result = $conn->query($sql);

if (!$result) {
    $message = "Error retrieving copy details: " . $conn->error;
    $message_type = "error";
} elseif ($result->num_rows == 0) {
    $message = "No copy found with the specified ID.";
    $message_type = "warning";
    $copy_data = [];
} else {
    $copy_data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Copy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
    <a href="BookList.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="btn btn-secondary">Return to Copy Details</a>

        <h2>View Copy Details</h2>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($copy_data)): ?>
            <ul class="list-group">
                <li class="list-group-item"><strong>ID:</strong> <?php echo htmlspecialchars($copy_data['ID']); ?></li>
                <li class="list-group-item"><strong>Title:</strong> <?php echo htmlspecialchars($copy_data['B_title']); ?></li>
                <li class="list-group-item"><strong>Copy ID:</strong> <?php echo htmlspecialchars($copy_data['copy_ID']); ?></li>
                <li class="list-group-item"><strong>Call Number:</strong> <?php echo htmlspecialchars($copy_data['callNumber']); ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?php echo htmlspecialchars($copy_data['status']); ?></li>
                <li class="list-group-item"><strong>Vendor:</strong> <?php echo htmlspecialchars($copy_data['vendor']); ?></li>
                <li class="list-group-item"><strong>Funding Source:</strong> <?php echo htmlspecialchars($copy_data['fundingSource']); ?></li>
                <li class="list-group-item"><strong>Sublocation:</strong> <?php echo htmlspecialchars($copy_data['Sublocation']); ?></li>
                <li class="list-group-item"><strong>Rating:</strong> <?php echo htmlspecialchars($copy_data['rating']); ?></li>
            </ul>
            <a href="edit_copy.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="btn btn-warning mt-3">Edit Copy</a>
            <a href="delete_copy.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="btn btn-danger mt-3">Delete Copy</a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
