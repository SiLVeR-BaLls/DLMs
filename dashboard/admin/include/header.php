<?php

// Combined query with JOINs
$combinedQuery = "
    SELECT 
        contact.email1, contact.email2, contact.con1, contact.con2,
        address.municipality, address.barangay, address.province, address.DOB,
        users_info.Fname, users_info.Sname, users_info.Mname, users_info.Ename, users_info.gender, users_info.photo,
        user_details.college, user_details.course, user_details.yrLVL, user_details.A_LVL, user_details.status
    FROM contact
    JOIN address ON contact.IDno = address.IDno
    JOIN users_info ON contact.IDno = users_info.IDno
    JOIN user_details ON contact.IDno = user_details.IDno
    WHERE contact.IDno = ?
";

// Prepare and execute the combined query
$stmt = $conn->prepare($combinedQuery);
$stmt->bind_param("s", $idno);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc(); // Fetch data as an associative array


?>
<div class="flex items-center justify-between bg-gray-200 p-4 shadow-md">
    <!-- Left side: Logo and Title -->
    <div class="flex items-center">
        <a href="#">
            <img src="../../Registration/pic/logo wu.png" alt="Logo" class="h-12 w-12 mr-4">
        </a>
        <strong class="text-lg font-semibold text-gray-800">
            Digital Library Management System
        </strong>
    </div>
    
    <!-- Right side: User's First Name -->
    <div class="flex items-center space-x-4">
        <?php if ($userData): ?>
            <span class="text-sm text-gray-700 font-medium">Hello, 
                <strong class="text-gray-900"><?php echo htmlspecialchars($userData['Fname']); ?></strong>
            </span>
        <?php else: ?>
            <span class="text-sm text-gray-700 font-medium">Hello, <strong class="text-gray-900">Guest</strong></span>
        <?php endif; ?>
    </div>
</div>

<!-- Display other user details (admin or student) if needed
<?php if ($userData): ?>
    <div class="user-details">
        <h2>User Details</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($userData['Fname']) . " " . htmlspecialchars($userData['Sname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email1']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($userData['course']); ?></p>
    </div>
<?php endif; ?> -->
