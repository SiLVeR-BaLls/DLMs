<?php // Configuration
//for confirmation of the user that it is admin or student (well don't know how long)

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
                    $_SESSION['admin'] = $row; // Store admin info in session
                    header("Location: admin.php");  // Redirect to the admin dashboard
                    break;
                case 'student':
                    $_SESSION['student'] = $row; // Store student info in session
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

// Check if the user is logged in and is either admin or student
if (!isset($_SESSION['admin']) && !isset($_SESSION['student'])) {
    header('Location: ../../Registration/log_in.php'); // Redirect to the login page if not logged in
    exit();
}

// Fetch data for the logged-in user (admin or student)
$userType = isset($_SESSION['admin']) ? 'admin' : 'student'; // Determine if the user is admin or student
$idno = isset($_SESSION['admin']) ? $_SESSION['admin']['IDno'] : $_SESSION['student']['IDno']; // Get IDno from session based on user type

$contactQuery = "SELECT * FROM contact WHERE IDno = ?";
$addressQuery = "SELECT * FROM address WHERE IDno = ?";
$usersInfoQuery = "SELECT * FROM users_info WHERE IDno = ?";
$usersDetailQuery = "SELECT * FROM user_details WHERE IDno = ?";

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

// Prepare and execute the users info query
$stmtUsersInfo = $conn->prepare($usersInfoQuery);
$stmtUsersInfo->bind_param("s", $idno);
$stmtUsersInfo->execute();
$usersInfoResult = $stmtUsersInfo->get_result();

// Prepare and execute the users info query
$stmtUsersInfo = $conn->prepare($usersDetailQuery);
$stmtUsersInfo->bind_param("s", $idno);
$stmtUsersInfo->execute();
$usersDetailResult = $stmtUsersInfo->get_result();
?>

<!-- Your HTML content goes here -->
<!-- Depending on user type (admin or student), you can display different content -->

