<!--<?php
// Your PHP code to process the form submission goes here
// For example:

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

    // Insert user data into tables
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get POST data
        // Your data extraction and insertion code here
        
        // Example insertion and checks
        if ($result_success) {
            $message = "Registration successful!";
            $message_type = "success";
        } else {
            $message = "Error: IDno already exists";
            $message_type = "error";
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Processing</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(message, type) {
            Swal.fire({
                icon: type === 'success' ? 'success' : 'error',
                title: type === 'success' ? 'Success' : 'Error',
                text: message,
                didClose: () => {
                    if (type === 'success') {
                        window.location.href = 'index.php'; // Redirect to the index page
                    } else if (type === 'error') {
                        window.location.href = 'registration.php'; // Redirect back to the registration page
                    }
                }
            });
        }
    </script>
</head>
<body>
    <script>
        <?php if ($message): ?>
            document.addEventListener('DOMContentLoaded', function() {
                showAlert("<?php echo addslashes($message); ?>", "<?php echo $message_type; ?>");
            });
        <?php endif; ?>
    </script>
</body>
</html>
        -->