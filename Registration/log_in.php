<?php 
$conn = mysqli_connect("localhost", "root", "", "dlms");

session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];
    
    // Query to fetch user information including status
    $query = "SELECT * FROM `user_log` WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    // Check if a matching user exists
    if ($row = mysqli_fetch_assoc($result)) {
        // Check account status
        if ($row['status'] == 'pending') {
            echo "<script>alert('Your account is still pending.');</script>"; // Alert for pending accounts
        } elseif ($row['status'] == 'rejected') {
            echo "<script>alert('Your account has been rejected. Please sign in again.');</script>"; // Alert for rejected accounts
        } else {
            // Account is approved, proceed to login
            if ($row['U_type'] == "admin") {
                $_SESSION['admin'] = $row;
                header("Location: ../dashboard/admin/index.php");
                exit();
            } 
            elseif ($row["U_type"] == "student") {
                $_SESSION['student'] = $row;
                header("Location: ../dashboard/student/index.php");
                exit();
            }
            elseif ($row["U_type"] == "visitor") {
                $_SESSION['visitor'] = $row;
                header("Location: ../dashboard/visitor/index.php");
                exit();
            }
        }
    } else {
        echo "<script>alert('Your username or password does not match!');</script>"; // Alert for incorrect credentials
    }
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
                    <a href="../index.html"><img src="pic/logo.png" alt="Logo"></a>
                    <strong>Digital Library Management System</strong>
                </div>
                
                <a class="login">Log in</a>
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
                    <p>Already have an account? <a href="sign_up.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </center>
</body>
</html>
