<?php

include 'include/config.php';
include 'include/visitor_connect.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/visitor.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>

    <title>visitor Dashboard</title>
    
</head>
<body>

<h1>visitor Dashboard</h1>

<?php if (!$isLoggedIn): ?>


<?php endif; ?>


    <?php include 'include/header.php'; ?>
    <?php include 'include/navbar.php'; ?>
    <h1>search you book</h1>

    
    <?php include 'include/footer.php'; ?>

</body>
</html>
