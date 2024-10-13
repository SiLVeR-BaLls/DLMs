
<?php
//for confirmation  of the user that it is adimin (well dont know how long)

session_start();

// Database Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create a database connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../../Registration/log_in.php");
    exit();
}

// Initialize variables
$isLoggedIn = false;
$error_message = "";

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user_log` WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($row = $result->fetch_assoc()) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row;
            $isLoggedIn = true; // Set login status to true

            // Redirect based on user type
            if ($row['U_type'] === 'admin') {
                header("Location: admin.php");
            } else {
                $error_message = "Access restricted to admins only!";
            }
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "Your Username or Password is incorrect!";
    }
}

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin'])) {
    header('Location: ../../../Registration/log_in.php'); // Redirect to the login page if not logged in
    exit();
}

// Assuming the U_type should be 'admin' for this page
$requiredUserType = 'admin';


// Fetch data for the logged-in admin
$idno = $_SESSION['admin']['IDno'];
$contactQuery = "SELECT * FROM contact WHERE IDno = ?";
$addressQuery = "SELECT * FROM address WHERE IDno = ?";
$adminsInfoQuery = "SELECT * FROM students_info WHERE IDno = ?";
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
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Character encoding and viewport settings -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QR Code | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- Online scripts and styles -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <!-- Custom styles camera button-->
    <style>
        #divvideo {
            box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
        }
        #stopCameraButton, #startCameraButton {
            margin-top: 10px;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        #stopCameraButton {
            background-color: red;
            color: white;
            display: none; /* Initially hidden */
        }
        #stopCameraButton:hover {
            background-color: darkred;
        }
        #startCameraButton {
            background-color: green;
            color: white;
        }
        #startCameraButton:hover {
            background-color: darkgreen;
        }
        .top {
    margin: 0px;
    padding: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: alabaster;
  }

  .logo{
    width: 10rem;
  }
    </style>
</head>

<body style="/*background-image: url(../../Registration/pic/polygon-scatter-haikei.png);*/ background-color: alabaster;">


<div class="top"  style="height: 10vh; margin:0px; padding:50px;  background-color: alabaster;">




           <a href="../index.php"><img class="logo" src="../../../Registration/pic/logo wu.png" alt="Logo"></a>
           <strong>Digital Library Management System</strong>
          </div>
          

    <!-- Main Container -->
    <div class="container">
        <div class="row">

            <!-- QR Code Scanner -->
            <div class="col-md-4" style="padding:10px;background:#fff;border-radius: 5px;" id="divvideo">
                <center><p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> TAP HERE</p></center>
                <video id="preview" width="100%" style="border-radius:10px;"></video>
                <br>
                <button id="stopCameraButton">Stop Camera</button>
                <button id="startCameraButton">Start Camera</button>
                <br><br>

                <!-- Display Error and Success Messages -->
                <?php
                if(isset($_SESSION['error'])){
                    echo "
                    <div class='alert alert-danger alert-dismissible' style='background:red;color:#fff'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        ".$_SESSION['error']."
                    </div>
                    ";
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo "
                    <div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        ".$_SESSION['success']."
                    </div>
                    ";
                    unset($_SESSION['success']);
                }
                ?>
            </div>
            
            <!-- Form and Data Table -->
            <div class="col-md-8">
                <!-- Form for QR Code scanning -->
                <form action="insert.php" method="post" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
                    <i class="glyphicon glyphicon-qrcode"></i> <label>SCAN QR CODE</label> <p id="time"></p>
                    <input type="text" name="studentID" id="text" placeholder="scan qrcode" class="form-control" autofocus>
                </form>

                <!-- Data Table for Attendance Records -->
                <div style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>User ID</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Time In</td>
                                <td>Time Out</td>
                                <td>Log Date</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // PHP to fetch and display attendance records
                            $server = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "dlms";
                        
                            $conn = new mysqli($server, $username, $password, $dbname);
                            $date = date('Y-m-d');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "
    SELECT a.ID, a.IDno, u.Fname, u.Sname, a.TIMEIN, a.TIMEOUT, a.LOGDATE, a.STATUS
    FROM attendance a
    JOIN users_info u ON a.IDno = u.IDno
    WHERE a.LOGDATE = CURDATE()
";

                            $query = $conn->query($sql);
                            while ($row = $query->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['IDno']; ?></td>
                                    <td><?php echo $row['Fname']; ?></td>
                                    <td><?php echo $row['Sname']; ?></td>
                                    <td><?php echo $row['TIMEIN']; ?></td>
                                    <td><?php echo $row['TIMEOUT']; ?></td>
                                    <td><?php echo $row['LOGDATE']; ?></td>
                                    <td><?php echo $row['STATUS'] == 1 ? 'Out' : ' In'; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                   
                </div> 
                
                <!-- Export Button -->
                <button type="submit" class="btn btn-success pull-right" onclick="Export()">
                    <i class="fa fa-excel-o fa-fw"></i> Export to excel
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript for exporting data -->
    <script>
        function Export() {
            var conf = confirm("Please confirm if you wish to proceed in exporting the attendance into Excel file");
            if (conf == true) {
                window.open("export.php", '_blank');
            }
        }
    </script>

    <!-- JavaScript for QR Code scanning -->
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        let activeCamera = null;

        function startCamera() {
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    activeCamera = cameras[0];
                    scanner.start(activeCamera);
                    document.getElementById('startCameraButton').style.display = 'none';
                    document.getElementById('stopCameraButton').style.display = 'block';
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e) {
                console.error(e);
            });
        }

        document.getElementById('startCameraButton').addEventListener('click', function() {
            if (!activeCamera) {
                startCamera();
            }
        });

        document.getElementById('stopCameraButton').addEventListener('click', function() {
            if (activeCamera) {
                scanner.stop();
                activeCamera = null;
                document.getElementById('startCameraButton').style.display = 'block';
                document.getElementById('stopCameraButton').style.display = 'none';
            }
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });

        // Start the camera by default
        startCamera();
    </script>

    <!-- JavaScript for updating time -->
    <script type="text/javascript">
        var timestamp = '<?=time();?>';
        function updateTime() {
            $('#time').html(new Date(timestamp * 1000).toLocaleString());
            timestamp++;
        }
        $(function() {
            setInterval(updateTime, 1000);
        });
    </script>

    <!-- JavaScript libraries 
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
-->

    <!-- JavaScript libraries -->
    <script src="plugs/jquery.min.js"></script>
    <script src="plugs/bootstrap.min.js"></script>
    <script src="plugs/jquery.dataTables.min.js"></script>
    <script src="plugs/dataTables.bootstrap4.min.js"></script>
    <script src="plugs/dataTables.responsive.min.js"></script>
    <script src="plugs/responsive.bootstrap4.min.js"></script>

    <!-- DataTables initialization -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>
</html>
