<?php

include '../config.php';
include 'include/admin_connect.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/styles.css">     
    <link rel="stylesheet" href="css/booktable.css">     
    
    <script src="js/script.js"></script>

    <title>Admin Dashboard</title>
    
</head>
 
<body >
    <!-- modify this  -->
     <!-- header set at the top horizontal -->
        <?php include 'include/header.php'; ?>
    <!-- same here -->
        <?php include 'include/navbar.php'; ?>
    <!-- the navbar set at the right side vertical -->
        <?php include 'include/sidebar.php'; ?>


<?php include 'include/footer.php'; ?>


</body>
</html>
