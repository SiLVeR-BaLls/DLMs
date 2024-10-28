<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details for the given ID
    $stmt = $conn->prepare("SELECT users_info.IDno, users_info.Fname, users_info.Sname, user_details.course, 
                                   user_details.yrLVL AS year, user_details.section, users_info.photo
                             FROM users_info 
                             JOIN user_details ON users_info.IDno = user_details.IDno 
                             WHERE users_info.IDno = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found");
    }
} else {
    die("Invalid request");
}

// Update user details upon form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    // Handle photo upload
    $photo = $user['photo']; // Default to current photo

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // Validate image format
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['photo']['tmp_name']);

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Invalid image format. The image format should be JPG, PNG, or GIF.');</script>";
            echo '<script>window.history.back();</script>';
            exit;
        }

        // Delete the current photo from the server if it exists
        if ($photo) {
            $current_photo_path = "uploads/" . $photo;
            if (file_exists($current_photo_path)) {
                unlink($current_photo_path); // Delete the current photo
            }
        }

        // Define the directory to save the uploaded photo
        $targetDir = "uploads/";

        // Check if the uploads directory exists; if not, create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create directory with appropriate permissions
        }

        // Set the photo name and ensure it is unique
        $photo_name = pathinfo($_FILES['photo']['name'], PATHINFO_FILENAME);
        $photo_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo = $photo_name . "_" . time() . "." . $photo_extension; // Append timestamp to avoid collision
        $targetFilePath = $targetDir . $photo;

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            echo "Error uploading photo.";
        }
    }

    // Update user in the database
    $updateStmt = $conn->prepare("UPDATE users_info SET Fname = ?, Sname = ?, photo = ? WHERE IDno = ?");
    $updateStmt->bind_param("ssss", $fname, $sname, $photo, $id); // Ensure all bindings are strings
    if ($updateStmt->execute()) {
        // Update user details
        $updateDetailsStmt = $conn->prepare("UPDATE user_details SET course = ?, yrLVL = ?, section = ? WHERE IDno = ?");
        $updateDetailsStmt->bind_param("ssss", $course, $year, $section, $id);

        if ($updateDetailsStmt->execute()) {
            header("Location: ../admin.php?id=" . urlencode($id)); // Redirect back to profile
            exit;
        } else {
            echo "Error updating user details: " . $conn->error;
        }
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .body_contain {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }
    h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }
    .form-group {
        margin-bottom: 1.2rem;
    }
    label {
        display: block;
        font-weight: bold;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        color: #333;
    }
    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }
    .btn {
        display: inline-block;
        width: 48%;
        padding: 0.75rem;
        font-size: 1rem;
        text-align: center;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 1rem;
        text-decoration: none;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }
    .btn-primary:hover, .btn-secondary:hover {
        opacity: 0.9;
    }
</style>

<body>
<div class="body_contain">
    <h2>Edit User</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" name="Fname" value="<?php echo htmlspecialchars($user['Fname']); ?>" required>
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="Sname" value="<?php echo htmlspecialchars($user['Sname']); ?>" required>
        </div>
        <div class="form-group">
            <label>Course:</label>
            <input type="text" class="form-control" name="course" value="<?php echo htmlspecialchars($user['course']); ?>" required>
        </div>
        <div class="form-group">
            <label>Year Level:</label>
            <input type="text" class="form-control" name="year" value="<?php echo htmlspecialchars($user['year']); ?>" required>
        </div>
        <div class="form-group">
            <label>Section:</label>
            <input type="text" class="form-control" name="section" value="<?php echo htmlspecialchars($user['section']); ?>" required>
        </div>
        <div class="form-group">
            <label>Upload Photo:</label>
            <input type="file" class="form-control" name="photo" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="../admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
