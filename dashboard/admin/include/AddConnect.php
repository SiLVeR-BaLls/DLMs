<?php
// Configuration
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Check connection
if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "error";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get POST data for Book
        $B_title = $_POST['B_title'] ?? '';
        $subtitle = $_POST['subtitle'] ?? '';
        $author = $_POST['author'] ?? '';
        $edition = $_POST['edition'] ?? '';
        $LCCN = $_POST['LCCN'] ?? '';
        $ISBN = $_POST['ISBN'] ?? '';
        $ISSN = $_POST['ISSN'] ?? '';
        $MT = $_POST['MT'] ?? '';
        $ST = $_POST['ST'] ?? '';
        $place = $_POST['place'] ?? '';
        $publisher = $_POST['publisher'] ?? '';
        $Pdate = $_POST['Pdate'] ?? '';
        $copyright = $_POST['copyright'] ?? '';
        $extent = $_POST['extent'] ?? '';
        $Odetail = $_POST['Odetail'] ?? '';
        $size = $_POST['size'] ?? '';

        // Check for duplicate B_title
        $checkSql = "SELECT COUNT(*) FROM Book WHERE B_title = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $B_title);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            $message = "A book with this title already exists.";
            $message_type = "error";
        } else {
            // Insert into Book table
            $sql = "INSERT INTO Book (B_title, subtitle, author, edition, LCCN, ISBN, ISSN, MT, ST, place, publisher, Pdate, copyright, extent, Odetail, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if (!executeStatement($conn, $sql, "ssssssssssssssss", $B_title, $subtitle, $author, $edition, $LCCN, $ISBN, $ISSN, $MT, $ST, $place, $publisher, $Pdate, $copyright, $extent, $Odetail, $size)) {
                $message .= "Error inserting book: " . $conn->error . "<br>";
                $message_type = "error";
            } else {
                $message .= "Book registration successful!";
                $message_type = "success";

                // Verify the book was inserted
                $last_id = $conn->insert_id; // Get the last inserted id
                if ($last_id > 0) {
                    // Prepare additional inserts
                    $series = $_POST['series'] ?? '';
                    $volume = $_POST['volume'] ?? '';
                    $IL = $_POST['IL'] ?? '';
                    $lexille = $_POST['lexille'] ?? '';
                    $F_and_P = $_POST['F_and_P'] ?? '';
                    $comments = $_POST['comments'] ?? '';
                    $url = $_POST['url'] ?? '';
                    $Description = $_POST['Description'] ?? '';
                    $UTitle = $_POST['UTitle'] ?? '';
                    $VForm = $_POST['VForm'] ?? '';
                    $SUTitle = $_POST['SUTitle'] ?? '';
                    $Co_Name = $_POST['Co_Name'] ?? '';
                    $Co_Date = $_POST['Co_Date'] ?? '';
                    $Co_Role = $_POST['Co_Role'] ?? '';

                    // Insert Series
                    $sql = "INSERT INTO Series (B_title, title, volume, IL, lexille, F_and_P, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    executeStatement($conn, $sql, "ssissss", $B_title, $series, $volume, $IL, $lexille, $F_and_P, $comments);

                    // Insert Subject
                    $Sub_Head = $_POST['Sub_Head'] ?? '';
                    $Sub_Head_input = $_POST['Sub_Head_input'] ?? '';
                    $Sub_Body_1 = $_POST['Sub_Body_1'] ?? '';
                    $Sub_input_1 = $_POST['Sub_input_1'] ?? '';
                    $Sub_Body_2 = $_POST['Sub_Body_2'] ?? '';
                    $Sub_input_2 = $_POST['Sub_input_2'] ?? '';
                    $Sub_Body_3 = $_POST['Sub_Body_3'] ?? '';
                    $Sub_input_3 = $_POST['Sub_input_3'] ?? '';

                    $sql = "INSERT INTO Subject (B_title, Sub_Head, Sub_Head_input, Sub_Body_1, Sub_input_1, Sub_Body_2, Sub_input_2, Sub_Body_3, Sub_input_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    executeStatement($conn, $sql, "sssssssss", $B_title, $Sub_Head, $Sub_Head_input, $Sub_Body_1, $Sub_input_1, $Sub_Body_2, $Sub_input_2, $Sub_Body_3, $Sub_input_3);

                    // Insert Resource
                    $sql = "INSERT INTO Resource (B_title, url, Description) VALUES (?, ?, ?)";
                    executeStatement($conn, $sql, "sss", $B_title, $url, $Description);

                    // Insert Alternate Title
                    $sql = "INSERT INTO AlternateTitle (B_title, UTitle, VForm, SUTitle) VALUES (?, ?, ?, ?)";
                    executeStatement($conn, $sql, "ssss", $B_title, $UTitle, $VForm, $SUTitle);

                    // Insert CoAuthor
                    $sql = "INSERT INTO CoAuthor (B_title, Co_Name, Co_Date, Co_Role) VALUES (?, ?, ?, ?)";
                    executeStatement($conn, $sql, "ssss", $B_title, $Co_Name, $Co_Date, $Co_Role);
                } else {
                    $message = "Failed to register the book, cannot insert series.";
                    $message_type = "error";
                }
            }
        }

        // Close the connection
        $conn->close();
    }
}

// Function to execute a prepared statement and return success status
function executeStatement($conn, $sql, $types, ...$params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Processing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(message, type) {
            if (type === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: message,
                    didClose: () => {
                        window.location.href = '../BrowseUser.php'; // Redirect to the index page
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                    didClose: () => {
                        window.history.back(); // Redirect back on error
                    }
                });
            }
        }
    </script>
</head>
<body>
    <script>
        // Check if there's a message and type
        <?php if ($message): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var fullMessage = "<?php echo addslashes($message); ?>";
                var messageType = "<?php echo $message_type; ?>";

                showAlert(fullMessage, messageType);
            });
        <?php endif; ?>
    </script>
</body>
</html>
