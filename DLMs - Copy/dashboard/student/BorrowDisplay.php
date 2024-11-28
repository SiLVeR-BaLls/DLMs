<!-- borrowdisplay.php -->
<?php
include 'include/ReturnConnect.php';
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
                                            <th class='px-4 py-2 text-left text-gray-700'>ID</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Borrow ID</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Username</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>First Name</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Surname</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Book Title</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Author</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Borrow Date</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>College</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Course</th>
                                            <th class='px-4 py-2 text-left text-gray-700'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='bookTableBody'>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['ID']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['borrow_id']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['IDno']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['Fname']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['Sname']) . "</td>
                                    <td class='px-4 py-2 title'>" . htmlspecialchars($row['B_title']) . "</td>
                                    <td class='px-4 py-2 author'>" . htmlspecialchars($row['author']) . "</td>
                                    <td class='px-4 py-2'>" . htmlspecialchars($row['borrow_date']) . "</td>
                                    <td class='px-4 py-2 college'>" . htmlspecialchars($row['college']) . "</td>
                                    <td class='px-4 py-2 course'>" . htmlspecialchars($row['course']) . "</td>
                                    <td class='px-4 py-2'>
                                        <form action='BorrowDisplay.php' method='POST'>
                                             <input type='hidden' name='ID' id='ID' oninput='fetchBorrowDetails()' value='" . htmlspecialchars($row['ID']) . "'>
                                             <button type='button' onclick='openConfirmationDialog()' class='w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700'>Return Book</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                        echo "</tbody></table></div>";
                    } else {
                        echo "<div class='no-books-alert'>No borrowed books found.</div>";
                    }
                    ?>
                </div>
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
    <!-- JavaScript to filter the table based on search input and search type -->
    <script>
        $(document).ready(function() {
            // Event listener for input changes
            $('#searchInput').on('keyup', filterTable); // Trigger filter on keyup in search input
            $('#searchType').on('change', filterTable); // Trigger filter on change in search type

            function filterTable() {
                // Get selected search type
                const searchType = $('#searchType').val();          
                // Get the search text in lowercase for case-insensitive comparison
                const searchText = $('#searchInput').val().toLowerCase();  

                // Filter the table rows
                $('#bookTableBody tr').filter(function() {
                    // Get the text values of the current row
                    const rowTitle = $(this).find('.title').text().toLowerCase();
                    const rowAuthor = $(this).find('.author').text().toLowerCase();
                    const rowCollege = $(this).find('.college').text().toLowerCase();
                    const rowCourse = $(this).find('.course').text().toLowerCase();

                    // Initialize match variable
                    let matchSearchType = false;

                    // Matching based on search type
                    switch (searchType) {
                        case 'all':
                            matchSearchType = rowTitle.indexOf(searchText) > -1 || 
                                              rowAuthor.indexOf(searchText) > -1 || 
                                              rowCollege.indexOf(searchText) > -1 || 
                                              rowCourse.indexOf(searchText) > -1;
                            break;
                        case 'title':
                            matchSearchType = rowTitle.indexOf(searchText) > -1;
                            break;
                        case 'author':
                            matchSearchType = rowAuthor.indexOf(searchText) > -1;
                            break;
                        case 'borrower_name':
                            matchSearchType = rowTitle.indexOf(searchText) > -1 || 
                                              rowAuthor.indexOf(searchText) > -1;
                            break;
                        case 'college':
                            matchSearchType = rowCollege.indexOf(searchText) > -1;
                            break;
                        case 'course':
                            matchSearchType = rowCourse.indexOf(searchText) > -1;
                            break;
                    }

                    // Toggle row visibility based on match
                    $(this).toggle(matchSearchType);
                });
            }
        });


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