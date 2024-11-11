<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.75rem;
            margin-bottom: 15px;
            color: #333;
            font-weight: 700;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .info-item {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .info-item label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #4A4A4A;
        }

        .photo-container {
            text-align: center;
            position: relative;
        }

        .photo-container img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #007bff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .photo-container:hover img {
            transform: scale(1.05);
        }

        .no-photo {
            display: inline-block;
            padding: 12px;
            background-color: #e0e0e0;
            border-radius: 5px;
            text-align: center;
            color: #333;
            font-size: 1.2rem;
        }

        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .section .info-item span {
            color: #555;
        }

        .section .info-item span strong {
            color: #333;
        }

        /* Footer Styling */
        .footer {
            text-align: center;
            font-size: 1rem;
            color: #555;
            margin-top: 40px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 8px;
        }

    </style>
</head>
<body class="bg-gray-100">

    <div class="profile-container">

        <!-- Header: Buttons for ID card and Edit Profile -->
        <div class="flex justify-between mb-6">
            <a href="../ID_card.php?id=<?php echo htmlspecialchars($_SESSION['admin']['IDno']); ?>" class="button">View ID</a>
            <a href="include/edit_user.php?id=<?php echo htmlspecialchars($_SESSION['admin']['IDno']); ?>" class="button">Edit Profile</a>
        </div>

        <!-- Welcome Message -->
        <h1 class="title">Welcome, <?php echo htmlspecialchars($userData['Fname']); ?>!</h1>

        <!-- Profile Picture Section -->
        <div class="section text-center">
            <h2>Your Profile Picture</h2>
            <div class="photo-container mx-auto">
                <?php if (!empty($userData['photo'])): ?>
                    <img src="../../pic/User/<?php echo htmlspecialchars($userData['photo']); ?>" alt="User Photo">
                <?php else: ?>
                    <span class="no-photo">No Photo Available</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- User Information Section -->
        <div class="section">
            <h2>User Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>First Name</label>
                    <span><?php echo htmlspecialchars($userData['Fname'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Last Name</label>
                    <span><?php echo htmlspecialchars($userData['Sname'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Middle Name</label>
                    <span><?php echo htmlspecialchars($userData['Mname'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Extension Name</label>
                    <span><?php echo htmlspecialchars($userData['Ename'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Gender</label>
                    <span><?php echo htmlspecialchars($userData['gender'] ?? ''); ?></span>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="section">
            <h2>Contact Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Email 1</label>
                    <span><?php echo htmlspecialchars($userData['email1'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Email 2</label>
                    <span><?php echo htmlspecialchars($userData['email2'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Contact 1</label>
                    <span><?php echo htmlspecialchars($userData['con1'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Contact 2</label>
                    <span><?php echo htmlspecialchars($userData['con2'] ?? ''); ?></span>
                </div>
            </div>
        </div>

        <!-- Address Information Section -->
        <div class="section">
            <h2>Address Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Municipality</label>
                    <span><?php echo htmlspecialchars($userData['municipality'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Barangay</label>
                    <span><?php echo htmlspecialchars($userData['barangay'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Province</label>
                    <span><?php echo htmlspecialchars($userData['province'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Date of Birth</label>
                    <span><?php echo htmlspecialchars($userData['DOB'] ?? ''); ?></span>
                </div>
            </div>
        </div>

        <!-- Admin Details Section -->
        <div class="section">
            <h2>Admin Details</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>College</label>
                    <span><?php echo htmlspecialchars($userData['college'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Course</label>
                    <span><?php echo htmlspecialchars($userData['course'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Year Level</label>
                    <span><?php echo htmlspecialchars($userData['yrLVL'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>A Level</label>
                    <span><?php echo htmlspecialchars($userData['A_LVL'] ?? ''); ?></span>
                </div>
                <div class="info-item">
                    <label>Status</label>
                    <span><?php echo htmlspecialchars($userData['status'] ?? ''); ?></span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Profile page designed with care using Tailwind CSS. © 2024 Your Company</p>
        </div>

    </div>

</body>
</html>
