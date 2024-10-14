<?php
// include/config.php
include '../include/config.php';
include '../include/admin_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the user status to 'rejected'
    $query = "UPDATE user_log SET status = 'rejected' WHERE IDno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Success message
        header("Location: ../pending.php?message=Account rejected successfully!");
        exit();
    } else {
        // Error handling
        header("Location: ../pending.php?message=Error rejecting account.");
        exit();
    }
}
?>
