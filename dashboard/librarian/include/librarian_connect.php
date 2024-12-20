<?php
session_start();

// Include configuration and connection files
include '../config.php'; // Ensure this file contains your database connection code

// Handle logout


// Initialize the login status variable
$isLoggedIn = false;

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user_log` WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['librarian'] = $row;
            $isLoggedIn = true; // Set login status to true
            header("Location: librarian.php");
            exit();
        } else {
            $error_message = "Your Username or Password is incorrect!";
        }
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if the user is logged in and is an librarian
if (!isset($_SESSION['librarian'])) {
    header('Location: ../../index.html'); // Redirect to the login page if not logged in
    exit();
}

// Assuming the U_Type should be 'librarian' for this page
$requiredUserType = 'librarian';

// Check if the user's U_Type matches the required type
if ($_SESSION['librarian']['U_Type'] !== $requiredUserType) {
    header('Location: /'); // Redirect to the root page if not librarian
    exit();
}

// Check if user is logged in as librarian
$isLoggedIn = isset($_SESSION['librarian']);

// Fetch data from the tables if logged in
if ($isLoggedIn) {
    // Prepare the statements to fetch user-specific data
    $idno = $_SESSION['librarian']['IDno'];
    $contactQuery = "SELECT * FROM contact WHERE IDno = ?";
    $addressQuery = "SELECT * FROM address WHERE IDno = ?";
    $librariansInfoQuery = "SELECT * FROM user_details WHERE IDno = ?";
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

    // Prepare and execute the librarians info query
    $stmtlibrariansInfo = $conn->prepare($librariansInfoQuery);
    $stmtlibrariansInfo->bind_param("s", $idno);
    $stmtlibrariansInfo->execute();
    $librariansInfoResult = $stmtlibrariansInfo->get_result();

    // Prepare and execute the users info query
    $stmtUsersInfo = $conn->prepare($usersInfoQuery);
    $stmtUsersInfo->bind_param("s", $idno);
    $stmtUsersInfo->execute();
    $usersInfoResult = $stmtUsersInfo->get_result();
}
?>
