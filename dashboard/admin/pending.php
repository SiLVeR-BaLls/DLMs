<?php
// admin_dashboard.php
include '../config.php';
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
            display: none; /* Hidden by default */
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
            margin:0px;
            text-align: center;
        }
        td{
            justify-content: center;
            align-items: center;
        }

        th {
            background-color: #f2f2f2;
            text-align:center;
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

        .approve {
            background-color: #28a745; /* Green */
        }

        .reject {
            background-color: #f44336; /* Red */
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; 
            z-index: 10; /* On top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            width: 300px;
        }

        .modal-content h3 {
            margin-bottom: 20px;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-evenly;
        }

        .modal-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .confirm-approve {
            background-color: #28a745; /* Green */
        }

        .confirm-reject {
            background-color: #f44336; /* Red */
        }

        .cancel-button {
            background-color: grey; /* Grey */
        }
    </style>
</head>
<body>

    <?php include 'include/header.php'; ?>
    <?php include 'include/navbar.php'; ?>

    <h2>Pending Users</h2>

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
                        <a href="#" class="button approve" onclick="openModal('approve', '<?php echo $user['IDno']; ?>', '<?php echo $user['Fname'] . ' ' . $user['Sname']; ?>')">Approve</a>
                        <a href="#" class="button reject" onclick="openModal('reject', '<?php echo $user['IDno']; ?>', '<?php echo $user['Fname'] . ' ' . $user['Sname']; ?>')">Reject</a>
                    </td>
                </tr>
            <?php endwhile;
        else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">No pending users.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Modal for confirmation -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3 id="modalMessage"></h3>
            <div class="modal-buttons">
                <button id="confirmButton" class="modal-button confirm-approve" onclick="confirmAction()">Confirm</button>
                <button class="modal-button cancel-button" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let currentAction = '';
        let userId = '';

        function openModal(action, id, name) {
            currentAction = action;
            userId = id;

            const modalMessage = document.getElementById('modalMessage');
            const confirmButton = document.getElementById('confirmButton');
            
            if (action === 'approve') {
                modalMessage.textContent = `Are you sure you want to approve ${name}?`;
                confirmButton.classList.add('confirm-approve');
                confirmButton.classList.remove('confirm-reject');
            } else if (action === 'reject') {
                modalMessage.textContent = `Are you sure you want to reject ${name}?`;
                confirmButton.classList.add('confirm-reject');
                confirmButton.classList.remove('confirm-approve');
            }

            document.getElementById('confirmModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        function confirmAction() {
            if (currentAction === 'approve') {
                window.location.href = `include/approve_user.php?id=${userId}`;
            } else if (currentAction === 'reject') {
                window.location.href = `include/reject_user.php?id=${userId}`;
            }
        }
    </script>

</body>
</html>
