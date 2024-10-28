<?php 
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['admin'])) {
    header("Location: ../dashboard/admin/index.php");
    exit();
} elseif (isset($_SESSION['student'])) {
    header("Location: ../dashboard/student/index.php");
    exit();
} elseif (isset($_SESSION['visitor'])) {
    header("Location: ../dashboard/visitor/index.php");
    exit();
}

// Database configuration and connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize status message
$status_message = isset($_SESSION['status_message']) ? $_SESSION['status_message'] : '';
unset($_SESSION['status_message']);

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM `user_log` WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['password'] === $password) {
                if ($row['status'] == 'pending') {
                    $_SESSION['status_message'] = "Your account is still pending.";
                } elseif ($row['status'] == 'rejected') {
                    $_SESSION['status_message'] = "Your account has been rejected. Please sign in again.";
                } else {
                    $_SESSION[$row['U_type']] = $row;
                    $redirect_page = "../dashboard/" . strtolower($row['U_type']) . "/index.php";
                    header("Location: $redirect_page");
                    exit();
                }
            } else {
                $_SESSION['status_message'] = "The password does not match.";
            }
        } else {
            $_SESSION['status_message'] = "The username does not match.";
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/log_in.css">
    <title>Log In</title>
</head>
<body>
    <center>
        <form class="form" method="POST">
            <div class="card">
                <div class="top">
                    <a href="../index.php"><img src="pic/logo.png" alt="Logo"></a>
                    <strong>Digital Library Management System</strong>
                </div>
                
                <a class="login">Log in</a>
                <?php if (!empty($status_message)): ?>
                    <div class="alert" id="statusMessage">
                        <?php echo $status_message; ?>
                    </div>
                <?php endif; ?>

                <div class="inputBox">
                    <input name="uname" type="text" required="required">
                    <span class="user">Username</span>
                </div>

                <div class="inputBox">
                    <input name="password" type="password" required="required">
                    <span>Password</span>
                </div>

                <div class="inputBox">          
                    <button type="submit" name="submit" class="enter">Enter</button>
                    <p>Already have an account? <a href="sign_up.php">Sign up</a></p>
                </div>
            </div>
        </form>
    </center>
</body>
</html>
