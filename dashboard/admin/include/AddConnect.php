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
                $message = "Error inserting book: " . $conn->error;
                $message_type = "error";
            } else {
                $message = "Book registration successful!";
                $message_type = "success";

                // Get the last inserted id
                $last_id = $conn->insert_id;

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

                // Insert Series
                $sql = "INSERT INTO Series (B_title, title, volume, IL, lexille, F_and_P, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";
                executeStatement($conn, $sql, "ssissss", $B_title, $series, $volume, $IL, $lexille, $F_and_P, $comments);

                // Insert Resource
                $sql = "INSERT INTO Resource (B_title, url, Description) VALUES (?, ?, ?)";
                executeStatement($conn, $sql, "sss", $B_title, $url, $Description);

                // Insert Alternate Title
                $sql = "INSERT INTO AlternateTitle (B_title, UTitle, VForm, SUTitle) VALUES (?, ?, ?, ?)";
                executeStatement($conn, $sql, "ssss", $B_title, $UTitle, $VForm, $SUTitle);

                // Insert CoAuthors
                $coAuthors = $_POST['Co_Name'] ?? [];
                $coAuthorDates = $_POST['Co_Date'] ?? [];
                $coAuthorRoles = $_POST['Co_Role'] ?? [];

                foreach ($coAuthors as $index => $coAuthor) {
                    $coAuthorDate = $coAuthorDates[$index] ?? '';
                    $coAuthorRole = $coAuthorRoles[$index] ?? '';

                    // Prepare statement for co-authors
                    $stmt = $conn->prepare("INSERT INTO coauthor (B_title, Co_Name, Co_Date, Co_Role) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $B_title, $coAuthor, $coAuthorDate, $coAuthorRole);
                    $stmt->execute();
                }

                // Insert Subject using foreach
                $subHeads = $_POST['Sub_Head'] ?? [];
                $subHeadsInputs = $_POST['Sub_Head_input'] ?? [];
                $subBody1s = $_POST['Sub_Body_1'] ?? [];
                $subInput1s = $_POST['Sub_input_1'] ?? [];
                $subBody2s = $_POST['Sub_Body_2'] ?? [];
                $subInput2s = $_POST['Sub_input_2'] ?? [];
                $subBody3s = $_POST['Sub_Body_3'] ?? [];
                $subInput3s = $_POST['Sub_input_3'] ?? [];

                // Iterate over all the subject fields
                foreach ($subHeads as $index => $subHead) {
                    $subHeadInput = $subHeadsInputs[$index] ?? '';
                    $subBody1 = $subBody1s[$index] ?? '';
                    $subInput1 = $subInput1s[$index] ?? '';
                    $subBody2 = $subBody2s[$index] ?? '';
                    $subInput2 = $subInput2s[$index] ?? '';
                    $subBody3 = $subBody3s[$index] ?? '';
                    $subInput3 = $subInput3s[$index] ?? '';

                    // Insert each subject
                    $sql = "INSERT INTO Subject (B_title, Sub_Head, Sub_Head_input, Sub_Body_1, Sub_input_1, Sub_Body_2, Sub_input_2, Sub_Body_3, Sub_input_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    executeStatement($conn, $sql, "sssssssss", $B_title, $subHead, $subHeadInput, $subBody1, $subInput1, $subBody2, $subInput2, $subBody3, $subInput3);
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
    if ($stmt === false) {
        return false; // Return false if the statement preparation fails
    }
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
                        window.location.href = '../index.php'; // Redirect to the index page
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
