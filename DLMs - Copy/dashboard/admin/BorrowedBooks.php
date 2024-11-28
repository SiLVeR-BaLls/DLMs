<?php

include '../config.php';


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
 <style>
      .sidebar {
    width: 250px;
    background-color: #333;
    padding: 0px;
    margin:0px;
    height: 100vh;
    top: 45px;
    z-index: 1;
    position: sticky;
    overflow-y: 100px; /* Scroll if content exceeds height */
}

.bods {
    display: flex;
    gap: 20px;
}

        .sidebar ul li a{
            width: 25vw;
        border-bottom: 1px solid white;
        padding: 10px 0;
        text-align: center;
            color: white; 
        text-decoration: none; /* Remove underline */
        }
        
        .sidebar ul li{
        margin:0px;       
        left:0;
        display:flex;
        padding: 10px 0;
        text-align: center;
        justify-content: center;
    }

    .sidebar ul li:hover{
        background-color: #262424;

    }



        /* Profile styling */
        .profile {
            position: static;
            flex: 3;                  /* Profile takes up three parts */
            background-color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            /* Optional: Additional styling */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
 </style>
<body >
    <!-- modify this  -->
     <!-- header set at the top horizontal -->
        <?php include 'include/header.php'; ?>
    <!-- same here -->
        <?php include 'include/navbar.php'; ?>
    <!-- the navbar set at the right side vertical -->
    <div class="bods">
        <div class="sidebar">
        <?php include 'include/sidebar.php'; ?>
        </div>
        <div class="profile">
        <?php include 'include/navbar.php'; ?>
        </div>
    </div>

<?php include 'include/footer.php'; ?>


</body>
</html>
