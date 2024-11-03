<?php
include 'db_connect.php';
include 'navbar.php'; // Include the navbar at the top of the page

echo "<h2>Registered Users</h2>";
$result = $conn->query("SELECT id, username, email, registered_at FROM users");

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Email</th><th>Registered At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td><td>" . $row["registered_at"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
$conn->close();
?>
