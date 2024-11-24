<?php

// Combined query with JOINs
$combinedQuery = "
    SELECT 
        contact.email1, contact.email2, contact.con1, contact.con2,
        address.municipality, address.barangay, address.province, address.DOB,
        users_info.Fname,users_info.IDno, users_info.Sname, users_info.Mname, users_info.Ename, users_info.gender, users_info.photo,
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
                <a href="student.php"><strong class="text-gray-900"><?php echo htmlspecialchars($userData['Fname']); ?></a></strong>
            </span>
        <?php else: ?>
            <span class="text-sm text-gray-700 font-medium">Hello, <strong class="text-gray-900">Guest</strong></span>
        <?php endif; ?>


        <label for=""><a href="../logout.php" id="logoutBtn"> Logout</a></label>


    </div>
</div>

<!-- Display other user details (student or student) if needed
<?php if ($userData): ?>
    <div class="user-details">
        <h2>User Details</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($userData['Fname']) . " " . htmlspecialchars($userData['Sname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email1']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($userData['course']); ?></p>
    </div>
<?php endif; ?> -->
 <!-- Modal for confirmation -->
 <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg text-center">
            <h2 class="text-xl font-semibold mb-2">Confirm Log Out?</h2>
            <p class="mb-4">Are you sure to leave the page?</p>
            <div class="flex justify-around">
                <button id="confirmBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-500

">Confirm</button>
                <button id="cancelBtn" class="bg-blue-300 px-4 py-2 rounded hover:bg-blue-500
">Cancel</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for modal and toggles -->
<script>
        // Modal functionality
        const modal = document.getElementById("myModal");
        const logoutBtn = document.getElementById("logoutBtn");
        const confirmBtn = document.getElementById("confirmBtn");
        const cancelBtn = document.getElementById("cancelBtn");

        logoutBtn.addEventListener("click", function (event) {
            event.preventDefault();
            modal.classList.remove("hidden");
        });
        confirmBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
            window.location.href = "../logout.php";
        });
        cancelBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
        window.addEventListener("click", function (event) {
            if (event.target == modal) {
                modal.classList.add("hidden");
            }
        });
    </script>