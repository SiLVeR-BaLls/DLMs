<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the user ID from the query string
$id = $_GET['id'] ?? '';

if ($id) {
    // Fetch user info
    $sql = "SELECT * FROM users_info WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            $message = "No user found with that ID.";
            $message_type = "error";
        }
    }
    $stmt->close();

    // Fetch address
    $sql = "SELECT * FROM address WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $address = $result->fetch_assoc();
        }
    }
    $stmt->close();

    // Fetch user details
    $sql = "SELECT * FROM user_details WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user_details = $result->fetch_assoc();
        }
    }
    $stmt->close();

    // Fetch contact
    $sql = "SELECT * FROM contact WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $contact = $result->fetch_assoc();
        }
    }
    $stmt->close();
} else {
    $message = "No user ID provided.";
    $message_type = "error";
}

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Process file upload
    $photoPath = $user['photo']; // Default to existing photo
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Form input data
    $IDno = $_POST['IDno'];
    $Fname = $_POST['Fname'];
    $Sname = $_POST['Sname'];
    $Mname = $_POST['Mname'];
    $Ename = $_POST['Ename'] ?? '';
    $gender = $_POST['gender'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $province = $_POST['province'];
    $DOB = $_POST['DOB'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $yrLVL = $_POST['yrLVL'];
    $email1 = $_POST['mail1'];
    $email2 = $_POST['mail2'] ?? '';
    $con1 = $_POST['con1'];
    $con2 = $_POST['con2'] ?? '';

    // Validate and handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        $fileSize = $_FILES['photo']['size'];

        if (!in_array($fileType, $allowedTypes) || $fileSize > 2 * 1024 * 1024) {
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
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $fileName)) {
                $photoPath = $fileName;
            } else {
                $message = "Failed to upload photo.";
                $message_type = "error";
            }
        }
    }

    // If no errors occurred, update the user information
    if (empty($message)) {
        // Update users_info table
        $sql = "UPDATE users_info SET Fname=?, Sname=?, Mname=?, Ename=?, gender=?, photo=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $Fname, $Sname, $Mname, $Ename, $gender, $photoPath, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating users_info: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update address table
        $sql = "UPDATE address SET municipality=?, barangay=?, province=?, DOB=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $municipality, $barangay, $province, $DOB, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating address: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update user_details table
        $sql = "UPDATE user_details SET college=?, course=?, yrLVL=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $college, $course, $yrLVL, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating user_details: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update contact table
        $sql = "UPDATE contact SET email1=?, email2=?, con1=?, con2=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email1, $email2, $con1, $con2, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating contact: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Redirect after a successful update
        if (empty($message)) {
            header("Location: ../admin.php?message=success&id=" . urlencode($IDno));
            exit();
        }
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
        .box { width: 100%; padding: 8px; }
        .tile { font-weight: bold; }
        .group-box { margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="body_contain">
<a href="../admin.php?title=<?php echo urlencode($user['IDno']); ?>" class="btn btn-primary">list</a>

    <h2>Edit Profile for <?php echo htmlspecialchars($user['IDno'] ?? ''); ?></h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo htmlspecialchars($message_type); ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-step">

            <!-- photo  -->
            <div class="form-group">
                <?php if ($user['photo']): ?>
                    <img src="../../../pic/User/<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" class="img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                <?php endif; ?>
                <label>Upload Photo:</label>
                <input type="file" class="form-control" name="photo" accept="image/*">
            </div>

            <p class="top"><b class="tile">Site Information</b></p>
            <div class="group-1">
                <div class="group-box">
                    <p class="tile">Account Information</p>
                    <div class="text-group">
                        <label for="IDno">ID Number:</label>
                        <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)" value="<?php echo htmlspecialchars($user['IDno'] ?? ''); ?>"  >
                    </div>
                </div>
                <div class="group-box">
                    <p class="tile">Student Information</p>
                    <div class="text-group">
                        <label for="college">College:</label>
                        <input type="text" id="college" name="college" class="box" placeholder="Enter College" value="<?php echo htmlspecialchars($user_details['college'] ?? ''); ?>">
                    </div>
                    <div class="text-group">
                        <label for="course">Course:</label>
                        <input type="text" id="course" name="course" class="box" placeholder="Enter Course" value="<?php echo htmlspecialchars($user_details['course'] ?? ''); ?>">
                    </div>
                    <div class="text-group">
                        <label for="yrLVL">Year Level:</label>
                        <input type="text" id="yrLVL" name="yrLVL" class="box" placeholder="Year Level" value="<?php echo htmlspecialchars($user_details['yrLVL'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <p class="top"><b class="tile">Personal Information</b></p>
            <div class="group-2">
                <div class="group-box">
                    <label for="Fname">First Name:</label>
                    <input type="text" id="Fname" name="Fname" class="box" placeholder="First Name" value="<?php echo htmlspecialchars($user['Fname'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="Sname">Surname:</label>
                    <input type="text" id="Sname" name="Sname" class="box" placeholder="Surname" value="<?php echo htmlspecialchars($user['Sname'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="Mname">Middle Name:</label>
                    <input type="text" id="Mname" name="Mname" class="box" placeholder="Middle Name" value="<?php echo htmlspecialchars($user['Mname'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="Ename">Extension Name:</label>
                    <input type="text" id="Ename" name="Ename" class="box" placeholder="Extension Name" value="<?php echo htmlspecialchars($user['Ename'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" class="box">
                        <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
            </div>

            <p class="top"><b class="tile">Contact Information</b></p>
            <div class="group-3">
                <div class="group-box">
                    <label for="mail1">Email 1:</label>
                    <input type="email" id="mail1" name="mail1" class="box" placeholder="Email" value="<?php echo htmlspecialchars($contact['email1'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="mail2">Email 2:</label>
                    <input type="email" id="mail2" name="mail2" class="box" placeholder="Email" value="<?php echo htmlspecialchars($contact['email2'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="con1">Contact Number 1:</label>
                    <input type="text" id="con1" name="con1" class="box" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact['con1'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="con2">Contact Number 2:</label>
                    <input type="text" id="con2" name="con2" class="box" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact['con2'] ?? ''); ?>">
                </div>
            </div>

            <p class="top"><b class="tile">Address Information</b></p>
            <div class="group-4">
                <div class="group-box">
                    <label for="municipality">Municipality:</label>
                    <input type="text" id="municipality" name="municipality" class="box" placeholder="Municipality" value="<?php echo htmlspecialchars($address['municipality'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="barangay">Barangay:</label>
                    <input type="text" id="barangay" name="barangay" class="box" placeholder="Barangay" value="<?php echo htmlspecialchars($address['barangay'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="province">Province:</label>
                    <input type="text" id="province" name="province" class="box" placeholder="Province" value="<?php echo htmlspecialchars($address['province'] ?? ''); ?>">
                </div>
                <div class="group-box">
                    <label for="DOB">Date of Birth:</label>
                    <input type="date" id="DOB" name="DOB" class="box" value="<?php echo htmlspecialchars($address['DOB'] ?? ''); ?>">
                </div>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
