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

        // Prepare and execute SQL query to check user credentials
        $query = "SELECT * FROM user_log WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();

            // Verify the password (Note: Password hashing is recommended)
            if ($password === $data['password']) {
                // Login successful
                $message = "Login successful! Welcome back, " . $data['username'];
                $message_type = "success";
                // Start a session for the user (optional)
                session_start();
                $_SESSION['username'] = $data['username'];
                $_SESSION['user_id'] = $data['id'];
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
       
function login() {
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;
    
    const storedUser = JSON.parse(localStorage.getItem('user'));
    
    if (storedUser && storedUser.username === username && storedUser.password === password) {
        if (storedUser.role === 'admin') {
            window.location.href = 'landing-admin.html';
        } else {
            window.location.href = 'landing-user.html';
        }
    } else {
        alert('Invalid username or password.');
    }
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