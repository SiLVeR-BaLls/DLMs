<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details for the given ID
    $stmt = $conn->prepare("SELECT users_info.IDno, users_info.Fname, users_info.Sname, user_details.course, user_details.yrLVL AS year, user_details.section, users_info.photo 
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
        // Define the directory to save the uploaded photo
        $targetDir = "uploads/"; // Ensure this directory exists and is writable
        $photo = basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $photo;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            // Photo uploaded successfully
        } else {
            echo "Error uploading photo.";
        }
    }

    // Update user in the database
    $updateStmt = $conn->prepare("UPDATE users_info SET Fname = ?, Sname = ?, photo = ? WHERE IDno = ?");
    $updateStmt->bind_param("sssi", $fname, $sname, $photo, $id); // Bind photo as well
    $updateStmt->execute();
    $updateStmt->close();

    // Update user details
    $updateDetailsStmt = $conn->prepare("UPDATE user_details SET course = ?, yrLVL = ?, section = ? WHERE IDno = ?");
    $updateDetailsStmt->bind_param("ssss", $course, $year, $section, $id);

    if ($updateDetailsStmt->execute()) {
        header("Location: ../admin.php?id=" . urlencode($id)); // Redirect back to profile
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<body>
<div class="container mt-5">
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
            <?php if (!empty($user['photo'])): ?>
                <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" style="width: 50px; height: 50px; margin-top: 5px;">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="../admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
