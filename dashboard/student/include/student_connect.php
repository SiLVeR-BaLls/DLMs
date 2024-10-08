<?php
session_start();

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
        $_SESSION['student'] = $row;
        $isLoggedIn = true; // Set login status to true
        header("Location: student.php");
        exit();
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if user is logged in as student
$isLoggedIn = isset($_SESSION['student']);

// Fetch data from the tables if logged in
if ($isLoggedIn) {
    $contactQuery = "SELECT * FROM contact where IDno  = '".$_SESSION['student']['IDno']."'";
    $addressQuery = "SELECT * FROM address where IDno  = '".$_SESSION['student']['IDno']."'";
    $studentsInfoQuery = "SELECT * FROM students_info where IDno  = '".$_SESSION['student']['IDno']."'";
    $usersInfoQuery = "SELECT * FROM users_info where IDno  = '".$_SESSION['student']['IDno']."'"; 

    $contactResult = mysqli_query($conn, $contactQuery);
    $addressResult = mysqli_query($conn, $addressQuery);
    $studentsInfoResult = mysqli_query($conn, $studentsInfoQuery);
    $usersInfoResult = mysqli_query($conn, $usersInfoQuery);
}
?>