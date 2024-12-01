<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the query string
$title = $_GET['title'] ?? '';

if ( $title) {
    
    // Fetch book
    $sql = "SELECT * FROM book WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $title);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            $message = "No book found with that ID.";
            $message_type = "error";
        }
    }
    $stmt->close();

    // Fetch alternatetitle
    $sql = "SELECT * FROM alternatetitle WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $title);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $alternatetitle = $result->fetch_assoc();
        }
    }
    $stmt->close();

    // Fetch book
    $sql = "SELECT * FROM book WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $title);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $book = $result->fetch_assoc();
        }
    }
    $stmt->close();

    // Fetch resource
    $sql = "SELECT * FROM resource WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $title);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $resource = $result->fetch_assoc();
        }
    }
    $stmt->close();

        // Fetch series
        $sql = "SELECT * FROM series WHERE B_title = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",  $title);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $series = $result->fetch_assoc();
            }
        }
        $stmt->close();

    // Fetch subject
        $sql = "SELECT * FROM subject WHERE B_title = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",  $title);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $subject = $result->fetch_assoc();
            }
        }
    $stmt->close();

} else {
    $message = "No book title provided.";
    $message_type = "error";
}

// Handle form submission for updating book details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Process file upload
    $photoPath = $book['photo']; // Default to existing photo
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types



    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        $fileSize = $_FILES['photo']['size'];

        if (!in_array($fileType, $allowedTypes) || $fileSize > 2 * 1024 * 1024) { // 2 MB limit
            $message = "Invalid image format or file too large.";
            $message_type = "error";
        } else {
            $uploadDir = '../../../pic/Book/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Delete existing photo if present
            if (!empty($book['photo'])) {
                unlink($uploadDir . $book['photo']);
            }

            // Handle new file upload
            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $fileName)) {
                $photoPath = $fileName;
            } else {
                $message = "Failed to upload photo.";
                $message_type = "error";
            }
        }
    }

  // Update book information if no errors occurred
  if (empty($message)) {
    // Update book table
    $sql = "UPDATE book SET subtitle=?, author=?, edition=?, LCCN=?, ISBN=?, ISSN=?, MT=?, ST=?, place=?, publisher=?, Pdate=?, copyright=?, extent=?, Odetail=?, size=?, photo=? WHERE B_title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssss", $_POST['subtitle'], $_POST['author'], $_POST['edition'], $_POST['LCCN'], $_POST['ISBN'], $_POST['ISSN'], $_POST['MT'], $_POST['ST'], $_POST['place'], $_POST['publisher'], $_POST['Pdate'], $_POST['copyright'], $_POST['extent'], $_POST['Odetail'], $_POST['size'], $photoPath, $title);
    if (!$stmt->execute()) {
        $message = "Error updating book: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();

    // Update alternatetitle table
    $sql = "UPDATE alternatetitle SET UTitle=?, VForm=?, SUTitle=? WHERE B_title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $_POST['UTitle'], $_POST['VForm'], $_POST['SUTitle'], $title);
    if (!$stmt->execute()) {
        $message = "Error updating alternatetitle: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();

    // Update resources table
    $sql = "UPDATE resource SET url=?, Description=? WHERE B_title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $_POST['url'], $_POST['Description'], $title);
    if (!$stmt->execute()) {
        $message = "Error updating resources: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();

    // Update series table
    $sql = "UPDATE series SET volume=?, IL=?, lexille=?, F_and_P=? WHERE B_title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $_POST['volume'], $_POST['IL'], $_POST['lexille'], $_POST['F_and_P'], $title);
    if (!$stmt->execute()) {
        $message = "Error updating series: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();

    // Update subject table
    $sql = "UPDATE subject SET Sub_Head=?, Sub_Head_input=?, Sub_Body_1=?, Sub_input_1=?, Sub_Body_2=?, Sub_input_2=?, Sub_Body_3=?, Sub_input_3=? WHERE B_title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $_POST['Sub_Head'], $_POST['Sub_Head_input'], $_POST['Sub_Body_1'], $_POST['Sub_input_1'], $_POST['Sub_Body_2'], $_POST['Sub_input_2'], $_POST['Sub_Body_3'], $_POST['Sub_input_3'], $title);
    if (!$stmt->execute()) {
        $message = "Error updating subject: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();
    
    // Redirect after a successful update
    header("Location: ../ViewBook.php?message=success&title=" . urlencode($title));
    exit();
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
            <div class="alert alert-<?php echo htmlspecialchars($message_type); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($book)): ?>
            <h4 class="book-title">Editing: <?php echo htmlspecialchars($book['B_title']); ?></h4>
            <button onclick="history.back();" class="btn btn-secondary mb-3">Back to Browse</button>
            <form method="POST" enctype="multipart/form-data" class="book-card">
              

                    <!-- photo  -->
            <div class="form-group">
                <label for="photo" >Upload Photo:</label>
                <?php if ($book['photo']): ?>
                    <img src="../../../pic/Book/<?php echo htmlspecialchars($book['photo']); ?>" alt="book Photo" class="img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                <?php endif; ?>
                <input type="file" id="photo" class="form-control" name="photo" accept="image/*">
            </div>
            
                        <!-- brief title -->
                <div class="row">
                    <h3>Title</h3>
                    <!-- Form fields for book details (add the fields as necessary) -->
                    <div class="form-section col-md-6">
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($book['subtitle']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="edition">Edition:</label>
                        <input type="text" class="form-control" id="edition" name="edition" value="<?php echo htmlspecialchars($book['edition']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="LCCN">LCCN:</label>
                        <input type="text" class="form-control" id="LCCN" name="LCCN" value="<?php echo htmlspecialchars($book['LCCN']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="ISBN">ISBN:</label>
                        <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo htmlspecialchars($book['ISBN']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="ISSN">ISSN:</label>
                        <input type="text" class="form-control" id="ISSN" name="ISSN" value="<?php echo htmlspecialchars($book['ISSN']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="MT">Material Type:</label>
                        <input type="text" class="form-control" id="MT" name="MT" value="<?php echo htmlspecialchars($book['MT']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="ST">Shelf Type:</label>
                        <input type="text" class="form-control" id="ST" name="ST" value="<?php echo htmlspecialchars($book['ST']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="place">Place:</label>
                        <input type="text" class="form-control" id="place" name="place" value="<?php echo htmlspecialchars($book['place']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="publisher">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="Pdate">Publication Date:</label>
                        <input type="date" class="form-control" id="Pdate" name="Pdate" value="<?php echo htmlspecialchars($book['Pdate']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="copyright">Copyright:</label>
                        <input type="text" class="form-control" id="copyright" name="copyright" value="<?php echo htmlspecialchars($book['copyright']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="extent">Extent:</label>
                        <input type="text" class="form-control" id="extent" name="extent" value="<?php echo htmlspecialchars($book['extent']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="Odetail">Other Details:</label>
                        <textarea class="form-control" id="Odetail" name="Odetail"><?php echo htmlspecialchars($book['Odetail']); ?></textarea>
                    </div>
                    <div class="form-section col-md-6">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" id="size" name="size" value="<?php echo htmlspecialchars($book['size']); ?>">
                    </div>
                </div>

                        <!-- series -->
                <div class="row">
                        <h3>series</h3>
                    <div class="form-section col-md-6">
                        <label for="volume">Volume:</label>
                        <input type="text" class="form-control" id="volume" name="volume" value="<?php echo htmlspecialchars($series['volume']); ?>">
                    </div>

                    <div class="form-section col-md-6">
                        <label for="IL">Interest Level:</label>
                        <input type="text" class="form-control" id="IL" name="IL" value="<?php echo htmlspecialchars($series['IL']); ?>">
                    </div>

                    <div class="form-section col-md-6">
                        <label for="lexille">Lexille:</label>
                        <input type="text" class="form-control" id="lexille" name="lexille" value="<?php echo htmlspecialchars($series['lexille']); ?>">
                    </div>

                    <div class="form-section col-md-6">
                        <label for="F_and_P">Fountas and Pinnell:</label>
                        <input type="text" class="form-control" id="F_and_P" name="F_and_P" value="<?php echo htmlspecialchars($series['F_and_P']); ?>">
                    </div>
                </div>

                        <!-- subject -->
                <div class="row">
                    <h3>Subject</h3>
                    <div class="row">
                        <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_Head" name="Sub_Head" value="<?php echo htmlspecialchars($subject['Sub_Head']); ?>">
                        </div>
                        <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_Head_input" name="Sub_Head_input" value="<?php echo htmlspecialchars($subject['Sub_Head_input']); ?>">
                        </div>
                    </div>

                    <div class="row">
                    <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_Body_1" name="Sub_Body_1" value="<?php echo htmlspecialchars($subject['Sub_Body_1']); ?>">
                        </div>
                        <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_input_1" name="Sub_input_1" value="<?php echo htmlspecialchars($subject['Sub_input_1']); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-section col-md-6">
                                <input type="text" class="form-control" id="Sub_Body_2" name="Sub_Body_2" value="<?php echo htmlspecialchars($subject['Sub_Body_2']); ?>">
                            </div>
                            <div class="form-section col-md-6">
                                <input type="text" class="form-control" id="Sub_input_2" name="Sub_input_2" value="<?php echo htmlspecialchars($subject['Sub_input_2']); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_Body_3" name="Sub_Body_3" value="<?php echo htmlspecialchars($subject['Sub_Body_3']); ?>">
                        </div>
                        <div class="form-section col-md-6">
                            <input type="text" class="form-control" id="Sub_input_3" name="Sub_input_3" value="<?php echo htmlspecialchars($subject['Sub_input_3']); ?>">
                        </div>
                    </div>
                </div>
            
                        <!-- resources -->
                <div  class="row">
                    <h3>Resources</h3>
                    <div class="form-section col-md-6">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?php echo htmlspecialchars($resource['url']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="Description">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description" value="<?php echo htmlspecialchars($resource['Description']); ?>">
                    </div>
                </div>

                
                       <!-- alternate entries -->
                <div  class="row">
                    <h3>Alternate Entries</h3>
                    <div class="form-section col-md-6">
                        <label for="UTitle">Uniform Title</label>
                        <input type="text" class="form-control" id="UTitle" name="UTitle" value="<?php echo htmlspecialchars($alternatetitle['UTitle']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="VForm">Varying Formm</label>
                        <input type="text" class="form-control" id="VForm" name="VForm" value="<?php echo htmlspecialchars($alternatetitle['VForm']); ?>">
                    </div>
                    <div class="form-section col-md-6">
                        <label for="SUTitle">Series Uniform Title</label>
                        <input type="text" class="form-control" id="SUTitle" name="SUTitle" value="<?php echo htmlspecialchars($alternatetitle['SUTitle']); ?>">
                    </div>
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
