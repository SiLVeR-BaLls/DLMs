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
    $photoPath = $user['photo']; // Default to existing photo
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Collect form data
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

            if (!empty($user['photo'])) {
                unlink($uploadDir . $user['photo']);
            }

            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $fileName)) {
                $photoPath = $fileName;
            } else {
                $message = "Failed to upload photo.";
                $message_type = "error";
            }
        }
    }

    if (empty($message)) {
        // Update users_info
        $sql = "UPDATE users_info SET Fname=?, Sname=?, Mname=?, Ename=?, gender=?, photo=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $Fname, $Sname, $Mname, $Ename, $gender, $photoPath, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating users_info: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update address
        $sql = "UPDATE address SET municipality=?, barangay=?, province=?, DOB=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $municipality, $barangay, $province, $DOB, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating address: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update user_details
        $sql = "UPDATE user_details SET college=?, course=?, yrLVL=? WHERE IDno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $college, $course, $yrLVL, $IDno);
        if (!$stmt->execute()) {
            $message = "Error updating user_details: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();

        // Update contact
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
            header("Location: ../student.php?message=success&id=" . urlencode($IDno));
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <a href="../student.php?title=<?php echo urlencode($user['IDno']); ?>" class="btn btn-primary text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
            List
        </a>

        <h2 class="text-2xl font-bold mt-6 mb-4">Edit Profile for
            <?php echo htmlspecialchars($user['IDno'] ?? ''); ?>
        </h2>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="space-y-6"><?php if ($message): ?>
        <div class="alert alert-<?php echo htmlspecialchars($message_type); ?> text-rose-950 p-4 mb-4 rounded-lg">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
            <div class="flex justify-center items-center gap-8">
    <!-- Photo -->
    <div class="space-y-2 w-1/4 p-2 border border-gray-300 rounded-md text-sm flex justify-center items-center">
        <?php if ($user['photo']): ?>
            <img src="../../../pic/User/<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" class="img-thumbnail max-w-[150px] mt-4">
        <?php endif; ?>
        <input type="file" id="photo" name="photo" accept="image/*" class="mt-4">
    </div>

    <!-- Account Information Group -->
    <div class="space-y-4">
        <div class="space-y-2">
            <label for="IDno" class="block text-sm font-medium text-gray-700">ID Number:</label>
            <input type="text" id="IDno" name="IDno" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Enter ID (if Manual)" value="<?php echo htmlspecialchars($user['IDno'] ?? ''); ?>">
        </div>
    </div>
</div>

                <!-- Student Information Group -->
                <div class="space-y-4">
                    <p class="font-semibold text-lg">Student Information</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="college" class="block text-sm font-medium text-gray-700">College:</label>
                            <input type="text" id="college" name="college" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Enter College" value="<?php echo htmlspecialchars($user_details['college'] ?? ''); ?>">
                        </div>
                        <div class="space-y-2">
                            <label for="course" class="block text-sm font-medium text-gray-700">Course:</label>
                            <input type="text" id="course" name="course" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Enter Course" value="<?php echo htmlspecialchars($user_details['course'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="yrLVL" class="block text-sm font-medium text-gray-700">Year Level:</label>
                            <input type="text" id="yrLVL" name="yrLVL" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Year Level" value="<?php echo htmlspecialchars($user_details['yrLVL'] ?? ''); ?>">
                        </div>
                    </div>
                </div>

                <!-- Personal Information Group -->
                <p class="font-semibold text-lg mt-6">Personal Information</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="Fname" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="Fname" name="Fname" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="First Name" value="<?php echo htmlspecialchars($user['Fname'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="Sname" class="block text-sm font-medium text-gray-700">Surname:</label>
                        <input type="text" id="Sname" name="Sname" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Surname" value="<?php echo htmlspecialchars($user['Sname'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="Mname" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                        <input type="text" id="Mname" name="Mname" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Middle Name" value="<?php echo htmlspecialchars($user['Mname'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="Ename" class="block text-sm font-medium text-gray-700">Extension Name:</label>
                        <input type="text" id="Ename" name="Ename" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Extension Name" value="<?php echo htmlspecialchars($user['Ename'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="DOB" class="block text-sm font-medium text-gray-700">Date of Birth :</label>
                        <input type="date" id="DOB" name="DOB" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Extension Name" value="<?php echo htmlspecialchars($address['DOB'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select name="gender" id="gender" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            <option value="Male" <?php echo ($user['gender']=='Male' ) ? 'selected' : '' ; ?>>Male</option>
                            <option value="Female" <?php echo ($user['gender']=='Female' ) ? 'selected' : '' ; ?>>Female</option>
                        </select>
                    </div>
                </div>

                <!-- Contact Information Group -->
                <p class="font-semibold text-lg mt-6">Contact Information</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="mail1" class="block text-sm font-medium text-gray-700">Email 1:</label>
                        <input type="email" id="mail1" name="mail1" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Email" value="<?php echo htmlspecialchars($contact['email1'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="mail2" class="block text-sm font-medium text-gray-700">Email 2:</label>
                        <input type="email" id="mail2" name="mail2" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Email" value="<?php echo htmlspecialchars($contact['email2'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="con1" class="block text-sm font-medium text-gray-700">Contact Number 1:</label>
                        <input type="text" id="con1" name="con1" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact['con1'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="con2" class="block text-sm font-medium text-gray-700">Contact Number 2:</label>
                        <input type="text" id="con2" name="con2" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact['con2'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Address Information Group -->
                <p class="font-semibold text-lg mt-6">Address Information</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="municipality" class="block text-sm font-medium text-gray-700">Municipality:</label>
                        <input type="text" id="municipality" name="municipality" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Municipality" value="<?php echo htmlspecialchars($address['municipality'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay:</label>
                        <input type="text" id="barangay" name="barangay" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Barangay" value="<?php echo htmlspecialchars($address['barangay'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label for="province" class="block text-sm font-medium text-gray-700">Province:</label>
                        <input type="text" id="province" name="province" class="w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Province" value="<?php echo htmlspecialchars($address['province'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Save and Reset Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="submit" name="update" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Save Changes
                    </button>
                    <button type="reset" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
