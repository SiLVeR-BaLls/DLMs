<?php
// admin_dashboard.php
include '../config.php';
include 'include/admin_connect.php';

// Get the message and type from URL parameters
$message = isset($_GET['message']) ? $_GET['message'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/booktable.css">     
    <link rel="stylesheet" href="css/styles.css">     

    <title>Admin Dashboard</title>
    <style>


        /* Popup Alert Styles */
        .popup-alert {
            display: none; /* Hidden by default */
            position: fixed; 
            z-index: 100; /* On top */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: white;
            font-size: 16px;
        }

        .popup-success {
            background-color: #28a745; /* Green for success */
        }

        .popup-error {
            background-color: #f44336; /* Red for error */
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            float: right;
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
            margin: 0px;
            text-align: center;
        }

        td {
            justify-content: center;
            align-items: center;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Checkerboard Row Styles */
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light grey for even rows */
        }

        /* Button Styles */
        .button {
            display: inline-block;
            margin: 5px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            color: white; /* White text */
            justify-content: center;
        }
        .notification {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
            color: white;
        }

        /* Green for success */
        .success {
            background-color: #4CAF50;
        }

        /* Red for error */
        .error {
            background-color: #f44336;
        }

        .approve {
            background-color: #28a745; /* Green */
        }

        .reject {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>

    <?php include 'include/header.php'; ?>
    <?php include 'include/navbar.php'; ?>

    <!-- Popup Notification -->
        <?php if (!empty($message)): ?>
            <div id="popupAlert" class="popup-alert <?php echo $type === 'success' ? 'popup-success' : 'popup-error'; ?>">
                <?php echo htmlspecialchars($message); ?>
                <button class="close-btn" onclick="closePopup()"></button>
            </div>
        <?php endif; ?>


    <h2>Pending Users</h2>

    <table class="body_contain">
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
        ";
        $pendingUsersResult = $conn->query($pendingUsersQuery);

        if ($pendingUsersResult->num_rows > 0):
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
            <?php endwhile;
        else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">No pending users.</td>
            </tr>
        <?php endif; ?>
    </table>

    <script>
        // Function to close the popup manually
        function closePopup() {
            const popup = document.getElementById('popupAlert');
            if (popup) {
                popup.style.display = 'none';
            }
        }

        // Show the popup and auto-hide after 3 seconds
        window.onload = function () {
            const popup = document.getElementById('popupAlert');
            if (popup) {
                popup.style.display = 'block'; // Show the popup
                setTimeout(function () {
                    popup.style.display = 'none'; // Hide after 3 seconds
                }, 2000);
            }
        };
    </script>

</body>
</html>
