<?php
session_start();
include '../../config.php';

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user information
    $usersInfoResult = mysqli_query($conn, "SELECT * FROM users_info WHERE IDno = '$id'");
    $contactResult = mysqli_query($conn, "SELECT * FROM contact WHERE IDno = '$id'");
    $addressResult = mysqli_query($conn, "SELECT * FROM address WHERE IDno = '$id'");
    $adminsInfoResult = mysqli_query($conn, "SELECT * FROM user_details WHERE IDno = '$id'");

    // Fetch data
    $userInfo = mysqli_fetch_assoc($usersInfoResult);
    // If user not found, redirect or handle error
    if (!$userInfo) {
        echo "User not found.";
        exit;
    }
}

// Handle deletion
if (isset($_POST['delete'])) {
    $deleteQuery = "DELETE FROM users_info WHERE IDno = '$id'";
    mysqli_query($conn, $deleteQuery);
    header("Location: ../users_list.php"); // Redirect to the users list page after deletion
    exit;
}
?>
<title>user <?php echo htmlspecialchars($userInfo['Fname']); ?></title>
<body>
    <div class="body_contain">

    <a href="../BrowseUser.php" class="btn btn-secondary"><</a>

        <p><strong style="color: #fff;">Welcome, <?php echo htmlspecialchars($_SESSION['admin']['username']); ?>!</strong></p>

        <h2 style="color: #ffffff;">Users Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Extension Name</th>
                    <th>Gender</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($userInfo['IDno']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['Fname']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['Sname']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['Mname']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['Ename']); ?></td>
                    <td><?php echo htmlspecialchars($userInfo['gender']); ?></td>
                    <td>
                    <?php if (!empty($userInfo['photo'])): ?>
    <img src="../../../pic/User/<?php echo htmlspecialchars($userInfo['photo']); ?>" 
         alt="User Photo" 
         style="height: 100px; object-fit: cover;">
<?php else: ?>
    <span>No Photo</span>
<?php endif; ?>

                    </td>
                </tr>
            </tbody>
        </table>

        <h2 style="color: #ffffff;">Contact Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>Email 1</th>
                    <th>Email 2</th>
                    <th>Contact 1</th>
                    <th>Contact 2</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($contactResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td><?php echo htmlspecialchars($row['email1']); ?></td>
                        <td><?php echo htmlspecialchars($row['email2']); ?></td>
                        <td><?php echo htmlspecialchars($row['con1']); ?></td>
                        <td><?php echo htmlspecialchars($row['con2']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 style="color: #ffffff;">Address Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>Municipality</th>
                    <th>City</th>
                    <th>Barangay</th>
                    <th>Province</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($addressResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td><?php echo htmlspecialchars($row['municipality']); ?></td>
                        <td><?php echo htmlspecialchars($row['city']); ?></td>
                        <td><?php echo htmlspecialchars($row['barangay']); ?></td>
                        <td><?php echo htmlspecialchars($row['province']); ?></td>
                        <td><?php echo htmlspecialchars($row['DOB']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 style="color: #ffffff;">Admins Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>College</th>
                    <th>Course</th>
                    <th>Graduation Year</th>
                    <th>Section</th>
                    <th>Graduation Level</th>
                    <th>Year Level</th>
                    <th>A Level</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($adminsInfoResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td><?php echo htmlspecialchars($row['college']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['GRAD_YR']); ?></td>
                        <td><?php echo htmlspecialchars($row['section']); ?></td>
                        <td><?php echo htmlspecialchars($row['GRAD_LVL']); ?></td>
                        <td><?php echo htmlspecialchars($row['yrLVL']); ?></td>
                        <td><?php echo htmlspecialchars($row['A_LVL']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form method="post" action="">
            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger">Delete User</button>
            <a href="../users_list.php" class="btn btn-secondary" style="margin-left: 5px;">Return</a>
        </form>
    </div>

    <style>
        body {
            background-color: #2c2f33;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
        }
        .container {
            background: #3c4043;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: auto;
        }
        .table {
            margin-bottom: 20px;
            background-color: #4f545c;
            color: #ffffff;
        }
        th {
            background-color: #3f444e;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            background-color: #7289da; /* A bluish theme */
        }
        .btn-danger {
            background-color: #e84e4e; /* Red for delete */
        }
        .btn-secondary {
            background-color: #99aab5; /* Grey for return */
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</body>
