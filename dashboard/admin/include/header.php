
<div class="flex sticky top-0 shadow-md z-10 items-center justify-between bg-gray-200 w-full h-[3rem] shadow-md">
    <!-- Left side: Logo and Title -->
    <div class="flex items-center">
        <a href="#">
            <img src="../../Registration/pic/logo wu.png" alt="Logo" class="w-12 m-4">
        </a>
        <strong class="text-lg font-semibold text-gray-800">
            Digital Library Management System
        </strong>
    </div>
    
    <!-- Right side: User's First Name -->
    <div class="flex items-center space-x-4 m-4">
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
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($userData['course']); ?></p>
    </div>
<?php endif; ?> -->
