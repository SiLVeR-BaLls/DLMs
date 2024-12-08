<?php
include '../config.php';

// Fetch user data from the database
$sql = "SELECT u.IDno, u.Fname, u.Sname, ul.U_type 
        FROM users_info u 
        JOIN user_log ul ON u.IDno = ul.IDno";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $users = [];
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "No results found";
}

// Check if a POST request to update role is made
if (isset($_POST['IDno']) && isset($_POST['U_type'])) {
    $IDno = $_POST['IDno'];
    $U_type = $_POST['U_type'];

    // Prepare and execute the update statement
    $sql = "UPDATE user_log SET U_type = ? WHERE IDno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $U_type, $IDno);

    if ($stmt->execute()) {
        // Return success response if update is successful
        echo "Role updated successfully!";
    } else {
        // Return error response if update fails
        echo "Error updating role: " . $conn->error;
    }

    $stmt->close();
}
?>
<style>
    .action-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        display: inline-block;
        cursor: pointer;
        opacity: 0.5;
    }
    .action-btn.enabled {
        opacity: 1;
    }
</style>
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
    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow ">
        <!-- Header at the Top -->
        <?php include 'include/header.php'; ?>

      <div class="container mx-auto px-4 py-6 ">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">User Role Management</h2>
            
            <form id="role-update-form" method="POST">
                <table class="min-w-full table-auto bg-white shadow-lg rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">First Name</th>
                            <th class="py-3 px-6 text-left">Surname</th>
                            <th class="py-3 px-6 text-left">Role</th>
                            <th class="py-3 px-6 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr class="border-b">
                            <td class="py-4 px-6"><?= $user['IDno'] ?></td>
                            <td class="py-4 px-6"><?= $user['Fname'] ?></td>
                            <td class="py-4 px-6"><?= $user['Sname'] ?></td>
                            <td class="py-4 px-6">
                                <select class="role-select border rounded-lg p-2" name="U_type[<?= $user['IDno'] ?>]" data-id="<?= $user['IDno'] ?>" data-current-role="<?= $user['U_type'] ?>">
                                    <option value="admin" <?= $user['U_type'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="student" <?= $user['U_type'] == 'student' ? 'selected' : '' ?>>Student</option>
                                    <option value="professor" <?= $user['U_type'] == 'professor' ? 'selected' : '' ?>>Professor</option>
                                    <option value="staff" <?= $user['U_type'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                                    <option value="librarian" <?= $user['U_type'] == 'librarian' ? 'selected' : '' ?>>Librarian</option>
                                </select>
                            </td>
                            <td class="py-4 px-6 text-center">
    <button type="button" class="action-btn disabled:bg-gray-500 disabled:cursor-not-allowed" data-id="<?= $user['IDno'] ?>" disabled>Confirm</button>
</td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Hidden submit button for form -->
                <button type="submit" style="display: none;">Submit</button>
            </form>
        </div>
    <!-- Footer at the Bottom -->
    <footer class="bg-blue-600 text-white mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>

    <script>document.addEventListener('DOMContentLoaded', function() {
    // Get all the select elements and action buttons
    const roleSelects = document.querySelectorAll('.role-select');
    const actionBtns = document.querySelectorAll('.action-btn');

    // Attach change event listeners to each select element
    roleSelects.forEach(select => {
        select.addEventListener('change', function() {
            const userId = this.getAttribute('data-id');
            const selectedRole = this.value;
            const currentRole = this.getAttribute('data-current-role');

            // Find the corresponding action button
            const actionBtn = document.querySelector(`.action-btn[data-id="${userId}"]`);

            // Enable the confirm button if the role has changed
            if (selectedRole !== currentRole) {
                actionBtn.disabled = false;  // Enable button
                actionBtn.classList.add('enabled');
            } else {
                actionBtn.disabled = true;   // Disable button
                actionBtn.classList.remove('enabled');
            }
        });
    });

    // Handle the confirm button click
    actionBtns.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const selectedRole = document.querySelector(`.role-select[data-id="${userId}"]`).value;

            // Debug: Log the data being sent
            console.log("Sending data:", { IDno: userId, U_type: selectedRole });

            // Prepare the form data for sending
            const formData = new FormData();
            formData.append('IDno', userId);
            formData.append('U_type', selectedRole);

            // Send the data to the PHP backend
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())  // Get the response text from PHP
            .then(data => {
                console.log("Server response:", data);  // Log the response from the server
                if(data.includes('Role updated successfully')) {
                    alert("Role updated successfully!");  // Show success message
                    button.disabled = true;  // Disable the button after successful update
                    button.classList.remove('enabled');
                } else {
                    alert('Error updating role.');
                }
            })
            .catch(error => {
                console.error('Error:', error);  // Log any errors
                alert('Error updating role.');
            });
        });
    });
});

</script>
</body>
</html>