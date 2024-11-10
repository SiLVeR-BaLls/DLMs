<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    
    <script src="js/script.js"></script>

    <title>student Dashboard</title>

</head>
<body>


<?php include 'include/header.php'; ?>
<?php include 'include/navbar.php'; ?>


<!-- Main content area -->
<div class="main-content">
    <?php include 'BrowseBook.php'; ?>
</div>

<?php include 'include/footer.php'; ?>

</body>
</html>
