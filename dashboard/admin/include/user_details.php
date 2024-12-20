<?php
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User <?php echo htmlspecialchars($userInfo['Fname']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <a href="../BrowseUser.php" class="btn btn-secondary mb-3"><</a>
        <p><strong>Welcome, <?php echo htmlspecialchars($_SESSION['admin']['username']); ?>!</strong></p>

        <h2 class="mt-4">Users Information</h2>
        <table class="table table-bordered table-striped">
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

        <h2>Contact Information</h2>
        <table class="table table-bordered table-striped">
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
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['email2']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['con2']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Address Information</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>Municipality</th>
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
                        <td><?php echo htmlspecialchars($row['barangay']); ?></td>
                        <td><?php echo htmlspecialchars($row['province']); ?></td>
                        <td><?php echo htmlspecialchars($row['DOB']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Admins Information</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>IDno</th>
                    <th>College</th>
                    <th>Course</th>
                    <th>Year and Section</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($adminsInfoResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td><?php echo htmlspecialchars($row['college']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['yrLVL']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
