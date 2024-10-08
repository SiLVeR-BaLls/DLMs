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

// Start session
session_start();

// Check if the user is logged in (admin or student)
$isLoggedIn = isset($_SESSION['admin']) || isset($_SESSION['student']) ||  isset($_SESSION['visitor']);

// Get ID number from URL
$idNo = isset($_GET['id']) ? $_GET['id'] : null;

// Initialize student info
$studentInfo = null;

// Fetch student information if ID is provided and the user is logged in
if ($isLoggedIn && $idNo) {
    // Query with JOIN to fetch data from both tables
    $query = "SELECT students_info.*, users_info.* 
              FROM students_info 
              JOIN users_info ON students_info.IDno = users_info.IDno 
              WHERE students_info.IDno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $idNo); // Binding the ID number parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if student data is found
    if ($result->num_rows > 0) {
        $studentInfo = $result->fetch_assoc();  // Fetch the student data
    } else {
        echo "<p style='color: red;'>No student found with ID number: $idNo</p>";
    }
} else {
    echo "<p style='color: red;'>User not logged in or ID not provided.</p>";
}

// Close the connection
$stmt->close();
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card - <?php echo htmlspecialchars($idNo); ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        /* ID Card styling */
        .id-card {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 600px;
            height: 350px;
            background-color: white;
            overflow: hidden;
            margin: 20px auto;
        }

        .id-details {
            flex: 1;
            padding: 20px;
            text-align: left;
        }

        .id-details h2 {
            margin: 10px 0;
        }

        .id-qr {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 1px solid #ddd;
            padding: 20px;
        }

        #qrcode-display {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Print styles */
        @media print {
            body {
                background-color: white;
            }
            .id-card {
                box-shadow: none;
                width: auto;
                height: auto;
                margin: 0;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

<h1>ID Card Details</h1>

<?php if ($studentInfo): ?>
    <div class="id-card" id="id-card">
        <div class="id-details">
            <h2>ID No: <?php echo htmlspecialchars($studentInfo['IDno']); ?></h2>
            <p>Role: <?php echo htmlspecialchars($studentInfo['U_type']); ?></p> <!-- Display Role -->
            <p>First Name: <?php echo htmlspecialchars($studentInfo['Fname']); ?></p> <!-- Display First Name -->
            <p>Last Name: <?php echo htmlspecialchars($studentInfo['Sname']); ?></p> <!-- Display Last Name -->
            <p>Course: <?php echo htmlspecialchars($studentInfo['course']); ?></p>
            <p>Grade: <?php echo htmlspecialchars($studentInfo['GRAD_LVL']); ?></p>
            <p>Section: <?php echo htmlspecialchars($studentInfo['section']); ?></p>
        </div>
        <div class="id-qr">
            <div id="qrcode-display"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Generate QR code
            $('#qrcode-display').empty().qrcode({
                text: "<?php echo htmlspecialchars($studentInfo['IDno']); ?>", // Generating QR code for the student ID
                width: 128,
                height: 128
            });
        });

        function downloadIDCard() {
            var cardElement = document.getElementById("id-card");

            html2canvas(cardElement, {
                useCORS: true, // Enable cross-origin for images if needed
            }).then(function(canvas) {
                // Create an anchor element to download the image
                var link = document.createElement('a');
                link.download = 'ID-Card.png'; // File name
                link.href = canvas.toDataURL(); // Convert canvas to image URL
                link.click(); // Trigger the download
            });
        }
    </script>

    <button onclick="downloadIDCard()" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Download ID Card</button>
    <button class="return-button" onclick="window.history.back()">Return</button> <!-- Return button -->


    <?php endif; ?>

</body>
</html>