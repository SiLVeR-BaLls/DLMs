<?php
include '../config.php'; // Include the config file

// Initialize variables for error/success messages
$successMessage = '';
$errorMessage = '';

// Check if form is submitted via POST (non-AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approve'])) {
    // Get the Borrow ID and rating from the form
    $ID = $_POST["ID"];
    $rating = $_POST["rating"];

    // Handle the approval and book return process
    if (!empty($ID)) {
        // Check if the Borrow ID exists in the database
        $checkID = $conn->prepare("SELECT ID FROM borrow_book WHERE ID = ? AND return_date IS NULL");
        $checkID->bind_param("i", $ID);
        $checkID->execute();
        $checkID->store_result();

        if ($checkID->num_rows > 0) { // ID exists and book is still borrowed
            // Start transaction to ensure atomicity
            $conn->begin_transaction();

            // Update the rating in the book_copies table
            $updateRating = $conn->prepare("UPDATE book_copies SET rating = ? WHERE ID = ?");
            $updateRating->bind_param("ii", $rating, $ID);
            $updateRating->execute();

            // Update the return date for the borrowed book entry
            $stmt = $conn->prepare("UPDATE borrow_book SET return_date = NOW() WHERE ID = ?");
            $stmt->bind_param("i", $ID);
            $stmt->execute();

            // Update the book's status to 'Available'
            $updateBook = $conn->prepare("UPDATE book_copies SET status = 'Available' WHERE ID = ?");
            $updateBook->bind_param("i", $ID);
            $updateBook->execute();

            // Commit transaction if everything is successful
            $conn->commit();

            // Set success message
            $successMessage = "Book returned successfully and rating updated!";
        } else {
            // Handle invalid Borrow ID or already returned books
            $errorMessage = "Invalid Borrow ID or book already returned.";
        }
    } else {
        $errorMessage = "Borrow ID is missing.";
    }
}

// Fetch search term and filter type from GET request (if any)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchBy = isset($_GET['search_by']) ? $_GET['search_by'] : 'all'; // Default to 'all' if not set

// Start SQL query to fetch borrowed books
$query = "SELECT 
    bb.ID, 
    bb.borrow_id, 
    bb.borrow_date,
    ui.IDno, 
    ui.Fname, 
    ui.Sname, 
    bc.B_title, 
    b.author,
    bb.due_date,
    ud.college,  
    ud.course, 
    bc.rating
FROM borrow_book AS bb
JOIN users_info AS ui ON bb.IDno = ui.IDno
JOIN user_details AS ud ON bb.IDno = ud.IDno
JOIN book_copies AS bc ON bb.ID = bc.ID
JOIN book AS b ON bc.B_title = b.B_title
WHERE bb.return_date IS NULL";

// Add search conditions based on selected search type and search term
if ($searchTerm != '') {
    $searchTerm = '%' . $searchTerm . '%'; // Add wildcard for SQL LIKE
    switch ($searchBy) {
        case 'title':
            $query .= " AND bc.B_title LIKE '$searchTerm'";
            break;
        case 'author':
            $query .= " AND b.author LIKE '$searchTerm'";
            break;
        case 'borrower_name':
            $query .= " AND (ui.Fname LIKE '$searchTerm' OR ui.Sname LIKE '$searchTerm')";
            break;
        case 'college':
            $query .= " AND ud.college LIKE '$searchTerm'"; 
            break;
        case 'course':
            $query .= " AND ud.course LIKE '$searchTerm'"; 
            break;
        case 'all':
        default:
            $query .= " AND (bc.B_title LIKE '$searchTerm' OR b.author LIKE '$searchTerm' OR ui.Fname LIKE '$searchTerm' OR ui.Sname LIKE '$searchTerm' OR ud.college LIKE '$searchTerm' OR ud.course LIKE '$searchTerm')";
            break;
    }
}

// Execute the query
$result = $conn->query($query); // Execute the query

// Check for query error
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Function to calculate if the book is overdue
function calculateOverdue($due_date) {
    // Get the current date and time
    $currentDate = new DateTime();
    
    // Convert the due date to a DateTime object
    $dueDate = new DateTime($due_date);

    // Compare the due date with the current date
    if ($dueDate < $currentDate) {
        return 'Overdue';
    } else {
        return 'On time';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Borrowed Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <?php include 'include/header.php'; ?>

    <main class="flex flex-col md:flex-row">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Main Content Section -->
        <div class="flex-grow p-4">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-6">Borrowed Books</h2>

                <!-- Search Input and Type Selector -->
                <div class="flex space-x-4 mb-4">
                    <input type="text" id="searchInput" class="px-4 py-2 border rounded-md" placeholder="Search books..." value="<?= htmlspecialchars($searchTerm) ?>">
                    <select id="searchType" class="px-4 py-2 border rounded-md">
                        <option value="all" <?= $searchBy == 'all' ? 'selected' : '' ?>>All</option>
                        <option value="title" <?= $searchBy == 'title' ? 'selected' : '' ?>>Title</option>
                        <option value="author" <?= $searchBy == 'author' ? 'selected' : '' ?>>Author</option>
                        <option value="borrower_name" <?= $searchBy == 'borrower_name' ? 'selected' : '' ?>>Borrower's Name</option>
                        <option value="college" <?= $searchBy == 'college' ? 'selected' : '' ?>>College</option>
                        <option value="course" <?= $searchBy == 'course' ? 'selected' : '' ?>>Course</option>
                    </select>
                </div>

                <!-- Table Container -->
                <div id="booksTableContainer">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        echo "<div class='overflow-x-auto bg-white rounded-lg shadow-md'>
                                <table class='min-w-full table-auto'>
                                    <thead class='bg-gray-800 text-white'>
                                        <tr>
                                            <th class='px-4 py-2 text-left text-gray-700'>Book ID</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Username</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>First Name</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Book Title</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Borrow Date</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Due Date</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id='bookTableBody'>";
                        while ($row = $result->fetch_assoc()) {
                            $overdueStatus = calculateOverdue($row['due_date']);
                            echo "<tr class='cursor-pointer' data-id='" . $row['ID'] . "' data-rating='" . $row['rating'] . "'>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['ID']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['IDno']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['Fname']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['B_title']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['borrow_date']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['due_date']) . "</td>
                                    <td class='px-4 py-2'>" . $overdueStatus . "</td>
                                  </tr>";
                        }
                        echo "</tbody></table></div>";
                    } else {
                        echo "<p>No records found</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Admin Modal -->
    <div id="adminModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h3 class="text-xl font-semibold mb-4 text-center">Admin Approval</h3>
            <form action="" method="POST" id="approvalForm">
                <input type="hidden" name="ID" id="borrowId">
                <div class="mb-4">
                    <p><strong>Borrow ID:</strong> <span id="borrowIdDisplay" class="font-medium text-gray-700"></span></p>
                    <p><strong>Book Title:</strong> <span id="bookTitle" class="font-medium text-gray-700"></span></p>
                    <p><strong>Author:</strong> <span id="author" class="font-medium text-gray-700"></span></p>
                    <p><strong>Publisher:</strong> <span id="publisher" class="font-medium text-gray-700"></span></p>
                    <p><strong>Borrow Date:</strong> <span id="borrowDate" class="font-medium text-gray-700"></span></p>
                    <p><strong>Rating:</strong>
                        <input type="number" id="rating" name="rating" min="0" max="5" class="w-20 p-2 mt-2 border border-gray-300 rounded-md" value="">
                    </p>
                </div>
                <div class="flex justify-between">
                    <button type="button" id="noBtn" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Cancel</button>
                    <button type="submit" name="approve" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Approve</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Handle click event on the rows to open the modal
        document.querySelectorAll('tr.cursor-pointer').forEach(row => {
            row.addEventListener('click', function () {
                var borrowId = this.dataset.id;
                var bookTitle = this.cells[3].innerText;
                var author = this.cells[2].innerText;
                var publisher = this.cells[3].innerText;
                var borrowDate = this.cells[4].innerText;
                var rating = this.dataset.rating;

                document.getElementById('borrowId').value = borrowId;
                document.getElementById('borrowIdDisplay').innerText = borrowId;
                document.getElementById('bookTitle').innerText = bookTitle;
                document.getElementById('author').innerText = author;
                document.getElementById('publisher').innerText = publisher;
                document.getElementById('borrowDate').innerText = borrowDate;
                document.getElementById('rating').value = rating; // Set the rating value

                document.getElementById('adminModal').classList.remove('hidden');
            });
        });

        // Handle clicking the 'No' button to close the modal
        document.getElementById('noBtn').addEventListener('click', function () {
            document.getElementById('adminModal').classList.add('hidden');
        });

        // Close the modal if clicked outside of the modal content
        document.getElementById('adminModal').addEventListener('click', function (event) {
            if (event.target === this) {
                document.getElementById('adminModal').classList.add('hidden');
            }
        });

        // Handle search input and change events
        document.getElementById('searchInput').addEventListener('input', function() {
            let searchTerm = this.value;
            let searchBy = document.getElementById('searchType').value;
            window.location.href = `?search=${encodeURIComponent(searchTerm)}&search_by=${searchBy}`;
        });

        document.getElementById('searchType').addEventListener('change', function() {
            let searchTerm = document.getElementById('searchInput').value;
            let searchBy = this.value;
            window.location.href = `?search=${encodeURIComponent(searchTerm)}&search_by=${searchBy}`;
        });
    </script>

</body>
</html>
