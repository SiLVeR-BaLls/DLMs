<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the copy ID from the URL
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';

// Fetch the current copy details from the database
$sql = "SELECT * FROM book_copies WHERE ID = '" . $conn->real_escape_string($ID) . "'";
$result = $conn->query($sql);

if (!$result) {
    $message = "Error retrieving copy details: " . $conn->error;
    $message_type = "error";
    $copy_data = [];
} elseif ($result->num_rows == 0) {
    $message = "No copy found with the specified ID.";
    $message_type = "warning";
    $copy_data = [];
} else {
    $copy_data = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $B_title = isset($_POST['B_title']) ? $_POST['B_title'] : '';
    $copy_ID = isset($_POST['copy_ID']) ? $_POST['copy_ID'] : '';
    $callNumber = isset($_POST['callNumber']) ? $_POST['callNumber'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $vendor = isset($_POST['vendor']) ? $_POST['vendor'] : '';
    $fundingSource = isset($_POST['fundingSource']) ? $_POST['fundingSource'] : '';
    $Sublocation = isset($_POST['Sublocation']) ? $_POST['Sublocation'] : '';
    $rating = isset($_POST['rating']) ? $_POST['rating'] : '';

    // Update the book copy in the database
    $update_sql = "UPDATE book_copies SET 
        B_title = '" . $conn->real_escape_string($B_title) . "',
        copy_ID = '" . $conn->real_escape_string($copy_ID) . "',
        callNumber = '" . $conn->real_escape_string($callNumber) . "',
        status = '" . $conn->real_escape_string($status) . "',
        vendor = '" . $conn->real_escape_string($vendor) . "',
        fundingSource = '" . $conn->real_escape_string($fundingSource) . "',
        Sublocation = '" . $conn->real_escape_string($Sublocation) . "',
        rating = '" . $conn->real_escape_string($rating) . "' 
        WHERE ID = '" . $conn->real_escape_string($ID) . "'";

    if ($conn->query($update_sql) === TRUE) {
        $message = "Copy updated successfully.";
        $message_type = "success";
    } else {
        $message = "Error updating copy: " . $conn->error;
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Copy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
    <a href="viewcopy.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="btn btn-secondary">Return to Copy Details</a>

        <h2>Edit Copy</h2>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($copy_data)): ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="B_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="B_title" name="B_title" value="<?php echo htmlspecialchars($copy_data['B_title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="copy_ID" class="form-label">Copy ID</label>
                    <input type="text" class="form-control" id="copy_ID" name="copy_ID" value="<?php echo htmlspecialchars($copy_data['copy_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="callNumber" class="form-label">Call Number</label>
                    <input type="text" class="form-control" id="callNumber" name="callNumber" value="<?php echo htmlspecialchars($copy_data['callNumber']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($copy_data['status']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="vendor" class="form-label">Vendor</label>
                    <input type="text" class="form-control" id="vendor" name="vendor" value="<?php echo htmlspecialchars($copy_data['vendor']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fundingSource" class="form-label">Funding Source</label>
                    <input type="text" class="form-control" id="fundingSource" name="fundingSource" value="<?php echo htmlspecialchars($copy_data['fundingSource']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Sublocation" class="form-label">Sublocation</label>
                    <input type="text" class="form-control" id="Sublocation" name="Sublocation" value="<?php echo htmlspecialchars($copy_data['Sublocation']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="text" class="form-control" id="rating" name="rating" value="<?php echo htmlspecialchars($copy_data['rating']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Copy</button>
                <a href="ViewCopy.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
