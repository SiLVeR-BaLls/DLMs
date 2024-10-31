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

    // Form input data
    $IDno = $_POST['IDno'];
    $U_type = $_POST['U_type'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $yrLVL = $_POST['yrLVL'];
    $Fname = $_POST['Fname'];
    $Sname = $_POST['Sname'];
    $Mname = $_POST['Mname'];
    $gender = $_POST['gender'];
    $DOB = $_POST['DOB'];
    $Ename = $_POST['Ename'] ?? '';
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $province = $_POST['province'];
    $con1 = $_POST['con1'];
    $con2 = $_POST['con2'] ?? '';
    $mail1 = $_POST['mail1'];
    $mail2 = $_POST['mail2'] ?? '';

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
        $Photo = $photoPath ?: $user['photo'];

        // Update the users_info table
        $updateSql = "UPDATE users_info SET IDno=?, U_type=?, college=?, course=?, yrLVL=?, Fname=?, Sname=?, Mname=?, gender=?, DOB=?, Ename=?, municipality=?, barangay=?, province=?, con1=?, con2=?, mail1=?, mail2=?, photo=? WHERE IDno=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssssssssssssssssss", $IDno, $U_type, $college, $course, $yrLVL, $Fname, $Sname, $Mname, $gender, $DOB, $Ename, $municipality, $barangay, $province, $con1, $con2, $mail1, $mail2, $Photo, $id);

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
        .box { width: 100%; padding: 8px; }
        .tile { font-weight: bold; }
        .group-box { margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="body_contain">
    <h2>Edit Profile for <?php echo htmlspecialchars($user['IDno'] ?? ''); ?></h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo htmlspecialchars($message_type); ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-step">
            <p class="top"><b class="tile">Site Information</b></p>
            <div class="group-1">
                <div class="group-box">
                    <p class="tile">Account Information</p>
                    <div class="text-group">
                        <label for="IDno">ID Number:</label>
                        <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)" value="<?php echo htmlspecialchars($user['IDno'] ?? ''); ?>" required>
                    </div>
                    <div class="text-group">
                        <label for="U_type">User Type</label>
                        <select class="box" name="U_type" id="U_type" required>
                            <option value="" disabled>Select User Type</option>
                            <option value="student" <?php echo (isset($user['U_type']) && $user['U_type'] == 'student') ? 'selected' : ''; ?>>Student</option>
                            <option value="professor" <?php echo (isset($user['U_type']) && $user['U_type'] == 'professor') ? 'selected' : ''; ?>>Professor</option>
                            <option value="staff" <?php echo (isset($user['U_type']) && $user['U_type'] == 'staff') ? 'selected' : ''; ?>>Staff</option>
                        </select>
                    </div>
                </div>
                <div class="group-box">
                    <p class="tile">Student Information</p>
                    <div class="text-group">
                        <label for="college">College</label>
                        <select class="box" id="college" name="college" required>
                            <option value="" disabled>Select College</option>
                            <option value="cas" <?php echo (isset($user['college']) && $user['college'] == 'cas') ? 'selected' : ''; ?>>College of Arts and Sciences</option>
                            <option value="cea" <?php echo (isset($user['college']) && $user['college'] == 'cea') ? 'selected' : ''; ?>>College of Engineering and Architecture</option>
                            <option value="coe" <?php echo (isset($user['college']) && $user['college'] == 'coe') ? 'selected' : ''; ?>>College of Education</option>
                            <option value="cit" <?php echo (isset($user['college']) && $user['college'] == 'cit') ? 'selected' : ''; ?>>College of Industrial Technology</option>
                        </select>
                    </div>
                    <div class="text-group">
                        <label for="course">Course</label>
                        <select class="box" id="course" name="course" required>
                            <option value="" disabled>Select Course</option>
                            <option value="course1" <?php echo (isset($user['course']) && $user['course'] == 'course1') ? 'selected' : ''; ?>>Course 1</option>
                            <option value="course2" <?php echo (isset($user['course']) && $user['course'] == 'course2') ? 'selected' : ''; ?>>Course 2</option>
                            <option value="course3" <?php echo (isset($user['course']) && $user['course'] == 'course3') ? 'selected' : ''; ?>>Course 3</option>
                        </select>
                    </div>
                    <div class="text-group">
                        <label for="yrLVL">Year and Section</label>
                        <select class="box" id="yrLVL" name="yrLVL" required>
                            <option value="" disabled>Select Year and Section</option>
                            <?php for ($year = 1; $year <= 5; $year++): ?>
                                <?php foreach (['A', 'B', 'C', 'D'] as $section): ?>
                                    <option value="<?php echo $year . ' ' . $section; ?>" <?php echo (isset($user['yrLVL']) && $user['yrLVL'] == "$year $section") ? 'selected' : ''; ?>>
                                        <?php echo $year . ' ' . $section; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-step form-step-active">
            <p class="top"><b>User Information</b></p>
            <div class="group1">
                <div class="text-group">
                    <label for="Fname">Firstname</label>
                    <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname" value="<?php echo htmlspecialchars($user['Fname'] ?? ''); ?>" required>
                </div>
                <div class="text-group">
                    <label for="Sname">Surname</label>
                    <input id="Sname" name="Sname" class="box" type="text" placeholder="Surname" value="<?php echo htmlspecialchars($user['Sname'] ?? ''); ?>" required>
                </div>
                <div class="text-group">
                    <label for="Mname">Middle Name</label>
                    <input id="Mname" name="Mname" class="box" type="text" placeholder="Middle Name" value="<?php echo htmlspecialchars($user['Mname'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="group-1">
                <div class="group-box">
                    <p class="tile">Basic Information</p>
                    <div class="text-group">
                        <label for="gender">Gender</label>
                        <select class="box" name="gender" id="gender" required>
                            <option value="" disabled>Select Gender</option>
                            <option value="m" <?php echo (isset($user['gender']) && $user['gender'] == 'm') ? 'selected' : ''; ?>>Male</option>
                            <option value="f" <?php echo (isset($user['gender']) && $user['gender'] == 'f') ? 'selected' : ''; ?>>Female</option>
                            <option value="o" <?php echo (isset($user['gender']) && $user['gender'] == 'o') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="text-group">
                        <label for="DOB">Birthdate</label>
                        <input id="DOB" name="DOB" class="box" type="date" value="<?php echo htmlspecialchars($user['DOB'] ?? ''); ?>" required>
                    </div>
                    <div class="text-group">
                        <label for="Ename">Extension</label>
                        <input class="box" name="Ename" id="Ename" placeholder="Enter Extension" value="<?php echo htmlspecialchars($user['Ename'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Address Section -->
                <div class="group-box">
                    <p class="tile">Address</p>
                    <div class="text-group">
                        <label for="municipality">Municipality/City</label>
                        <input id="municipality" name="municipality" class="box" type="text" placeholder="Enter Municipality/City" value="<?php echo htmlspecialchars($user['municipality'] ?? ''); ?>" required>
                    </div>
                    <div class="text-group">
                        <label for="barangay">Barangay</label>
                        <input id="barangay" name="barangay" class="box" type="text" placeholder="Enter Barangay" value="<?php echo htmlspecialchars($user['barangay'] ?? ''); ?>" required>
                    </div>
                    <div class="text-group">
                        <label for="province">Province</label>
                        <input id="province" name="province" class="box" type="text" placeholder="Enter Province" value="<?php echo htmlspecialchars($user['province'] ?? ''); ?>" required>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="group-box">
                    <p class="tile">Contact</p>
                    <div class="text-group">
                        <label for="con1">Contact No. 1</label>
                        <input id="con1" name="con1" class="box" type="text" placeholder="09*********" value="<?php echo htmlspecialchars($user['con1'] ?? ''); ?>" required pattern="^\d{11}$" title="Please enter a valid 11-digit number">
                    </div>
                    <div class="text-group">
                        <label for="con2">Contact No. 2</label>
                        <input id="con2" name="con2" class="box" type="text" placeholder="09*********" value="<?php echo htmlspecialchars($user['con2'] ?? ''); ?>" pattern="^\d{11}$" title="Please enter a valid 11-digit number">
                    </div>
                    <div class="text-group">
                        <label for="mail1">Email 1</label>
                        <input id="mail1" name="mail1" class="box" type="email" placeholder="sample@gmail.com" value="<?php echo htmlspecialchars($user['mail1'] ?? ''); ?>" required>
                    </div>
                    <div class="text-group">
                        <label for="mail2">Email 2</label>
                        <input id="mail2" name="mail2" class="box" type="email" placeholder="sample@gmail.com" value="<?php echo htmlspecialchars($user['mail2'] ?? ''); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="../admin.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
