<?php
session_start();

// Redirect users based on their session data
if (isset($_SESSION['admin'])) {
    header("Location: dashboard/admin/index.php");
    exit();
} elseif (isset($_SESSION['student'])) {
    header("Location: dashboard/student/index.php");
    exit();
} elseif (isset($_SESSION['librarian'])) {
    header("Location: dashboard/librarian/index.php");
    exit();
} elseif (isset($_SESSION['visitor'])) {
    header("Location: dashboard/admin/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Management System</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Registration/pic/logo.png" alt="Digital Library Logo">
        </div>
        <h1>Welcome to Digital Library Management System</h1>
        <p>We are delighted to have you here. Our library management system is designed to enhance your library experience by providing easy access to our vast collection of books, journals, and digital resources.</p>
        <center>
            <a href="Registration/log_in.php" style="text-decoration: none;" class="button">
                <button class="animated-button">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                    </svg>
                    <span class="text">Get Started</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                    </svg>
                </button>
            </a>
        </center>
    </div>
</body>
</html>
