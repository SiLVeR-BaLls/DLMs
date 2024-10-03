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
    $gender = $Sname = $username = ""; // Empty defaults
} else {
    $message = "";
    $message_type = "";
    $gender = $Sname = $username = ""; // Empty defaults

    // Insert user data into tables
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get POST data
        $Fname = $_POST['Fname'];
        $Sname = $_POST['Sname'];
        $Mname = $_POST['Mname'];
        $Ename = $_POST['Ename'] ?? '';
        $gender = $_POST['gender']??'';
        $DOB = $_POST['DOB'];
        $GRAD_LVL = $_POST['GRAD_LVL'];
        $GRAD_YR = $_POST['GRAD_YR'];
        $municipality = $_POST['municipality'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $province = $_POST['province'];
        $email1 = $_POST['mail1'];
        $email2 = $_POST['mail2'];
        $con1 = $_POST['con1'];
        $con2 = $_POST['con2'];
        $username = $_POST['username'];
        $password = $_POST['password']; // No hashing
        $IDno = $_POST['IDno'];
       $U_type = $_POST['U_type'];
        $A_LVL = $_POST['A_LVL'];
        $status = $_POST['status'];
        $college = $_POST['college']??'';
        $course = $_POST['course']??'';
        $yrLVL = $_POST['yrLVL'];
        $section = $_POST['section'];

        // Check if IDno already exists
        $query = "SELECT * FROM users_info WHERE IDno = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $IDno);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Error: IDno already exists";
            $message_type = "error";
        } else {
            // Insert into users table
            $sql = "INSERT INTO users_info (IDno, Fname, Sname, Mname, Ename, gender) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $IDno, $Fname, $Sname, $Mname, $Ename, $gender);
            $stmt->execute();

            // Get the last inserted ID
            $user_id = $conn->insert_id;

            // Insert into addresses table
            $sql = "INSERT INTO address (IDno, municipality, city, barangay, province, DOB) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $IDno, $municipality, $city, $barangay, $province, $DOB);
            $stmt->execute();
            
            // Insert into students_info table
            $sql = "INSERT INTO students_info (IDno, college, course, GRAD_YR, section, GRAD_LVL, yrLVL, A_LVL, U_type, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssisssiss", $IDno, $college, $course, $GRAD_YR, $section, $GRAD_LVL, $yrLVL, $A_LVL, $U_type, $status);
            $stmt->execute();

            // Insert into user_log table
            $sql = "INSERT INTO user_log (IDno, username, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $IDno, $username, $password);
            $stmt->execute();

            // Insert into contact table
            $sql = "INSERT INTO contact (IDno, email1, email2, con1, con2) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $IDno, $email1, $email2, $con1, $con2);
            $stmt->execute();
            $message = "Registration successful!";
            $message_type = "success";
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
    <title>Form Processing</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(message, type) {
            Swal.fire({
                icon: type === 'success' ? 'success' : 'error',
                title: type === 'success' ? 'Congratulations!' : 'Error',
                text: message,
                didClose: () => {
                    if (type === 'success') {
                        window.location.href = '../log_in.html'; // Redirect to the index page
                    } else if (type === 'error') {
                // Redirect back to the registration page using history.back()
                // This will take the user to the previous page in their history stack
                window.history.back();
              }
                }
            });
        }

        function formatGender(gender) {
            switch (gender.toLowerCase()) {
                case 'f':
                    return 'Mrs';
                case 'm':
                    return 'Mr';
                case 'o':

                    return 'Msr';
            }
        }
    </script>
</head>
<body>
    <script>
        // Check if there's a message and type
        <?php if ($message): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var formattedGender = formatGender("<?php echo addslashes($gender); ?>");
                var fullMessage = "<?php echo addslashes($message); ?>";

                if ("<?php echo $message_type; ?>" === 'success') {
                    showAlert(`Congrats ${formattedGender} ${"<?php echo addslashes($Sname); ?>"}, your username is ${"<?php echo addslashes($username); ?>"}`, "success");
                } else {
                    showAlert(fullMessage, "error");
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>
