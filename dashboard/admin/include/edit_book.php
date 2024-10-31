<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the query string
$title = $_GET['title'] ?? '';

if ($title) {
    // Fetch the book details
    $sql = "SELECT * FROM Book WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $message = "No book found with that title.";
            $message_type = "error";
        } else {
            $book = $result->fetch_assoc();
        }
    } else {
        $message = "Error executing query: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();
} else {
    $message = "No book title provided.";
    $message_type = "error";
}

// Handle form submission for updating book details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Process file upload
    $photoPath = '';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        // Validate file type
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        $fileSize = $_FILES['photo']['size']; // Get the file size

        if (!in_array($fileType, $allowedTypes) || $fileSize > 2 * 1024 * 1024) { // 2 MB limit
            echo "<script>alert('Invalid image format or file too large.');</script>";
            echo '<script>window.history.back();</script>';
            exit;
        }

        $uploadDir = '../../../pic/Book/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Delete existing photo if present
        if (!empty($book['photo'])) {
            unlink($uploadDir . $book['photo']);
        }

        // Handle new file upload
        $fileName = basename($_FILES['photo']['name']);
        $photoPath = uniqid() . '_' . $fileName;
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photoPath);
    }

    // Update book information if no errors occurred
    if (empty($message)) {
        $Subtitle = $_POST['subtitle'];
        $Author = $_POST['author'];
        $Edition = $_POST['edition'];
        $LCCN = $_POST['LCCN'];
        $ISBN = $_POST['ISBN'];
        $ISSN = $_POST['ISSN'];
        $MT = $_POST['MT'];
        $ST = $_POST['ST'];
        $Place = $_POST['place'];
        $Publisher = $_POST['publisher'];
        $Pdate = $_POST['Pdate'];
        $Copyright = $_POST['copyright'];
        $Extent = $_POST['extent'];
        $Odetail = $_POST['Odetail'];
        $Size = $_POST['size'];
        $Photo = $photoPath ? $photoPath : $book['photo'];

        // Update the book in the database
        $updateSql = "UPDATE Book SET subtitle=?, author=?, edition=?, LCCN=?, ISBN=?, ISSN=?, MT=?, ST=?, place=?, publisher=?, Pdate=?, copyright=?, extent=?, Odetail=?, size=?, photo=? WHERE B_title=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssssssssssssssss", $Subtitle, $Author, $Edition, $LCCN, $ISBN, $ISSN, $MT, $ST, $Place, $Publisher, $Pdate, $Copyright, $Extent, $Odetail, $Size, $Photo, $title);

        if ($updateStmt->execute()) {
            // Redirect after a successful update
            header("Location: ../index.php?message=success&title=" . urlencode($title));
            exit();
        } else {
            $message = "Error updating book: " . $updateStmt->error;
            $message_type = "error";
        }
        $updateStmt->close();
    }
}

// Handle book deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Get the photo filename before deleting the book record
    $photoToDelete = $book['photo'] ?? '';

    $deleteSql = "DELETE FROM Book WHERE B_title = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("s", $title);

    if ($deleteStmt->execute()) {
        // Check if the photo exists and delete it from the directory
        if ($photoToDelete && file_exists("../../../pic/Book/" . $photoToDelete)) {
            unlink("../../../pic/Book/" . $photoToDelete);
        }

        // Redirect to index page after deletion
        header("Location: ../index.php?message=deleted&title=" . urlencode($title));
        exit();
    } else {
        $message = "Error deleting book: " . $deleteStmt->error;
        $message_type = "error";
    }
    $deleteStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .body_contain {
            padding: 20px;
        }
        .book-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-section {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="body_contain">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($book)): ?>
            <h4 class="book-title">Editing: <?php echo htmlspecialchars($book['B_title']); ?></h4>
            <button onclick="history.back();" class="btn btn-secondary mb-3">Back to Browse</button>
            <form method="POST" enctype="multipart/form-data" class="book-card">
                <div class="form-group">
                    <label for="photo">Book Photo:</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <?php if (!empty($book['photo'])): ?>
                        <img src="../../../pic/Book/<?php echo htmlspecialchars($book['photo']); ?>" alt="Book Photo" class="img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                    <?php endif; ?>
                </div>

                <div class="row">
                    <!-- Form fields for book details (add the fields as necessary) -->
                    <div class="form-section col-md-6">
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($book['subtitle']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>">
                    </div>
                    <!-- Add other fields similarly -->
                </div>

                <!-- Update and Delete buttons -->
                <button type="submit" name="update" class="btn btn-primary" onclick="return confirmUpdate()">Update Book</button>
                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirmDelete()">Delete Book</button>

            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    // JavaScript functions to confirm actions
    function confirmUpdate() {
        return confirm("Are you sure you want to update this book's details?");
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this book? This action cannot be undone.");
    }
</script>
</html>
