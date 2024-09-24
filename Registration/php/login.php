<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "error";
} else {
    $message = "";
    $message_type = "";

    // Handle login form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get POST data
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        // Prepare SQL query to check credentials and get U_type from students_info
        $query = "
            SELECT user_log.*, students_info.U_type 
            FROM user_log 
            JOIN students_info ON user_log.id = students_info.user_id 
            WHERE user_log.username = ? AND user_log.password = ?
        ";

        // Prepare the statement
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();

            // Verify the password (Note: password hashing like bcrypt is recommended)
            if ($password === $data['password']) {
                // Login successful
                $message = "Login successful! Welcome back, " . $data['username'];
                $message_type = "success";
                
                // Start a session for the user
                session_start();
                $_SESSION['username'] = $data['username'];
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['U_type'] = $data['U_type']; // Store user type in session
            } else {
                // Incorrect password
                $message = "Incorrect password. Please try again.";
                $message_type = "error";
            }
        } else {
            // Username does not exist
            $message = "Username does not exist. Please try again.";
            $message_type = "error";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to display SweetAlert messages
        function showAlert(message, type) {
            Swal.fire({
                icon: type === 'success' ? 'success' : 'error',
                title: type === 'success' ? 'Welcome!' : 'Error',
                text: message,
                didClose: () => {
                    if (type === 'success') {
                        // Redirect to profile page or home page upon successful login
                        window.location.href = 'profile.php';
                    } else if (type === 'error') {
                        // Redirect back to the login page
                        window.history.back();
                    }
                }
            });
        }
    </script>
</head>

<body>
    <script>
        // Check if there's a message and type from PHP
        <?php if ($message): ?>
            document.addEventListener('DOMContentLoaded', function() {
                showAlert("<?php echo addslashes($message); ?>", "<?php echo $message_type; ?>");
            });
        <?php endif; ?>
    </script>
</body>

</html>
