<?php
session_start();

// Include configuration and connection files
include 'include/config.php'; // Ensure this file contains your database connection code

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../../Registration/log_in.php");
    exit();
}

// Initialize the login status variable
$isLoggedIn = false;

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user_log` WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['admin'] = $row;
        $isLoggedIn = true; // Set login status to true
        header("Location: admin.php");
        exit();
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin'])) {
    header('Location: ../../index.html'); // Redirect to the login page if not logged in
    exit();
}

// Assuming the U_type should be 'admin' for this page
$requiredUserType = 'admin';

// Check if the user's U_type matches the required type
if ($_SESSION['admin']['U_type'] !== $requiredUserType) {
    header('Location: /'); // Redirect to the root page if not admin
    exit();
}

// Check if user is logged in as admin
$isLoggedIn = isset($_SESSION['admin']);

// Fetch data from the tables if logged in
if ($isLoggedIn) {
    // Prepare the statements to fetch user-specific data
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
}
?>
