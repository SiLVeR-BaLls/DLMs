<?php
// Initialize variables for messages
$message = ""; // Variable to store messages
$message_type = ""; // Variable to store message type (e.g. success, error)

// Default number of books per page
$default_limit = 10;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $default_limit;

// Check connection to the database
if ($conn->connect_error) {
    // If connection fails, set the error message and message type
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "danger"; // Danger type for error messages
} else {
    // Pagination setup
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
    $offset = ($page - 1) * $limit; // Calculate the offset

    // Modify SQL query to fetch book information along with copies data with pagination
    $sql = "SELECT 
                Book.B_title, 
                Book.author, 
                (SELECT GROUP_CONCAT(Co_Name SEPARATOR ', ') FROM CoAuthor WHERE B_title = Book.B_title) AS coauthors, 
                Book.LCCN, 
                Book.ISBN, 
                Book.ISSN, 
                Book.MT AS MaterialType, 
                Book.extent,
                COUNT(CASE WHEN Book_copies.status = 'Available' THEN 1 END) AS available_count, 
                COUNT(CASE WHEN Book_copies.status = 'Borrowed' THEN 1 END) AS borrowed_count,
                COUNT(Book_copies.ID) AS total_count
            FROM 
                Book 
            LEFT JOIN 
                Book_copies ON Book.B_title = Book_copies.B_title
            GROUP BY 
                Book.B_title, Book.author, Book.LCCN, Book.ISBN, Book.ISSN, Book.MT, Book.extent
            LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql); // Execute the query and get the result

    // Get the total number of rows (for pagination calculation)
    $count_sql = "SELECT COUNT(DISTINCT Book.B_title) AS total_books
                  FROM Book
                  LEFT JOIN Book_copies ON Book.B_title = Book_copies.B_title";
    $count_result = $conn->query($count_sql);
    $total_books = $count_result->fetch_assoc()['total_books'];

    // Calculate the total number of pages
    $total_pages = ceil($total_books / $limit);
}
?>
<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto px-4 py-6">

    <!-- Alert message for connection error or success -->
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?> mb-4 p-4 text-center bg-red-600 text-white rounded">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Search Controls -->
    <div class="mb-6 px-4 flex justify-center items-center">
        <!-- Search Type Selection and Search Input in One Line -->
        <div class="flex flex-row gap-4 items-center">
            <!-- Search Input -->
            <input type="text" id="searchInput" class="form-input block w-40 sm:w-60 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm" placeholder="Enter search term...">

            <!-- Search Type Selection -->
            <select id="searchType" class="form-select block w-40 sm:w-60 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm">
                <option value="all">All</option>
                <option value="title">Title</option>
                <option value="author">Author</option>
                <option value="coauthors">Co-authors</option>
                <option value="lccn">LCCN</option>
                <option value="isbn">ISBN</option>
                <option value="issn">ISSN</option>
                <option value="materialType">Material Type</option>
                <option value="extent">Extent</option>
            </select>
        </div>
    </div>

    <!-- Updated Responsive Books Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Author</th>
                    <th class="px-4 py-2">Co-authors</th>
                    <th class="px-4 py-2">LCCN</th>
                    <th class="px-4 py-2">ISBN</th>
                    <th class="px-4 py-2">ISSN</th>
                    <th class="px-4 py-2">Material Type</th>
                    <th class="px-4 py-2">Extent</th>
                    <th class="px-4 py-2">Copies</th>
                </tr>
            </thead>
            <tbody id="bookTableBody">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-y border-solid cursor-pointer hover:bg-gray-200" 
                            data-title="<?php echo htmlspecialchars($row['B_title']); ?>"
                            data-author="<?php echo htmlspecialchars($row['author']); ?>"
                            data-coauthors="<?php echo htmlspecialchars($row['coauthors']); ?>"
                            data-lccn="<?php echo htmlspecialchars($row['LCCN']); ?>"
                            data-isbn="<?php echo htmlspecialchars($row['ISBN']); ?>"
                            data-issn="<?php echo htmlspecialchars($row['ISSN']); ?>"
                            data-material-type="<?php echo htmlspecialchars($row['MaterialType']); ?>"
                            data-extent="<?php echo htmlspecialchars($row['extent']); ?>"
                            onclick="window.location.href='ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>';"
                            onmouseenter="showPopup(event, this)" onmouseleave="hidePopup()">
                            <td class="px-4 py-2 title"><?php echo htmlspecialchars($row['B_title']); ?></td>
                            <td class="px-4 py-2 author"><?php echo htmlspecialchars($row['author']); ?></td>
                            <td class="px-4 py-2 coauthors"><?php echo htmlspecialchars($row['coauthors']); ?></td>
                            <td class="px-4 py-2 lccn"><?php echo htmlspecialchars($row['LCCN']); ?></td>
                            <td class="px-4 py-2 isbn"><?php echo htmlspecialchars($row['ISBN']); ?></td>
                            <td class="px-4 py-2 issn"><?php echo htmlspecialchars($row['ISSN']); ?></td>
                            <td class="px-4 py-2 materialType"><?php echo htmlspecialchars($row['MaterialType']); ?></td>
                            <td class="px-4 py-2 extent"><?php echo htmlspecialchars($row['extent']); ?></td>
                            <td class="px-4 py-2">
                                <?php 
                                    // Display available copies out of total copies
                                    $available_count = $row['available_count'];
                                    $total_count = $row['total_count'];
                                    echo "$available_count/$total_count copies left";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-4">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Popup Container -->
    <div id="popup" class="hidden absolute bg-white p-4 border shadow-lg rounded-lg z-50"></div>

    <script>
        function showPopup(event, row) {
            var popup = document.getElementById('popup');
            var offsetX = event.clientX + 10; // Adjust the position of the popup relative to the mouse
            var offsetY = event.clientY + 10;

            popup.style.left = offsetX + 'px';
            popup.style.top = offsetY + 'px';
            popup.classList.remove('hidden');

            var title = row.getAttribute('data-title');
            var author = row.getAttribute('data-author');
            var coauthors = row.getAttribute('data-coauthors');
            var lccn = row.getAttribute('data-lccn');
            var isbn = row.getAttribute('data-isbn');
            var issn = row.getAttribute('data-issn');
            var materialType = row.getAttribute('data-material-type');
            var extent = row.getAttribute('data-extent');

            popup.innerHTML = `
                <strong>Title:</strong> ${title}<br>
                <strong>Author:</strong> ${author}<br>
                <strong>Co-authors:</strong> ${coauthors}<br>
                <strong>LCCN:</strong> ${lccn}<br>
                <strong>ISBN:</strong> ${isbn}<br>
                <strong>ISSN:</strong> ${issn}<br>
                <strong>Material Type:</strong> ${materialType}<br>
                <strong>Extent:</strong> ${extent}
            `;
        }

        function hidePopup() {
            document.getElementById('popup').classList.add('hidden');
        }
    </script>

    <!-- Pagination Controls -->
    <div class="mt-6 flex justify-center gap-4">
        <?php
        // Display pagination controls
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page=' . $i . '&limit=' . $limit . '" class="px-4 py-2 border border-blue-600 rounded-lg text-blue-600 hover:bg-blue-600 hover:text-white">' . $i . '</a>';
        }
        ?>
    </div>

</div>
</body>
