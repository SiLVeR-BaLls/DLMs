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
    <!-- Search Controls --><div class="mb-6 px-4 flex justify-center items-center">
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


    <!-- Responsive Books Table -->
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
                    <th class="px-4 py-2">Copies (Available/Borrowed)</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody id="bookTableBody">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                        // Calculate percentage of available copies
                        $available_percentage = ($row['total_count'] > 0) ? ($row['available_count'] / $row['total_count']) * 100 : 0;
                        // Determine background color based on percentage
                        if ($available_percentage >= 50) {
                            $bg_class = 'bg-green-500';
                        } elseif ($available_percentage > 0) {
                            $bg_class = 'bg-yellow-500';
                        } else {
                            $bg_class = 'bg-red-500';
                        }
                        ?>
                        <tr class="<?php echo $bg_class; ?> text-white">
                            <td class="px-4 py-2 title"><?php echo htmlspecialchars($row['B_title']); ?></td>
                            <td class="px-4 py-2 author"><?php echo htmlspecialchars($row['author']); ?></td>
                            <td class="px-4 py-2 coauthors"><?php echo htmlspecialchars($row['coauthors']); ?></td>
                            <td class="px-4 py-2 lccn"><?php echo htmlspecialchars($row['LCCN']); ?></td>
                            <td class="px-4 py-2 isbn"><?php echo htmlspecialchars($row['ISBN']); ?></td>
                            <td class="px-4 py-2 issn"><?php echo htmlspecialchars($row['ISSN']); ?></td>
                            <td class="px-4 py-2 materialType"><?php echo htmlspecialchars($row['MaterialType']); ?></td>
                            <td class="px-4 py-2 extent"><?php echo htmlspecialchars($row['extent']); ?></td>
                            <td class="px-4 py-2">
                                <?php echo $row['available_count']; ?> / <?php echo $row['total_count']; ?>
                            </td>
                            <td class="px-4 py-2">
                                <a href="ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>" class="inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center py-4">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination and Books per Page Controls -->
    <div class="mt-6 flex justify-between items-center space-x-2">
        <div class="flex justify-center w-full space-x-2">
            <?php if ($page > 1): ?>
                <a href="?page=1&limit=<?php echo $limit; ?>" class="px-4 py-2 bg-gray-800 text-white rounded">
                    << First
                </a>
                <a href="?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>" class="px-4 py-2 bg-gray-800 text-white rounded">
                    < Previous
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>" class="px-4 py-2 <?php echo ($i == $page) ? 'bg-gray-800 text-white font-bold' : 'bg-gray-400 text-gray-800'; ?> rounded">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Next >
                </a>
                <a href="?page=<?php echo $total_pages; ?>&limit=<?php echo $limit; ?>" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Last >>
                </a>
            <?php endif; ?>
        </div>

        <!-- Books per page control (right side) -->
        <div class="flex items-center">
            <label for="limit" class="mr-2">Books per page:</label>
            <select id="limit" name="limit" class="bg-gray-200 border border-gray-400 p-2 rounded" onchange="window.location.href = '?page=1&limit=' + this.value;">
                <option value="5" <?php echo ($limit == 5) ? 'selected' : ''; ?>>5</option>
                <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10</option>
                <option value="15" <?php echo ($limit == 15) ? 'selected' : ''; ?>>15</option>
                <option value="20" <?php echo ($limit == 20) ? 'selected' : ''; ?>>20</option>
            </select>
        </div>
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
                const rowMaterialType = $(this).find('.materialType').text().toLowerCase();
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
                                          rowMaterialType.indexOf(searchText) > -1 || 
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
                    case 'materialType':
                        matchSearchType = rowMaterialType.indexOf(searchText) > -1;
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
</body>
