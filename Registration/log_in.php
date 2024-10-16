<?php 
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Initialize or unset status message after refreshing
if (isset($_SESSION['status_message'])) {
    $status_message = $_SESSION['status_message'];
    unset($_SESSION['status_message']); // Clear the message after displaying
} else {
    $status_message = '';
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $_SESSION['status_message'] = ''; // Clear notification when fields are empty
    } else {
        // Check if the username exists in the database
        $query_username = "SELECT * FROM `user_log` WHERE username = '$username'";
        $result_username = mysqli_query($conn, $query_username);

        if ($row_username = mysqli_fetch_assoc($result_username)) {
            // Username exists, now check if the password matches
            if ($row_username['password'] === $password) {
                // Check account status
                if ($row_username['status'] == 'pending') {
                    $_SESSION['status_message'] = "Your account is still pending.";
                } elseif ($row_username['status'] == 'rejected') {
                    $_SESSION['status_message'] = "Your account has been rejected. Please sign in again.";
                } else {
                    // Account is approved, proceed to login
                    if ($row_username['U_type'] == "admin") {
                        $_SESSION['admin'] = $row_username;
                        header("Location: ../dashboard/admin/index.php");
                        exit();
                    } elseif ($row_username["U_type"] == "student") {
                        $_SESSION['student'] = $row_username;
                        header("Location: ../dashboard/student/index.php");
                        exit();
                    } elseif ($row_username["U_type"] == "visitor") {
                        $_SESSION['visitor'] = $row_username;
                        header("Location: ../dashboard/visitor/index.php");
                        exit();
                    }
                }
            } else {
                // Username matches but password does not match
                $_SESSION['status_message'] = "The password does not match.";
            }
        } else {
            // Username does not exist, now check if the password matches any user
            $query_password = "SELECT * FROM `user_log` WHERE password = '$password'";
            $result_password = mysqli_query($conn, $query_password);

            if (mysqli_fetch_assoc($result_password)) {
                // Password matches but username does not match
                $_SESSION['status_message'] = "The username does not match.";
            } else {
                // Neither username nor password match
                $_SESSION['status_message'] = "Both do not match!";
            }
        }
    }

    // Refresh page to show message
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/log_in.css">
    <title>Log In</title>
    <script>
        function clearNotification() {
            let username = document.querySelector('input[name="uname"]').value;
            let password = document.querySelector('input[name="password"]').value;
            let alertDiv = document.getElementById("statusMessage");

            // Clear the notification if both fields are empty
            if (username === "" || password === "") {
                alertDiv.style.display = "none";
            } else {
                alertDiv.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <center>
        <form class="form" method="POST">
            <div class="card">
                <div class="top">
                    <a href="../index.html"><img src="pic/logo.png" alt="Logo"></a>
                    <strong>Digital Library Management System</strong>
                </div>
                
                <a class="login">Log in</a>
                <?php if (!empty($status_message)): ?>
                    <div class="alert" id="statusMessage">
                        <?php echo $status_message; ?>
                    </div>
                <?php endif; ?>

                <div class="inputBox">
                    <input name="uname" type="text" required="required" oninput="()">
                    <span class="user">Username</span>
                </div>

                <div class="inputBox">
                    <input name="password" type="password" required="required" oninput="clearNotification()">
                    <span>Password</span>
                </div>

                <div class="inputBox">          
                    <button type="submit" name="submit" class="enter">Enter</button>
                    <p>Already have an account? <a href="sign_up.php">Sign in</a></p>
                </div>

                
            </div>
        </form>
    </center>
</body>
</html>
