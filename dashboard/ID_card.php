<?php
include 'config.php';
// Start session

// Check if the user is logged in (admin or student)
$isLoggedIn = isset($_SESSION['admin']) || isset($_SESSION['student']) || isset($_SESSION['visitor']);

// Get ID number from URL and validate
$idNo = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

// Initialize student info
$studentInfo = null;

// Fetch student information if ID is provided and the user is logged in
if ($isLoggedIn && $idNo) {
    // Query with JOIN to fetch data from both tables
    $query = "SELECT user_details.*, users_info.*, user_log.* 
              FROM user_details 
              JOIN users_info ON user_details.IDno = users_info.IDno 
              JOIN user_log ON user_details.IDno = user_log.IDno 
              WHERE user_details.IDno = ?;";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $idNo); // Binding the ID number parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if student data is found
        if ($result->num_rows > 0) {
            $studentInfo = $result->fetch_assoc();  // Fetch the student data
        } else {
            echo "<p style='color: red;'>No student found with ID number: $idNo</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Error preparing statement: " . htmlspecialchars($conn->error) . "</p>";
    }
} else {
    echo "<p style='color: red;'>User not logged in or ID not provided.</p>";
}

// Close the connection
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
            background-color: #f4f4f9;
        }

        /* ID Card styling */
        .id-card {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 12px;
            width: 600px;
            height: 350px;
            background-color: white;
            overflow: hidden;
            margin: 20px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .id-details {
            flex: 1;
            padding-right: 15px;
            text-align: left;
        }

        .id-details h2 {
            margin: 10px 0;
            font-size: 1.4rem;
            color: #333;
        }

        .id-qr {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 15px;
            border-left: 1px solid #ddd;
        }

        #qrcode-display {
            width: 120px;
            height: 120px;
        }

        /* Profile photo styling */
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #007bff;
        }

        /* Button Styles */
        .button {
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
            margin: 10px;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .return-button {
            background-color: #f44336;
        }

        .return-button:hover {
            background-color: #d32f2f;
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

            .button {
                display: none;
            }
        }
    </style>
</head>
<body>

<h1>ID Card Details</h1>

<?php if ($studentInfo): ?>
    <div class="id-card" id="id-card">
        <div class="id-details">
            <img src="../pic/User/<?php echo htmlspecialchars($studentInfo['photo']); ?>" alt="Profile Photo" class="profile-photo"
                 onerror="this.onerror=null; this.src='../pic/User/default.png';"> <!-- Default image if fails -->
            <h2><?php echo htmlspecialchars($studentInfo['Fname']) . ' ' . htmlspecialchars($studentInfo['Sname']); ?></h2>
            <h3>ID No: <?php echo htmlspecialchars($studentInfo['IDno']); ?></h3>
            <p>Role: <?php echo htmlspecialchars($studentInfo['U_type']); ?></p>
            <p>Course: <?php echo htmlspecialchars($studentInfo['course']); ?></p>
            <p>Year and Section: <?php echo htmlspecialchars($studentInfo['yrLVL']); ?></p>
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

    <button onclick="downloadIDCard()" class="button">Download ID Card</button>
    <button class="return-button button" onclick="window.history.back()">Return</button>

<?php endif; ?>

</body>
</html>
