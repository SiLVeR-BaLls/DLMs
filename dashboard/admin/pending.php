<?php
// admin_dashboard.php
include 'include/config.php';
include 'include/admin_connect.php';

$message = isset($_GET['message']) ? $_GET['message'] : ''; // Get message from URL

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin Dashboard</title>
    <style>
        /* Custom Alert Style */
        .alert {
            padding: 10px;
            margin: 15px 0;
            background-color: #f44336; /* Red background */
            color: white; /* White text */
            border-radius: 5px; /* Rounded corners */
            text-align: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px; /* Bottom margin for spacing */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Checkerboard Row Styles */
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light grey for even rows */
        }

        /* Button Styles */
        .button {
            display: flex;
            align-item: center;
            justify-content: center;
            margin: 10px;
            padding: 5px ;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-right: 5px;
            transition: background-color 0.3s ease;
            color: white; /* White text for buttons */
        }

        .approve {
            background-color: #ffeb3b; /* Yellow */
            color: black; /* Black text */
        }

        .approve:hover {
            background-color: #fdd835; /* Darker yellow on hover */
        }

        .reject {
            background-color: #f44336; /* Red */
        }

        .reject:hover {
            background-color: #e53935; /* Darker red on hover */
        }
    </style>
</head>
<body class="p-6 bg-gray-100">

    <?php include 'include/header.php'; ?>
    <?php include 'include/navbar.php'; ?>

    <?php if ($message): ?>
        <div class="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <h2 class="text-2xl font-semibold mt-6">Pending Users</h2>
    <table>
        <tr>
            <th>ID No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php 
        // Fetch pending users
        $pendingUsersQuery = "
            SELECT u.IDno, u.Fname, u.Sname, l.U_type 
            FROM users_info u 
            JOIN user_log l ON u.IDno = l.IDno 
            WHERE l.status = 'pending'
        "; // Assuming there is a 'status' column
        $pendingUsersResult = $conn->query($pendingUsersQuery);

        while ($user = $pendingUsersResult->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['IDno']); ?></td>
            <td><?php echo htmlspecialchars($user['Fname']); ?></td>
            <td><?php echo htmlspecialchars($user['Sname']); ?></td>
            <td><?php echo htmlspecialchars($user['U_type']); ?></td>
            <td>
                <a href="include/approve_user.php?id=<?php echo $user['IDno']; ?>" class="button approve">Approve</a>
                <a href="include/reject_user.php?id=<?php echo $user['IDno']; ?>" class="button reject">Reject</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
