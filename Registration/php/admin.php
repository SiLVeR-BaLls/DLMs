<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../log_in.php");
    exit();
}

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];
  
    $query = "SELECT * FROM `user_log` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['admin'] = $row;
        header("Location: admin.php");
        exit();
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if user is logged in as admin
$isLoggedIn = isset($_SESSION['admin']);

// Fetch data from the tables if logged in
if ($isLoggedIn) {
    $contactQuery = "SELECT * FROM contact";
    $addressQuery = "SELECT * FROM address";
    $adminsInfoQuery = "SELECT * FROM students_info";
    $usersInfoQuery = "SELECT * FROM users_info"; 

    $contactResult = mysqli_query($conn, $contactQuery);
    $addressResult = mysqli_query($conn, $addressQuery);
    $adminsInfoResult = mysqli_query($conn, $adminsInfoQuery);
    $usersInfoResult = mysqli_query($conn, $usersInfoQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        #qrcode-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .qrcode {
            margin: 10px;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>
<body>

<h1>Admin Dashboard</h1>

<?php if (!$isLoggedIn): ?>
    <h2>Login</h2>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <fieldset>
        <legend>Login Form</legend>
        <form method="POST">
            <table>
                <tr>
                    <td><label>UserName</label></td>
                    <td><input type="text" name="uname" placeholder="Enter User Name" required></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="password" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Login"></td>
                </tr>
            </table>
        </form>
    </fieldset>
<?php else: ?>
    <p><strong>Welcome, <?php echo $_SESSION['admin']['username']; ?>!</strong></p>
    <a href="?logout=true" style="color: red;">Logout</a>

    <h2>Contact Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>Email 1</th>
            <th>Email 2</th>
            <th>Contact 1</th>
            <th>Contact 2</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($contactResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['email1']; ?></td>
                <td><?php echo $row['email2']; ?></td>
                <td><?php echo $row['con1']; ?></td>
                <td><?php echo $row['con2']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Address Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>Municipality</th>
            <th>City</th>
            <th>Barangay</th>
            <th>Province</th>
            <th>Date of Birth</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($addressResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['municipality']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['barangay']; ?></td>
                <td><?php echo $row['province']; ?></td>
                <td><?php echo $row['DOB']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Admins Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>College</th>
            <th>Course</th>
            <th>Graduation Year</th>
            <th>Section</th>
            <th>Graduation Level</th>
            <th>Year Level</th>
            <th>A Level</th>
            <th>User Type</th>
            <th>Status</th>
            <th>QR Code</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($adminsInfoResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['GRAD_YR']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['GRAD_LVL']; ?></td>
                <td><?php echo $row['yrLVL']; ?></td>
                <td><?php echo $row['A_LVL']; ?></td>
                <td><?php echo $row['U_type']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td class="qrcode" data-id="<?php echo $row['IDno']; ?>" onclick="openModal('<?php echo $row['IDno']; ?>')">Generate</td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Users Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Name</th>
            <th>Extension Name</th>
            <th>Gender</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($usersInfoResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['Fname']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['Mname']; ?></td>
                <td><?php echo $row['Ename']; ?></td>
                <td><?php echo $row['gender']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php endif; ?>

<!-- Modal for QR Code -->
<div id="qrcodeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Your QR Code</h2>
        <div id
        ="qrcode-display"></div>
        <button id="download-btn" style="display:none;">Download QR Code</button>
    </div>
</div>

<script>
    function openModal(id) {
        $('#qrcode-display').empty().qrcode({
            text: id,
            width: 128,
            height: 128
        });
        $('#download-btn').off('click').on('click', function() {
            var canvas = $('#qrcode-display canvas')[0];
            var link = document.createElement('a');
            link.download = 'qrcode-.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
        $('#download-btn').show();
        $('#qrcodeModal').show();
    }

    function closeModal() {
        $('#qrcodeModal').hide();
    }

    $(document).ready(function() {
        $('.modal').click(function(event) {
            if ($(event.target).is('.modal')) {
                closeModal();
            }
        });
    });
</script>

<?php
// Close the connection
mysqli_close($conn);
?>

</body>
</html>

