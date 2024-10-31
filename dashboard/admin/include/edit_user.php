<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the user ID from the query string
$id = $_GET['id'] ?? '';

if ($id) {
    // Fetch the user details
    $sql = "SELECT * FROM users_info WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $message = "No user found with that ID.";
            $message_type = "error";
        } else {
            $user = $result->fetch_assoc();
        }
    } else {
        $message = "Error executing query: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();
} else {
    $message = "No user ID provided.";
    $message_type = "error";
}

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Process file upload
    $photoPath = '';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        // Validate file type
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        $fileSize = $_FILES['photo']['size'];

        if (!in_array($fileType, $allowedTypes) || $fileSize > 2 * 1024 * 1024) { // 2 MB limit
            $message = "Invalid image format or file too large.";
            $message_type = "error";
        } else {
            $uploadDir = '../../../pic/User/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Delete existing photo if present
            if (!empty($user['photo'])) {
                unlink($uploadDir . $user['photo']);
            }

            // Handle new file upload
            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $fileName);
            $photoPath = $fileName; // Save the new photo path
        }
    }

    // Update user information if no errors occurred
    if (empty($message)) {
        // Get other form data
        $Fname = $_POST['Fname'];
        $Sname = $_POST['Sname'];
        $Mname = $_POST['Mname'] ?? '';
        $Ename = $_POST['Ename'] ?? '';
        $gender = $_POST['gender'] ?? '';

        // Use the existing photo if no new one was uploaded
        $Photo = $photoPath ?: $user['photo'];

        // Update the users_info table
        $updateSql = "UPDATE users_info SET Fname=?, Sname=?, Mname=?, Ename=?, gender=?, photo=? WHERE IDno=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssssss", $Fname, $Sname, $Mname, $Ename, $gender, $Photo, $id);

        if ($updateStmt->execute()) {
            // Redirect after a successful update
            header("Location: ../admin.php?message=success&id=" . urlencode($id));
            exit();
        } else {
            $message = "Error updating user: " . $updateStmt->error;
            $message_type = "error";
        }
        $updateStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .body_contain { padding: 20px; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="body_contain">
    <h2>Edit Profile for <?php echo htmlspecialchars($user['IDno']); ?></h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
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
            <label>Middle Name:</label>
            <input type="text" class="form-control" name="Mname" value="<?php echo htmlspecialchars($user['Mname']); ?>">
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select class="form-control" name="gender" required>
                <option value="m" <?php echo ($user['gender'] == 'm') ? 'selected' : ''; ?>>Male</option>
                <option value="f" <?php echo ($user['gender'] == 'f') ? 'selected' : ''; ?>>Female</option>
                <option value="o" <?php echo ($user['gender'] == 'o') ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <?php if (!empty($user['photo'])): ?>
                <img src="../../../pic/User/<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" class="img-thumbnail" style="max-width: 200px; margin-top: 10px;">
            <?php endif; ?>
            <label>Upload Photo:</label>
            <input type="file" class="form-control" name="photo" accept="image/*">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="../admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
