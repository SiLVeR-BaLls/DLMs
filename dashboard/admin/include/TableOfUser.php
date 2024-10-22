<?php
include '../../dashboard/config.php';


// Fetch users from the database
$usersResult = mysqli_query($conn, "SELECT users_info.IDno, users_info.Fname, users_info.Sname, 
user_details.course, user_details.yrLVL AS year, user_details.section 
FROM users_info
JOIN user_details ON users_info.IDno = user_details.IDno");
?>

<body>

<div class="container mt-5">
    <h2>User Management</h2>
    
    <!-- Table displaying users -->
    <div class="tableofuser">
        <table id="usersTable" class="table table-striped table-bordered dt-responsive">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td><?php echo htmlspecialchars($row['Fname']); ?></td>
                        <td><?php echo htmlspecialchars($row['Sname']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                        <td><?php echo htmlspecialchars($row['section']); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#viewUserModal" 
                                    onclick="viewUser('<?php echo htmlspecialchars($row['IDno']); ?>', '<?php echo htmlspecialchars($row['Fname']); ?>', '<?php echo htmlspecialchars($row['Sname']); ?>', '<?php echo htmlspecialchars($row['course']); ?>', '<?php echo htmlspecialchars($row['year']); ?>', '<?php echo htmlspecialchars($row['section']); ?>')">
                                View
                            </button>
                            
                            <button class="btn btn-danger btn-sm" 
                                    onclick="deleteUser('<?php echo htmlspecialchars($row['IDno']); ?>')">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // JavaScript function to handle deletion
    function deleteUser(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '', true); // Use the correct URL if needed
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('action=delete&id=' + encodeURIComponent(id));

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal("Deleted!", "User has been deleted successfully.", "success")
                            .then(() => {
                                location.reload(true); // Force reload from server
                            });
                        } else {
                            swal("Error!", "Failed to delete user: " + response.message, "error");
                        }
                    } else {
                        swal("Error!", "Error: " + xhr.status, "error");
                    }
                };

                xhr.onerror = function() {
                    swal("Error!", "Network error occurred.", "error");
                };
            } else {
                swal("Your user is safe!");
            }
        });
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

<?php
// Handle the delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete') {
        $id = $_POST['id'];

        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM users_info WHERE IDno = ?");
        $stmt->bind_param("s", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Could not delete user.']);
        }
        
        $stmt->close();
    }
}

// Close the database connection
mysqli_close($conn);
?>

</body>
