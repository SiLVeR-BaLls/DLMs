<?php
// admin_dashboard.php
session_start();
include 'db_connect.php';

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

// Query to fetch pending users
$query = "SELECT * FROM users WHERE status = 'pending'";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Display the error if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Pending Users</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Profile Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" style="width: 100px; height: 100px;"></td>
            <td>
                <a href="approve_user.php?id=<?php echo $user['user_id']; ?>">Approve</a>
                <a href="reject_user.php?id=<?php echo $user['user_id']; ?>">Reject</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
