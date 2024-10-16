<?php
session_start(); // Start the session if it's not already started

// Destroy the session to log out the user
session_destroy();

// Redirect to the login page after logging out
header("Location: ../Registration/log_in.php"); // Adjust path if needed
exit();
?>
