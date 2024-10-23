<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the query string
$title = $_GET['title'] ?? '';

if ($title) {
    // Fetch the book details
    $sql = "SELECT * FROM Book WHERE B_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            $message = "No book found with that title.";
            $message_type = "error";
        } else {
            $book = $result->fetch_assoc();
            
            // Fetch related data using a helper function
            function fetch_related_data($conn, $query, $title) {
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $title);
                $stmt->execute();
                return $stmt->get_result();
            }

            // Fetch related data
            $seriesResult = fetch_related_data($conn, "SELECT * FROM Series WHERE B_title = ?", $title);
            $subjectsResult = fetch_related_data($conn, "SELECT * FROM Subject WHERE B_title = ?", $title);
            $resourcesResult = fetch_related_data($conn, "SELECT * FROM Resource WHERE B_title = ?", $title);
            $alternateTitlesResult = fetch_related_data($conn, "SELECT * FROM AlternateTitle WHERE B_title = ?", $title);
            $coAuthorsResult = fetch_related_data($conn, "SELECT * FROM CoAuthor WHERE B_title = ?", $title);
        }
    } else {
        $message = "Error executing query: " . $stmt->error;
        $message_type = "error";
    }
    $stmt->close();
} else {
    $message = "No book title provided.";
    $message_type = "error";
}

// Handle form submission for updating book details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update book information
    $updatedTitle = $_POST['B_title'];
    $updatedSubtitle = $_POST['subtitle'];
    $updatedAuthor = $_POST['author'];
    $updatedEdition = $_POST['edition'];
    $updatedLCCN = $_POST['LCCN'];
    $updatedISBN = $_POST['ISBN'];
    $updatedISSN = $_POST['ISSN'];
    $updatedMT = $_POST['MT'];
    $updatedST = $_POST['ST'];
    $updatedPlace = $_POST['place'];
    $updatedPublisher = $_POST['publisher'];
    $updatedPdate = $_POST['Pdate'];
    $updatedCopyright = $_POST['copyright'];
    $updatedExtent = $_POST['extent'];
    $updatedOdetail = $_POST['Odetail'];
    $updatedSize = $_POST['size'];

    // Update the book in the database
    $updateSql = "UPDATE Book SET B_title=?, subtitle=?, author=?, edition=?, LCCN=?, ISBN=?, ISSN=?, MT=?, ST=?, place=?, publisher=?, Pdate=?, copyright=?, extent=?, Odetail=?, size=? WHERE B_title=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssssssssssssssss", $updatedTitle, $updatedSubtitle, $updatedAuthor, $updatedEdition, $updatedLCCN, $updatedISBN, $updatedISSN, $updatedMT, $updatedST, $updatedPlace, $updatedPublisher, $updatedPdate, $updatedCopyright, $updatedExtent, $updatedOdetail, $updatedSize, $title);
    
    if ($updateStmt->execute()) {
        $message = "Book updated successfully.";
        $message_type = "success";
        // Optionally redirect or refresh the page
    } else {
        $message = "Error updating book: " . $updateStmt->error;
        $message_type = "error";
    }
    $updateStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-card {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .book-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .table-custom th, .table-custom td {
            vertical-align: middle;
        }
        p {
            margin-bottom: 1rem;
            padding: 0.1rem;
        }
        .btn-group {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($book)): ?>
           <h4 class="book-title">Editing: <?php echo htmlspecialchars($book['B_title']); ?></h4>
            <a href="../index.php" class="btn btn-secondary">Back to Browse</a>
            <form method="POST" class="book-card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="B_title">Title:</label>
                            <input type="text" class="form-control" id="B_title" name="B_title" value="<?php echo htmlspecialchars($book['B_title']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="LCCN">LCCN:</label>
                            <input type="text" class="form-control" id="LCCN" name="LCCN" value="<?php echo htmlspecialchars($book['LCCN']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="ISBN">ISBN:</label>
                            <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo htmlspecialchars($book['ISBN']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="MT">Material Type:</label>
                            <input type="text" class="form-control" id="MT" name="MT" value="<?php echo htmlspecialchars($book['MT']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subtitle">Subtitle:</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo htmlspecialchars($book['subtitle']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition:</label>
                            <input type="text" class="form-control" id="edition" name="edition" value="<?php echo htmlspecialchars($book['edition']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="ISSN">ISSN:</label>
                            <input type="text" class="form-control" id="ISSN" name="ISSN" value="<?php echo htmlspecialchars($book['ISSN']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="ST">Subject Type:</label>
                            <input type="text" class="form-control" id="ST" name="ST" value="<?php echo htmlspecialchars($book['ST']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="place">Place:</label>
                            <input type="text" class="form-control" id="place" name="place" value="<?php echo htmlspecialchars($book['place']); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="publisher">Publisher:</label>
                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="Pdate">Publication Date:</label>
                            <input type="text" class="form-control" id="Pdate" name="Pdate" value="<?php echo htmlspecialchars($book['Pdate']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="copyright">Copyright:</label>
                            <input type="text" class="form-control" id="copyright" name="copyright" value="<?php echo htmlspecialchars($book['copyright']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="extent">Extent:</label>
                            <input type="text" class="form-control" id="extent" name="extent" value="<?php echo htmlspecialchars($book['extent']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="Odetail">Other Details:</label>
                            <input type="text" class="form-control" id="Odetail" name="Odetail" value="<?php echo htmlspecialchars($book['Odetail']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="size">Size:</label>
                            <input type="text" class="form-control" id="size" name="size" value="<?php echo htmlspecialchars($book['size']); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="../index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>

            <hr>

            <h5>Related Series</h5>
            <table class="table table-striped table-custom">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Volume</th>
                        <th>IL</th>
                        <th>Lexille</th>
                        <th>F_and_P</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($series = $seriesResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($series['title']); ?></td>
                            <td><?php echo htmlspecialchars($series['volume']); ?></td>
                            <td><?php echo htmlspecialchars($series['IL']); ?></td>
                            <td><?php echo htmlspecialchars($series['lexille']); ?></td>
                            <td><?php echo htmlspecialchars($series['F_and_P']); ?></td>
                            <td><?php echo htmlspecialchars($series['comments']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h5>Related Subjects</h5>
            <table class="table table-striped table-custom">
                <thead>
                    <tr>
                        <th>Sub Head</th>
                        <th>Sub Body 1</th>
                        <th>Sub Body 2</th>
                        <th>Sub Body 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($subject = $subjectsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['Sub_Head']); ?></td>
                            <td><?php echo htmlspecialchars($subject['Sub_Body_1']); ?></td>
                            <td><?php echo htmlspecialchars($subject['Sub_Body_2']); ?></td>
                            <td><?php echo htmlspecialchars($subject['Sub_Body_3']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h5>Related Resources</h5>
            <table class="table table-striped table-custom">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($resource = $resourcesResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($resource['B_title']); ?></td>
                            <td><?php echo htmlspecialchars($resource['url']); ?></td>
                            <td><?php echo htmlspecialchars($resource['Description']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h5>Related Alternate Titles</h5>
            <table class="table table-striped table-custom">
                <thead>
                    <tr>
                        <th>Alternate Title</th>
                        <th>Variant Form</th>
                        <th>Standard Alternate Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($altTitle = $alternateTitlesResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($altTitle['UTitle']); ?></td>
                            <td><?php echo htmlspecialchars($altTitle['VForm']); ?></td>
                            <td><?php echo htmlspecialchars($altTitle['SUTitle']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h5>Related Co-Authors</h5>
            <table class="table table-striped table-custom">
                <thead>
                    <tr>
                        <th>Co-Author Name</th>
                        <th>Co-Author Date</th>
                        <th>Co-Author Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($coAuthor = $coAuthorsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($coAuthor['Co_Name']); ?></td>
                            <td><?php echo htmlspecialchars($coAuthor['Co_Date']); ?></td>
                            <td><?php echo htmlspecialchars($coAuthor['Co_Role']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
