<!-- retunbook.php -->

<?php
include 'include/ReturnConnect.php';


// Handle AJAX request to fetch borrow book details
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true' && isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // SQL query to join `book`, `book_copies`, and `borrow_book` tables
    $stmt = $conn->prepare("
        SELECT book.id, book.B_title, book.author, book.publisher, 
               book_copies.copy_ID, borrow_book.ID, borrow_book.IDno, 
               borrow_book.borrow_date, borrow_book.return_date
        FROM borrow_book
        JOIN book_copies ON borrow_book.ID = book_copies.ID
        JOIN book ON book_copies.B_title = book.B_title
        WHERE borrow_book.return_date IS NULL AND borrow_book.ID = ?
    ");

    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the row data
        $borrow = $result->fetch_assoc();
        $response = "<p><strong>Borrow ID:</strong> " . $borrow['ID'] . "</p>";
        $response .= "<p><strong>Book Title:</strong> " . $borrow['B_title'] . "</p>";
        $response .= "<p><strong>Borrow Date:</strong> " . $borrow['borrow_date'] . "</p>";
        $response .= "<p><strong>Return Date:</strong> " . ($borrow['return_date'] ? $borrow['return_date'] : 'Not returned yet') . "</p>";
        echo $response;
    } else {
        echo "<p class='text-red-500'>No active borrow record found for this ID.</p>";
    }

    $conn->close();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and Return Book Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Main Content Section (Return Book Form) -->
        <div class="flex-grow p-6">
            <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
                <!-- Return Book Form -->
                <center>
                    <h2 class="text-2xl font-semibold mb-4">Return Book</h2>

                    <!-- Form -->
                    <form method="POST" action="">
                        <div>
                            <label for="ID" class="block text-lg">Borrow ID:</label>
                            <input type="text" id="ID" name="ID" required class="w-full p-2 border border-gray-300 rounded-md" oninput="fetchBorrowDetails()">
                        </div>
                        <div id="borrowDetails" class="mt-4">
                            <!-- Borrow book details will be displayed here -->
                        </div>
                        <div>
                            <button type="button" onclick="openConfirmationDialog()" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Return Book</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </main>

    <!-- Footer at the Bottom -->
    <footer class="bg-blue-600 text-white p-4 mt-auto">
        <?php include 'include/footer.php'; ?>
    </footer>

    <!-- Success Pop-up -->
    <?php if ($successMessage): ?>
    <div id="successPopUp" class="hidden fixed inset-0 bg-green-200 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h3 class="text-lg font-semibold">Success</h3>
            <p class="mt-2 text-green-700"><?= $successMessage ?></p>
            <button onclick="closePopUp('successPopUp')" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md">Close</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Error Pop-up -->
    <?php if ($errorMessage): ?>
    <div id="errorPopUp" class="hidden fixed inset-0 bg-red-200 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h3 class="text-lg font-semibold">Error</h3>
            <p class="mt-2 text-red-700"><?= $errorMessage ?></p>
            <button onclick="closePopUp('errorPopUp')" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Confirmation Pop-up -->
    <div id="confirmationPopUp" class="hidden fixed inset-0 bg-gray-200 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-lg text-center">
            <h3 class="text-lg font-semibold">Confirm Book Return</h3>
            <p class="mt-2">Are you sure you want to return this book?</p>
            <div class="mt-4">
                <form method="POST" action="">
                    <input type="hidden" id="confirmID" name="ID">
                    <button type="submit" name="approve" value="1" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Approve</button>
                    <button type="button" onclick="closePopUp('confirmationPopUp')" class="ml-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Reject</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Function to fetch borrow book details based on the Borrow ID
        function fetchBorrowDetails() {
            var ID = document.getElementById("ID").value;

            if (ID.length >= 1) { // Only trigger search when ID length is at least 1
                $.ajax({
                    url: '',  // Request to the same page
                    type: 'GET',
                    data: { ID: ID, ajax: 'true' },
                    success: function(response) {
                        // Insert the fetched details into the 'borrowDetails' div
                        $('#borrowDetails').html(response);
                    },
                    error: function() {
                        $('#borrowDetails').html('<p class="text-red-500">Error fetching details.</p>');
                    }
                });
            } else {
                $('#borrowDetails').html('');  // Clear details when input is empty
            }
        }

        // Open confirmation dialog
        function openConfirmationDialog() {
            var ID = document.getElementById("ID").value;
            document.getElementById("confirmID").value = ID;
            document.getElementById("confirmationPopUp").style.display = 'flex';
        }

        // Close pop-up dialog
        function closePopUp(popUpId) {
            document.getElementById(popUpId).style.display = 'none';
        }
    </script>

</body>
</html>

<?php
// Close the database connection after the form submission
$conn->close();
?>
