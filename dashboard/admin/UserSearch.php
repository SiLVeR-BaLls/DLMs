<!-- UserSearch.php -->

<?php
include '../config.php';


// Get the IDno from the request
$IDno = $_GET['IDno'];

// Query to search for the user by IDno
$sql = "SELECT users_info.IDno,
               users_info.Fname,
               user_log.U_type 
        FROM users_info
        JOIN user_log ON users_info.IDno = user_log.IDno
        WHERE users_info.IDno LIKE ?";
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
         - Name: " . htmlspecialchars($row['U_type']) . "<br>
         </div>";
    }
} else {
    echo "<div>No user found with ID: $IDno</div>";
}

// Close the connection
$stmt->close();
$conn->close();
?>
