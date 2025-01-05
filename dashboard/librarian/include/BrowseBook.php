<?php
// Initialize variables for messages
$message = ""; // Variable to store messages
$message_type = ""; // Variable to store message type (e.g. success, error)

// Default number of books per page
$default_limit = 10;
$limit = isset($_GET['limit']) ? $_GET['limit'] : $default_limit;

// If 'all' is selected, set limit to a very high number
if ($limit === 'all') {
    $limit = PHP_INT_MAX; // Display all books
} else {
    $limit = (int) $limit;
}

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
                (SELECT GROUP_CONCAT(Co_Name SEPARATOR ', ')
                 FROM CoAuthor WHERE B_title = Book.B_title) AS coauthors, 
                        Book.LCCN, 
                        Book.ISBN, 
                        Book.ISSN, Book.copyright, 
                        Book.MT, 
                        Book.extent,
                COUNT(CASE WHEN Book_copies.status = 'Available' THEN 1 END) AS available_count, 
                COUNT(CASE WHEN Book_copies.status = 'Borrowed' THEN 1 END) AS borrowed_count,
                COUNT(book_copies.book_copy_ID ) AS total_count
            FROM 
                Book 
            LEFT JOIN 
                Book_copies ON Book.B_title = Book_copies.B_title
            GROUP BY 
                Book.B_title, Book.author, Book.LCCN, Book.ISBN, Book.ISSN,Book.copyright, Book.MT, Book.extent
            LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql); // Execute the query and get the result

    // Get the total number of rows (for pagination calculation)
    $count_sql = "SELECT COUNT(DISTINCT Book.B_title) AS total_books
                  FROM Book
                  LEFT JOIN Book_copies ON Book.B_title = Book_copies.B_title";
    $count_result = $conn->query($count_sql);
    $total_books = $count_result->fetch_assoc()['total_books'];

    // Calculate the total number of pages
    $total_pages = ($limit === PHP_INT_MAX) ? 1 : ceil($total_books / $limit);
}
?>

<style>#popup {
    position: absolute;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    display: none;  /* Initially hidden */
    transition: opacity 0.2s ease;
    opacity: 0;
}

#popup.show {
    display: block;
    opacity: 1;
}

#popup.hidden {
    display: none;
    opacity: 0;
}

</style>


<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto px-4 py-6">

    <!-- Alert message for connection error or success -->
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?> mb-4 p-4 text-center bg-red-600 text-white rounded">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="mb-6 px-4 flex justify-between items-center">
    <!-- Centered Search Controls -->
    <div class="flex flex-row gap-4 items-center">
        <!-- Search Input -->
        <input type="text" id="searchInput" 
            class="form-input block w-40 sm:w-60 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm" 
            placeholder="Enter search term..."
            style="width: 70%;">

        <!-- Search Type Selection -->
        <select id="searchType" 
            class="form-select block px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm" 
            style="width: 30%;">
            <option value="all">All</option>
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="coauthors">Co-authors</option>
            <option value="lccn">LCCN</option>
            <option value="isbn">ISBN</option>
            <option value="issn">ISSN</option>
            <option value="MT">Material Type</option>
            <option value="extent">Extent</option>
        </select>
    </div>

    <!-- Books Per Page Dropdown (Aligned to the Right) -->
    <div class="flex items-center">
        <label for="limit" class="mr-2">Books per page:</label>
        <select id="limit" name="limit" 
            class="bg-gray-200 border border-gray-400 p-2 rounded" 
            onchange="window.location.href = '?page=1&limit=' + this.value;">
            <option value="5" <?php echo ($limit == 5) ? 'selected' : ''; ?>>5</option>
            <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10</option>
            <option value="15" <?php echo ($limit == 15) ? 'selected' : ''; ?>>15</option>
            <option value="20" <?php echo ($limit == 20) ? 'selected' : ''; ?>>20</option>
            <option value="all" <?php echo ($limit == 'all') ? 'selected' : ''; ?>>All</option>
        </select>
    </div>
</div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Author</th>
                    <th class="px-4 py-2">Co-authors</th>

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
                                data-material-type="<?php echo htmlspecialchars($row['MT']); ?>"
                                data-extent="<?php echo htmlspecialchars($row['extent']); ?>"
                                data-available-count="<?php echo $row['available_count']; ?>"
                                data-total-count="<?php echo $row['total_count']; ?>"
                                data-copyright="<?php echo htmlspecialchars($row['copyright']); ?>"
                                onclick="window.location.href='ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>';"
                                onmouseenter="showPopup(event, this)" onmouseleave="hidePopup()">

                            
                            <td class="px-4 py-2 title"><?php echo htmlspecialchars($row['B_title']); ?></td>
                            <td class="px-4 py-2 author"><?php echo htmlspecialchars($row['author']); ?></td>
                            <td class="px-4 py-2 coauthors"><?php echo htmlspecialchars($row['coauthors']); ?></td>

                            <td class="px-4 py-2 MT"><?php echo htmlspecialchars($row['MT']); ?></td>
                            <td class="px-4 py-2 extent"><?php echo htmlspecialchars($row['extent']); ?></td>
                            <td class="px-4 py-2 flex justify-center gap-2">
                                <?php if ($row['available_count'] > 0): ?>
                                    <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                                        ✔
                                    </div>
                                <?php else: ?>
                                    <div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center">
                                        ✖
                                    </div>
                                <?php endif; ?>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

 
<div class="mt-6 flex justify-between items-center space-x-2">
    <!-- Pagination Controls -->
    <div class="flex justify-center w-full space-x-2">
        <!-- Page Number Controls -->
        <div class="flex justify-center items-center">
            <!-- First Page Button -->
            <button class="text-blue-600 px-4 py-2 bg-white border rounded-lg hover:bg-blue-600 hover:text-white"
                    <?php echo ($page <= 1) ? 'disabled' : ''; ?>
                    onclick="window.location.href='?page=1&limit=<?php echo $limit; ?>'">
                &laquo;
            </button>
            <!-- Previous Page Button -->
            <button class="text-blue-600 px-4 py-2 bg-white border rounded-lg hover:bg-blue-600 hover:text-white"
                    <?php echo ($page <= 1) ? 'disabled' : ''; ?>
                    onclick="window.location.href='?page=<?php echo max($page - 1, 1); ?>&limit=<?php echo $limit; ?>'">
                &lt;
            </button>
            <!-- Current Page Number -->
            <span class="mx-4">Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
            <!-- Next Page Button -->
            <button class="text-blue-600 px-4 py-2 bg-white border rounded-lg hover:bg-blue-600 hover:text-white"
                    <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>
                    onclick="window.location.href='?page=<?php echo min($page + 1, $total_pages); ?>&limit=<?php echo $limit; ?>'">
                &gt;
            </button>
            <!-- Last Page Button -->
            <button class="text-blue-600 px-4 py-2 bg-white border rounded-lg hover:bg-blue-600 hover:text-white"
                    <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>
                    onclick="window.location.href='?page=<?php echo $total_pages; ?>&limit=<?php echo $limit; ?>'">
                &raquo;
            </button>
        </div>
    </div>

    <!-- Books per page control (right side) -->
    <div class="flex items-center">
        <label for="limit" class="mr-2">Books per page:</label>
        <select id="limit" name="limit" class="bg-gray-200 border border-gray-400 p-2 rounded" onchange="window.location.href = '?page=1&limit=' + this.value;">
            <option value="5" <?php echo ($limit == 5) ? 'selected' : ''; ?>>5</option>
            <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10</option>
            <option value="15" <?php echo ($limit == 15) ? 'selected' : ''; ?>>15</option>
            <option value="20" <?php echo ($limit == 20) ? 'selected' : ''; ?>>20</option>
            <option value="all" <?php echo ($limit == 'all') ? 'selected' : ''; ?>>All</option>
        </select>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
                const rowCoAuthors = $(this).find('.coauthors').text().toLowerCase();
                const rowLCCN = $(this).find('.lccn').text().toLowerCase();
                const rowISBN = $(this).find('.isbn').text().toLowerCase();
                const rowISSN = $(this).find('.issn').text().toLowerCase();
                const rowMT = $(this).find('.MT').text().toLowerCase();
                const rowExtent = $(this).find('.extent').text().toLowerCase();

                // Initialize match variable
                let matchSearchType = false;

                // Matching based on search type
                switch (searchType) {
                    case 'all':
                        matchSearchType = rowTitle.indexOf(searchText) > -1 || 
                                          rowAuthor.indexOf(searchText) > -1 || 
                                          rowCoAuthors.indexOf(searchText) > -1 || 
                                          rowLCCN.indexOf(searchText) > -1 || 
                                          rowISBN.indexOf(searchText) > -1 || 
                                          rowISSN.indexOf(searchText) > -1 || 
                                          rowMT.indexOf(searchText) > -1 || 
                                          rowExtent.indexOf(searchText) > -1;
                        break;
                    case 'title':
                        matchSearchType = rowTitle.indexOf(searchText) > -1;
                        break;
                    case 'author':
                        matchSearchType = rowAuthor.indexOf(searchText) > -1;
                        break;
                    case 'coauthors':
                        matchSearchType = rowCoAuthors.indexOf(searchText) > -1;
                        break;
                    case 'lccn':
                        matchSearchType = rowLCCN.indexOf(searchText) > -1;
                        break;
                    case 'isbn':
                        matchSearchType = rowISBN.indexOf(searchText) > -1;
                        break;
                    case 'issn':
                        matchSearchType = rowISSN.indexOf(searchText) > -1;
                        break;
                    case 'MT':
                        matchSearchType = rowMT.indexOf(searchText) > -1;
                        break;
                    case 'extent':
                        matchSearchType = rowExtent.indexOf(searchText) > -1;
                        break;
                }

                // Toggle row visibility based on match
                $(this).toggle(matchSearchType);
            });
        }
    });
</script>

<script>
    let popupTimeout;

    function showPopup(event, row) {
    clearTimeout(popupTimeout);

    popupTimeout = setTimeout(function() {
        var popup = document.getElementById('popup');

        // Retrieve data from row attributes
        var title = row.getAttribute('data-title');
        var author = row.getAttribute('data-author');
        var coauthors = row.getAttribute('data-coauthors');
        var lccn = row.getAttribute('data-lccn');
        var isbn = row.getAttribute('data-isbn');
        var issn = row.getAttribute('data-issn');
        var materialType = row.getAttribute('data-material-type');
        var extent = row.getAttribute('data-extent');
        var copyright = row.getAttribute('data-copyright');
        var availableCount = row.getAttribute('data-available-count');
        var totalCount = row.getAttribute('data-total-count');

        // Populate popup content with the available and total counts
        popup.innerHTML = `
            <strong>Title:</strong> ${title}<br>
            <strong>Author:</strong> ${author}<br>
            <strong>Co-authors:</strong> ${coauthors || 'N/A'}<br>
            <strong>LCCN:</strong> ${lccn || 'N/A'}-
            <strong>ISBN:</strong> ${isbn || 'N/A'}-
            <strong>ISSN:</strong> ${issn || 'N/A'}<br>
            <strong>Material Type:</strong> ${materialType || 'N/A'}<br>
            <strong>Extent:</strong> ${extent || 'N/A'}<br>
            <strong>Copyright:</strong> ${copyright || 'N/A'}<br>
            <strong>Available/Total:</strong>  ${availableCount}/${totalCount}
        `;

        // Position the popup near the mouse cursor
        popup.style.left = (event.pageX + 15) + 'px';
        popup.style.top = (event.pageY + 15) + 'px';

        // Show the popup
        popup.classList.remove('hidden');
        popup.classList.add('show');
    }, 500);  // 500ms delay
}


    function hidePopup() {
        var popup = document.getElementById('popup');
        popup.classList.remove('show');
        popup.classList.add('hidden');
        clearTimeout(popupTimeout);
    }
</script>

</body>
