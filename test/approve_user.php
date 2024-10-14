<?php
// approve_user.php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $query = "UPDATE users SET status = 'approved' WHERE user_id = $user_id";
    mysqli_query($conn, $query);
    header("Location: admin_dashboard.php");
    exit();
}
?>
