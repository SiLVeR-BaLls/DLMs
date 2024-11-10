<?php // Configuration
//for confirmation  of the user that it is adimin (well dont know how long)

session_start();

// Database Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create a database connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Initialize variables
$isLoggedIn = false;
$error_message = "";

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user_log` WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($row = $result->fetch_assoc()) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row; // Store user information in session
            $isLoggedIn = true; // Set login status to true

            // Redirect based on user type
            switch ($row['U_type']) {
                case 'admin':
                    header("Location: admin.php");  // Redirect to the admin dashboard
                    break;
                case 'student':
                    header("Location: student.php"); // Redirect to the student dashboard
                    break;
                case 'staff':
                    header("Location: staff.php"); // Redirect to the staff dashboard
                    break;
                case 'superadmin':
                    header("Location: superadmin.php"); // Redirect to the superadmin dashboard
                    break;
                default:
                    $error_message = "Invalid user type!";
                    break;
            }
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin'])) {
    header('Location: ../../Registration/log_in.php'); // Redirect to the login page if not logged in
    exit();
}

// Assuming the U_type should be 'admin' for this page
$requiredUserType = 'admin';


// Fetch data for the logged-in admin
$idno = $_SESSION['admin']['IDno'];
$contactQuery = "SELECT * FROM contact WHERE IDno = ?";
$addressQuery = "SELECT * FROM address WHERE IDno = ?";
$adminsInfoQuery = "SELECT * FROM user_details WHERE IDno = ?";
$usersInfoQuery = "SELECT * FROM users_info WHERE IDno = ?";

// Prepare and execute the contact query
$stmtContact = $conn->prepare($contactQuery);
$stmtContact->bind_param("s", $idno);
$stmtContact->execute();
$contactResult = $stmtContact->get_result();

// Prepare and execute the address query
$stmtAddress = $conn->prepare($addressQuery);
$stmtAddress->bind_param("s", $idno);
$stmtAddress->execute();
$addressResult = $stmtAddress->get_result();

// Prepare and execute the admins info query
$stmtAdminsInfo = $conn->prepare($adminsInfoQuery);
$stmtAdminsInfo->bind_param("s", $idno);
$stmtAdminsInfo->execute();
$adminsInfoResult = $stmtAdminsInfo->get_result();

// Prepare and execute the users info query
$stmtUsersInfo = $conn->prepare($usersInfoQuery);
$stmtUsersInfo->bind_param("s", $idno);
$stmtUsersInfo->execute();
$usersInfoResult = $stmtUsersInfo->get_result();

?>