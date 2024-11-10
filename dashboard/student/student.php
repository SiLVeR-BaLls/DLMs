<?php

include '../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/student.css">
    <link rel="stylesheet" href="css/styles.css">     
    <link rel="stylesheet" href="css/booktable.css">     
    
    <script src="js/script.js"></script>

    <title>student Dashboard</title>
    
</head>
 
<body >
    <!-- modify this  -->
     <!-- header set at the top horizontal -->
        <?php include 'include/header.php'; ?>
    <!-- same here -->
        <?php include 'include/navbar.php'; ?>
    <!-- the navbar set at the right side vertical -->
    <div class="sidebar">
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_books.php">Manage Books</a></li>
        <li><a href="view_reports.php">View Reports</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<?php include 'include/footer.php'; ?>


</body>
</html>
