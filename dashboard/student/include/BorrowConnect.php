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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IDno = $_POST["IDno"];
    $bookIDs = $_POST["bookID"];
    $errors = [];

    // Check if user exists
    $userCheck = $conn->prepare("SELECT * FROM users_info WHERE IDno = ?");
    $userCheck->bind_param("s", $IDno);
    $userCheck->execute();
    $userCheck->store_result();

    if ($userCheck->num_rows === 0) {
        $errors[] = "User with ID $IDno does not exist in the database.";
        $userCheck->close();
    } else {
        $userCheck->close();

        // Proceed with book borrowing process
        foreach ($bookIDs as $bookID) {
            $bookCheck = $conn->prepare("SELECT * FROM book_copies WHERE ID = ? AND status = 'available'");
            $bookCheck->bind_param("i", $bookID);
            $bookCheck->execute();
            $bookCheck->store_result();

            if ($bookCheck->num_rows > 0) {
                $stmt = $conn->prepare("INSERT INTO borrow_book (IDno, ID, borrow_date) VALUES (?, ?, NOW())");
                $stmt->bind_param("si", $IDno, $bookID);
                $stmt->execute();
                $stmt->close();

                $updateBook = $conn->prepare("UPDATE book_copies SET status = 'borrowed' WHERE ID = ?");
                $updateBook->bind_param("i", $bookID);
                $updateBook->execute();
                $updateBook->close();
            } else {
                $errors[] = "Book with ID $bookID is not available (it may be borrowed).";
            }
            $bookCheck->close();
        }
    }

    // Output Success or Error Messages with Redirect Link to borrow.php
    if (empty($errors)) {
        echo "<div class='alert success'>All borrow requests approved successfully!</div>";
        echo "<a href='../borrow.php' class='back-link'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 1000);</script>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert error'>$error</div>";
        }
        echo "<a href='borrow.php' class='back-link'>Go to Borrow Page</a>";
        echo "<script>setTimeout(() => { window.location.href = '../borrow.php'; }, 1000);</script>";
    }
}

$conn->close();
?>
