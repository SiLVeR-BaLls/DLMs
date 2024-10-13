<?php
// Include the configuration file for database connection
include 'include/config.php';
include 'include/admin_connect.php';

// Query to retrieve users information with additional details from user_details table
$usersQuery = "SELECT users_info.IDno, users_info.Fname, users_info.Sname, 
                      user_details.course, user_details.yrLVL AS year, user_details.section 
               FROM users_info
               JOIN user_details ON users_info.IDno = user_details.IDno";

$usersResult = mysqli_query($conn, $usersQuery);

if (!$usersResult) {
    die('Error retrieving users data: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Users</title>
    <!-- Bootstrap CSS -->
     
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/responsive.dataTables.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>

    <style>
       
        .modal {
    z-index: 1050; /* Bootstrap modal z-index */
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
mysqli_close($conn);
?>
