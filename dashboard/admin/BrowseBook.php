<?php
include '../config.php'; // Include the configuration file for database connection
include 'include/admin_connect.php'; // Include admin connection script

// Initialize variables for messages
$message = ""; // Variable to store messages
$message_type = ""; // Variable to store message type (e.g., success, error)

// Check connection to the database
if ($conn->connect_error) {
    // If connection fails, set the error message and message type
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "danger"; // Danger type for error messages
} else {
    // Fetch all books or records from the database
    $sql = "SELECT B_title, author, 
            (SELECT GROUP_CONCAT(Co_Name SEPARATOR ', ') FROM CoAuthor WHERE B_title = Book.B_title) AS coauthors, 
            LCCN, ISBN, ISSN, MT AS MaterialType, extent 
            FROM Book";
    $result = $conn->query($sql); // Execute the query and get the result
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books</title>
    <!-- Include Bootstrap CSS for styling -->
</head>
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
        <div class="col-md-8">
            <label for="searchInput">Search:</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Enter search term...">
        </div>
    </div>

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
                                <a href="include/ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No books or research found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery and Bootstrap Bundle (for Bootstrap components) -->
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
