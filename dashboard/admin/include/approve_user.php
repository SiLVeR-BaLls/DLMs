<?php
// include/config.php
include '../include/config.php';
include '../include/admin_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the user status to 'approved'
    $query = "UPDATE user_log SET status = 'approved' WHERE IDno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Success message
        header("Location: ../pending.php?message=Account approved successfully!");
        exit();
    } else {
        // Error handling
        header("Location: ../pending.php?message=Error approving account.");
        exit();
    }
}
?>
