
<?php
include '../../config.php';

// Function to calculate the due date based on user type
function calculateDueDate($U_type) {
    $currentDate = new DateTime();

    if ($U_type === 'student') {
        // Add 3 weekdays (excluding Saturday and Sunday)
        $daysToAdd = 0;
        while ($daysToAdd < 3) {
            $currentDate->modify('+1 day');
            $dayOfWeek = $currentDate->format('N'); // 1 = Monday, 7 = Sunday
            if ($dayOfWeek < 6) { // weekdays only
                $daysToAdd++;
            }
        }
    } elseif (in_array($U_type, ['librarian', 'professor', 'super_librarian'])) {
        // Add 3 months for librarian and professors
        $currentDate->modify('+3 months');
    }

    return $currentDate->format('Y-m-d'); // Return due date in YYYY-MM-DD format
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IDno = $_POST["IDno"];
    $bookIDs = $_POST["bookID"];
    $errors = [];

    // Fetch the user's U_type
    $userTypeQuery = $conn->prepare("SELECT U_type FROM user_log WHERE IDno = ?");
    $userTypeQuery->bind_param("s", $IDno);
    $userTypeQuery->execute();
    $result = $userTypeQuery->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $U_type = $row['U_type'];

        // Calculate the due date
        $dueDate = calculateDueDate($U_type);

        // Proceed with the book borrowing process
        foreach ($bookIDs as $bookID) {
            // Check if the book is available
            $bookCheck = $conn->prepare("SELECT * FROM book_copies WHERE ID = ? AND status = 'available'");
            $bookCheck->bind_param("i", $bookID);
            $bookCheck->execute();
            $bookCheck->store_result();

            if ($bookCheck->num_rows > 0) {
                // Insert the borrowing record with borrow date and due date
                $stmt = $conn->prepare("INSERT INTO borrow_book (IDno, ID, borrow_date, due_date) VALUES (?, ?, NOW(), ?)");
                $stmt->bind_param("sis", $IDno, $bookID, $dueDate);
                $stmt->execute();

                // Update the book status to 'borrowed'
                $updateBook = $conn->prepare("UPDATE book_copies SET status = 'borrowed' WHERE ID = ?");
                $updateBook->bind_param("i", $bookID);
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
        echo "<div class='alert alert-success p-4 mb-4 rounded-lg font-semibold text-center w-4/5 max-w-xl mx-auto bg-green-500 text-white'>All borrow requests have been successfully approved! Due date: $dueDate</div>";
        echo "<a href='../borrow.php' class='block text-center mt-4 p-2 w-40 mx-auto bg-gray-800 text-white rounded-md hover:bg-gray-600'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 2000);</script>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-error p-4 mb-4 rounded-lg font-semibold text-center w-4/5 max-w-xl mx-auto bg-red-500 text-white'>$error</div>";
        }
        echo "<a href='../borrow.php' class='block text-center mt-4 p-2 w-40 mx-auto bg-gray-800 text-white rounded-md hover:bg-gray-600'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 5000);</script>";
    }
}


$conn->close();
?>
    <script src="https://cdn.tailwindcss.com"></script>
