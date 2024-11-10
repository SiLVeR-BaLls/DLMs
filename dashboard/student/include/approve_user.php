<?php
// approve_user.php
include '../../config.php';
include '../include/student_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the user status to 'approved'
    $query = "UPDATE user_log SET status = 'approved' WHERE IDno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Success message with 'success' type
        header("Location: ../pending.php?message=Account approved successfully!&type=success");
        exit();
    } else {
        // Error handling with 'error' type
        header("Location: ../pending.php?message=Error approving account.&type=error");
        exit();
    }
}
?>
