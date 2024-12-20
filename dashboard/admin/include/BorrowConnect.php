<style>
    .alert {
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        width: 80%;
        max-width: 600px;
        margin: 20px auto;
    }

    .alert.success {
        background-color: #4CAF50; /* Green */
        color: white;
    }

    .alert.error {
        background-color: #f44336; /* Red */
        color: white;
    }

    .back-button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .back-button:hover {
        background-color: #555;
    }
</style>

<?php
include '../../config.php';

// Function to calculate the due date based on user type
function calculateDueDate($U_Type) {
    $currentDate = new DateTime();

    if ($U_Type === 'student') {
        // Add 3 weekdays (excluding Saturday and Sunday)
        $daysToAdd = 0;
        while ($daysToAdd < 3) {
            $currentDate->modify('+1 day');
            $dayOfWeek = $currentDate->format('N'); // 1 = Monday, 7 = Sunday
            if ($dayOfWeek < 6) { // weekdays only
                $daysToAdd++;
            }
        }
    } elseif (in_array($U_Type, ['admin', 'professor', 'super_admin'])) {
        // Add 3 months for admin and professors
        $currentDate->modify('+3 months');
    }

    return $currentDate->format('Y-m-d'); // Return due date in YYYY-MM-DD format
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IDno = $_POST["IDno"];
    $bookIDs = $_POST["bookID"];
    $errors = [];

    // Fetch the user's U_Type
    $userTypeQuery = $conn->prepare("SELECT U_Type FROM user_log WHERE IDno = ?");
    $userTypeQuery->bind_param("s", $IDno);
    $userTypeQuery->execute();
    $result = $userTypeQuery->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $U_Type = $row['U_Type'];

        // Calculate the due date
        $dueDate = calculateDueDate($U_Type);

        // Proceed with the book borrowing process
        foreach ($bookIDs as $bookID) {
            // Check if the book is available
            $bookCheck = $conn->prepare("SELECT * FROM book_copies WHERE book_id = ? AND status = 'available'");
            $bookCheck->bind_param("s", $bookID);
            $bookCheck->execute();
            $bookCheck->store_result();

            if ($bookCheck->num_rows > 0) {
                // Insert the borrowing record with borrow date and due date
                $stmt = $conn->prepare("INSERT INTO borrow_book (IDno, book_id, borrow_date, due_date) VALUES (?, ?, NOW(), ?)");
                $stmt->bind_param("sss", $IDno, $bookID, $dueDate);
                $stmt->execute();

                // Update the book status to 'borrowed'
                $updateBook = $conn->prepare("UPDATE book_copies SET status = 'borrowed' WHERE book_id = ?");
                $updateBook->bind_param("s", $bookID);
                $updateBook->execute();

                $stmt->close();
                $updateBook->close();
            } else {
                $errors[] = "Book with ID <b>$bookID</b> is not available (it may be borrowed).";
            }
            $bookCheck->close();
        }
    } else {
        $errors[] = "User with ID <b>$IDno</b> does not exist in the user log.";
    }

    $userTypeQuery->close();

    // Output Success or Error Messages
    if (empty($errors)) {
        echo "<div class='alert success'>All borrow requests have been successfully approved! Due date: $dueDate</div>";
        echo "<a href='../borrow.php' class='back-button'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 2000);</script>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert error'>$error</div>";
        }
        echo "<a href='../borrow.php' class='back-button'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 5000);</script>";
    }
}

$conn->close();
?>
