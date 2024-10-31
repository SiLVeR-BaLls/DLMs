<?php
// Include the configuration file for database connection
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Users</title>
    <!-- Bootstrap CSS -->
     
<link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="css/styles.css">     

    <script src="js/script.js"></script>

    <style>
       
        .modal {
            z-index: 1050;
}

    </style>
</head>
<body>

<?php include 'include/header.php'; ?>
<?php include 'include/navbar.php'; ?>

<?php include 'include/TableOfUser.php'; ?>



</body>
</html>

<?php
// Close the database connection
?>
