<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Login</title>
    <link rel="stylesheet" href="css/log_in.css">
</head>
<body>
    <div class="login-container">
        <img src="images/logo-removebg-preview.png" alt="Digital Library Logo">
        <form action="login.php" method="post">
            <input type="Username" placeholder="Username" name="Username" id="Username" required>
            <input type="password" placeholder="Password" name="Password" id="Password" required>
            <button type="submit" class="button">Login</button>
        </form>
        <p>Don't have an account yet?</p>
        <a href="sign_up.php" class="button">Sign up</a>
    </div>
</body>
</html>