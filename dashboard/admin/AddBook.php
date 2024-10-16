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
<body>

<?php if (!$isLoggedIn): ?>


<?php endif; ?>


    <?php include 'include/header.php'; ?>
    <?php include 'include/navbar.php'; ?>

    <?php include 'include/AddbookTable.php'; ?>

    
    <?php include 'include/footer.php'; ?>

</body>
</html>
