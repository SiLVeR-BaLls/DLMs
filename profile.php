<?php
session_start(); // Start the session

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'system');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Get the username from the session
$username = $_SESSION['username'];

// Fetch user data
$query = "SELECT * FROM registration WHERE Username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found!";
    exit();
}

$stmt->close();
$conn->close();

// Determine the gender label
$genderLabel = '';
switch ($user['gender']) {
    case 'm':
        $genderLabel = 'Mr.';
        break;
    case 'f':
        $genderLabel = 'Miss';
        break;
    case 'o':
        $genderLabel = 'Other';
        break;
    default:
        $genderLabel = 'Not Specified';
        break;
}

// Determine the position label
$positionLabel = '';
switch ($user['position']) {
    case 's':
        $positionLabel = 'Student';
        break;
    case 'f':
        $positionLabel = 'Faculty';
        break;
    default:
        $positionLabel = 'Not Specified';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .profile-info {
            color: #555;
            font-size: 1.1em;
            text-align: left;
            margin: 20px 0;
        }
        .profile-info div {
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .logout-btn {
            background-color: #f44336; /* Red */
            margin-top: 10px;
        }
        .logout-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <div><strong>Name:</strong> <?php echo htmlspecialchars($user['Fname'] . ' ' . $user['Mname'] . ' ' . $user['Sname']); ?></div>
            <div><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['DOB']); ?></div>
            <div><strong>Position:</strong> <?php echo htmlspecialchars($positionLabel); ?></div>
            <div><strong>Gender:</strong> <?php echo htmlspecialchars($genderLabel); ?></div>
            <div><strong>Department:</strong> <?php echo htmlspecialchars($user['dept']); ?></div>
            <div><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></div>
            <div><strong>Address:</strong> <?php echo htmlspecialchars($user['Address']); ?></div>
            <div><strong>Contact:</strong> <?php echo htmlspecialchars($user['Contact']); ?></div>
            <div><strong>Username:</strong> <?php echo htmlspecialchars($user['Username']); ?></div>
        </div>
        <a href="index.html" class="btn">Back to Home</a>
        <a href="logout.php" class="btn logout-btn">Log Out</a>
    </div>
</body>
</html>
