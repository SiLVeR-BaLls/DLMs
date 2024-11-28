<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLMs</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- BrowseBook Content and Footer Section -->
        <div class="flex-grow">
            <!-- Popup Notification -->
            <?php if (!empty($message)): ?>
                <div id="popupAlert" class="px-4 py-2 mb-4 text-white rounded-lg <?php echo $type === 'success' ? 'bg-green-500' : 'bg-red-500'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                    <button class="ml-2 text-sm" onclick="closePopup()">x</button>
                </div>
            <?php endif; ?>

            <h2 class="text-xl font-semibold mb-4">Pending Users</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-4 text-center text-gray-700 font-medium">ID No</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-medium">First Name</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-medium">Last Name</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-medium">Role</th>
                            <th class="py-3 px-4 text-center text-gray-700 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($user['IDno']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['Fname']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['Sname']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['U_type']); ?></td>
                                    <td class="py-3 px-4 text-center space-x-2">
                                        <button class="px-3 py-1 text-sm text-white bg-green-500 hover:bg-green-600 rounded approve-button" data-id="<?php echo $user['IDno']; ?>">Approve</button>
                                        <button class="px-3 py-1 text-sm text-white bg-red-500 hover:bg-red-600 rounded reject-button" data-id="<?php echo $user['IDno']; ?>">Reject</button>
                                    </td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-600">No pending users.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer at the Bottom -->
            <footer class="bg-blue-600 text-white p-4 mt-auto">
                <?php include 'include/footer.php'; ?>
            </footer>
        </div>
    </main>

    <!-- Approval Popup -->
    <div id="approvePopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Confirm Approval</h3>
            <p>Are you sure you want to approve this user?</p>
            <div class="mt-4 flex justify-end">
                <button id="approveConfirm" class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded mr-2">Confirm</button>
                <button id="approveCancel" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Rejection Popup -->
    <div id="rejectPopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Confirm Rejection</h3>
            <p>Are you sure you want to reject this user?</p>
            <div class="mt-4 flex justify-end">
                <button id="rejectConfirm" class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded mr-2">Confirm</button>
                <button id="rejectCancel" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let selectedUserId = null;

        // Open Approval Popup
        document.querySelectorAll('.approve-button').forEach(button => {
            button.addEventListener('click', function (event) {
                selectedUserId = this.getAttribute('data-id');
                document.getElementById('approvePopup').classList.remove('hidden');
            });
        });

        // Open Rejection Popup
        document.querySelectorAll('.reject-button').forEach(button => {
            button.addEventListener('click', function (event) {
                selectedUserId = this.getAttribute('data-id');
                document.getElementById('rejectPopup').classList.remove('hidden');
            });
        });

        // Close Popup (Cancel)
        document.getElementById('approveCancel').addEventListener('click', function () {
            document.getElementById('approvePopup').classList.add('hidden');
        });
        document.getElementById('rejectCancel').addEventListener('click', function () {
            document.getElementById('rejectPopup').classList.add('hidden');
        });

        // Confirm Approve Action
        document.getElementById('approveConfirm').addEventListener('click', function () {
            window.location.href = `include/approve_user.php?id=${selectedUserId}`;
        });

        // Confirm Reject Action
        document.getElementById('rejectConfirm').addEventListener('click', function () {
            window.location.href = `include/reject_user.php?id=${selectedUserId}`;
        });
    </script>
</body>

</html>
