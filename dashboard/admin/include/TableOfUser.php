<?php

// Fetch users from the database
$usersResult = mysqli_query($conn, "SELECT users_info.IDno, users_info.Fname, users_info.Sname, 
user_details.course, user_details.yrLVL AS year 
FROM users_info
JOIN user_details ON users_info.IDno = user_details.IDno");

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'] ?? '';

    if ($id) {
        // Fetch the user details to get the photo path
        $stmt = $conn->prepare("SELECT photo FROM users_info WHERE IDno = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $photoToDelete = $user['photo'] ?? '';

                // Delete the user record
                $deleteStmt = $conn->prepare("DELETE FROM users_info WHERE IDno = ?");
                $deleteStmt->bind_param("s", $id);

                if ($deleteStmt->execute()) {
                    // Check if the photo exists and delete it from the directory
                    if ($photoToDelete && file_exists("../../pic/User/" . $photoToDelete)) {
                        unlink("../../pic/User/" . $photoToDelete);
                    }
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    echo json_encode(['success' => false, 'message' => "Error deleting user: " . $deleteStmt->error]);
                    exit();
                }
                $deleteStmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => "No user found with that ID."]);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Error executing query: " . $stmt->error]);
            exit();
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => "No user ID provided."]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>User Management</h2>

    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Year</th>
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
                        <td>
                            <a href="include/user_details.php?id=<?php echo htmlspecialchars($row['IDno']); ?>" class="btn btn-info btn-sm" style="text-decoration:none;">View</a>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser('<?php echo htmlspecialchars($row['IDno']); ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
                                location.reload(true);
                            });
                        } else {
                            swal("Error!", response.message, "error");
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

</body>
</html>
