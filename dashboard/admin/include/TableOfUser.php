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
                            <!-- View Button -->
                            <a href="include/user_details.php?id=<?php echo htmlspecialchars($row['IDno']); ?>"
                             class="btn btn-info btn-sm" style="text-decoration:none; "> 
                                View
                            </a>

                            
                            <!-- Delete Button -->
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

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>IDno:</strong> <span id="modalIDno"></span></p>
        <p><strong>First Name:</strong> <span id="modalFname"></span></p>
        <p><strong>Last Name:</strong> <span id="modalSname"></span></p>
        <p><strong>Course:</strong> <span id="modalCourse"></span></p>
        <p><strong>Year:</strong> <span id="modalYear"></span></p>
        <p><strong>Section:</strong> <span id="modalSection"></span></p>
      </div>
    </div>
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
                xhr.open('POST', window.location.href, true);
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

    // JavaScript function to view user details in modal
    function viewUser(id, fname, sname, course, year, section) {
        document.getElementById('modalIDno').innerText = id;
        document.getElementById('modalFname').innerText = fname;
        document.getElementById('modalSname').innerText = sname;
        document.getElementById('modalCourse').innerText = course;
        document.getElementById('modalYear').innerText = year;
        document.getElementById('modalSection').innerText = section;
    }
</script>

<!-- SweetAlert and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
