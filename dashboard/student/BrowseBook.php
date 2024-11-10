<?php

// Initialize variables for messages
$message = ""; // Variable to store messages
$message_type = ""; // Variable to store message type (e.g., success, error)

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
<style>
    
</style>
<body>
<div class="container">
    <!-- Alert message for connection error or success -->
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>" role="alert"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <h2 class="text-center mb-4">Browse Books</h2>
    
    <!-- Search Controls -->
    <div class="row mb-3">
        <!-- Search Type Selection -->
        <div class="col-md-4">
            <label for="searchType">Search By:</label>
            <select id="searchType" class="form-control">
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

        <!-- Search Input -->
        <div class="col-md-4">
            <label for="searchInput">Search:</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Enter search term...">
        </div>
        
        
    </div>
 

    <!-- Books per Page Selector -->

    <!-- Responsive Books Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Co-authors</th>
                    <th>LCCN</th>
                    <th>ISBN</th>
                    <th>ISSN</th>
                    <th>Material Type</th>
                    <th>Extent</th>
                    <th>Copies (Available/Borrowed)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookTableBody">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="title"><?php echo htmlspecialchars($row['B_title']); ?></td>
                            <td class="author"><?php echo htmlspecialchars($row['author']); ?></td>
                            <td class="coauthors"><?php echo htmlspecialchars($row['coauthors']); ?></td>
                            <td><?php echo htmlspecialchars($row['LCCN']); ?></td>
                            <td><?php echo htmlspecialchars($row['ISBN']); ?></td>
                            <td><?php echo htmlspecialchars($row['ISSN']); ?></td>
                            <td class="material-type"><?php echo htmlspecialchars($row['MaterialType']); ?></td>
                            <td><?php echo htmlspecialchars($row['extent']); ?></td>
                            <td>
                                <?php echo $row['available_count']; ?> / <?php echo $row['total_count']; ?> <!-- Show available / total copies -->
                            </td>
                            <td>
                                <a href="include/ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No books or research found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<style>/* Pagination Styling */
/* Pagination styling */
.pagination {
    display: flex;
    justify-content: center;
    list-style: none; /* Remove default list markers */
    padding-left: 0; /* Remove left padding */
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-link {
    padding: 10px 15px;
    font-size: 16px;
    border: 1px solid #666;
    border-radius: 8px;
    color: #ddd;
    background-color: #444;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
}

.pagination .page-link:hover {
    background-color: #555;
    color: #fff;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
}

.pagination .page-item.disabled .page-link {
    color: #777;
    background-color: #444;
    border-color: #666;
    pointer-events: none;
}

.pagination .page-item.active .page-link {
    background-color: #555;
    border-color: #888;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
}

/* Active page item hover */
.pagination .page-item.active .page-link:hover {
    background-color: #666;
    border-color: #888;
    color: #fff;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}

/* Pagination container holding both pagination and books per page */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

/* Books per Page dropdown aligned to the right */
.books-per-page-container {
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.books-per-page-container label {
    margin-right: 10px;
    color: #ddd;
}

.books-per-page-container .form-control {
    width: 5vw;
    background-color: #555;
    border-color: #888;
    color: #fff;
    transition: box-shadow 0.3s ease;
}

.books-per-page-container .form-control:focus {
    background-color: #555;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
}

/* Styling for dropdown options */
.books-per-page-container .form-control option {
    background-color: #555;
    color: #fff;
}

/* Dropdown option hover */
.books-per-page-container .form-control option:hover {
    background-color: #666;
}

/* Smaller pagination size */
.pagination-sm .page-link {
    padding: 5px 10px;
    font-size: 14px;
}

</style>
    <!-- Pagination -->
<div class="pagination-container">
    <!-- Pagination links in the center -->
    <div class="pagination">
        <?php if ($total_pages > 1): ?>
            <ul class="pagination justify-content-center">
                <!-- Previous Page Link -->
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>">Previous</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                <?php endif; ?>

                <!-- Page Number Links -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Next Page Link -->
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>">Next</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Books per Page dropdown to the right -->
    <div class="books-per-page-container">
        <select id="booksPerPage" class="form-control" onchange="updateBooksPerPage()">
            <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10</option>
            <option value="20" <?php echo ($limit == 20) ? 'selected' : ''; ?>>20</option>
            <option value="50" <?php echo ($limit == 50) ? 'selected' : ''; ?>>50</option>
            <option value="100" <?php echo ($limit == 100) ? 'selected' : ''; ?>>100</option>
        </select>
    </div>
</div>


</div>

<!-- Include jQuery and Bootstrap Bundle (for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to filter the table based on search input and search type -->
<script>
    function updateBooksPerPage() {
        var limit = document.getElementById('booksPerPage').value;
        var url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Update the URL with the selected limit
        window.location.href = url; // Reload the page with new limit
    }

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
                const rowLCCN = $(this).find('td:nth-child(4)').text().toLowerCase();
                const rowISBN = $(this).find('td:nth-child(5)').text().toLowerCase();
                const rowISSN = $(this).find('td:nth-child(6)').text().toLowerCase();
                const rowMaterialType = $(this).find('.material-type').text().toLowerCase();
                const rowExtent = $(this).find('td:nth-child(8)').text().toLowerCase();

                // Initialize match variable
                let matchSearchType = false; // To track if the row matches the search type

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
                        matchSearchType = rowTitle.indexOf(searchText) > -1; // Match title
                        break;
                    case 'author':
                        matchSearchType = rowAuthor.indexOf(searchText) > -1; // Match author
                        break;
                    case 'coauthors':
                        matchSearchType = rowCoAuthors.indexOf(searchText) > -1; // Match co-authors
                        break;
                    case 'lccn':
                        matchSearchType = rowLCCN.indexOf(searchText) > -1; // Match LCCN
                        break;
                    case 'isbn':
                        matchSearchType = rowISBN.indexOf(searchText) > -1; // Match ISBN
                        break;
                    case 'issn':
                        matchSearchType = rowISSN.indexOf(searchText) > -1; // Match ISSN
                        break;
                    case 'materialType':
                        matchSearchType = rowMaterialType.indexOf(searchText) > -1; // Match Material Type
                        break;
                    case 'extent':
                        matchSearchType = rowExtent.indexOf(searchText) > -1; // Match Extent
                        break;
                }

                // Toggle row visibility based on match
                $(this).toggle(matchSearchType);
            });
        }
    });
</script>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
