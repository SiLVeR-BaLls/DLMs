<?php
include '../config.php';

// Get the IDno from the request
$IDno = $_GET['IDno'];

// Query to search for the user by IDno, only where status is 'approve'
$sql = "SELECT users_info.IDno,
               users_info.Fname,
               user_log.U_type
        FROM users_info
        JOIN user_log ON users_info.IDno = user_log.IDno
        WHERE users_info.IDno LIKE ? AND user_log.status = 'approved'"; // Added status condition

$stmt = $conn->prepare($sql);
$searchParam = "%$IDno%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>
        User ID: " . htmlspecialchars($row['IDno']) . "<br>
        - Name: " . htmlspecialchars($row['Fname']) . "<br>
        - User Type: " . htmlspecialchars($row['U_type']) . "<br>
        </div>";
    }
} else {
    echo "<div>No approved user found with ID: $IDno</div>"; // Modified message to reflect approved status
}

// Close the connection
$stmt->close();
$conn->close();
?>
