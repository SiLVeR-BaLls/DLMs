

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Registration</title>
    <link rel="stylesheet" href="css/sign_up1.css">
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header>
        <p><strong>DIGITAL LIBRARY MANAGEMENT SYSTEM</strong></p>
        
    </header>
    
    
    <main>
        

        <form id="registration-form" action="php/connection.php" method="post" class="container">
            <div class="plus">
            <?php include 'reg/reg_navbar.php'; ?>
            <?php include 'reg/user_info.php'; ?>
            <?php include 'reg/site_info.php'; ?>
            <?php include 'reg/user_site.php'; ?>
            </div>

        
            <div class="button-container">
                <button type="submit" class="button">Register</button>
                <button type="reset" class="button">Reset</button>
                <div id="error-message" class="error"></div>
            </div>
            <p>Do you have an account? <a href="log_in.php" class="but">Log In</a></p>
        </form>
    </main>
</body>

</html>