<?php
// Configuration
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
    $stmt = $conn->prepare("SELECT * FROM `users_info` WHERE username=?");
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
            switch ($row['U_Type']) {
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
                case 'librarian':
                    header("Location: librarian.php"); // Redirect to the superadmin dashboard
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
if (!isset($_SESSION['admin']) && !isset($_SESSION['student']) && !isset($_SESSION['librarian'])) {
    header('Location: ../../Registration/log_in.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch data for the logged-in user (admin or student)
$userType = isset($_SESSION['admin']) ? 'admin' : (isset($_SESSION['student']) ? 'student' : 'librarian');
$idno = isset($_SESSION['admin']) ? $_SESSION['admin']['IDno'] :
       (isset($_SESSION['student']) ? $_SESSION['student']['IDno'] : $_SESSION['librarian']['IDno']);

// Retrieve the IDno from the session (either admin or student)
$userID = isset($_SESSION['admin']) ? $_SESSION['admin']['IDno'] :
         (isset($_SESSION['student']) ? $_SESSION['student']['IDno'] : 
         (isset($_SESSION['librarian']) ? $_SESSION['librarian']['IDno'] : null));

// Check if user is logged in
if (!$userID) {
    header("Location: ../../Registration/log_in.php"); // Redirect to login page if not logged in
    exit();
}

// Query to fetch user information only from users_info table
$query = "SELECT * FROM users_info WHERE IDno = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $idno);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc(); // Fetch data as an associative array
?>
