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
            $coAuthorsResult = fetch_related_data($conn, "SELECT * FROM CoAuthor WHERE B_title = ?", $title);
            $seriesResult = fetch_related_data($conn, "SELECT * FROM Series WHERE B_title = ?", $title);
            $subjectsResult = fetch_related_data($conn, "SELECT * FROM Subject WHERE B_title = ?", $title);
            $resourcesResult = fetch_related_data($conn, "SELECT * FROM Resource WHERE B_title = ?", $title);
            $alternateTitlesResult = fetch_related_data($conn, "SELECT * FROM AlternateTitle WHERE B_title = ?", $title);
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .book-card {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            display:flex;
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
    </style>
</head>
<body>
    <div class="body_contain">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
            <?php endif; ?>
            <!-- return button -->
            <a href="../index.php" class="btn btn-secondary"><</a>
            

            <!-- the title -->
        <?php if (isset($book)): ?>
           <h4 class="book-title"><?php echo htmlspecialchars($book['B_title']); ?></h4>
           <a href="edit_book.php?title=<?php echo urlencode($book['B_title']); ?>" class="btn btn-info">Edit</a>
           <a href="AddBookCopy.php?title=<?php echo urlencode($book['B_title']); ?>" class="btn btn-primary">Add Copy</a>
           <a href="BookList.php?title=<?php echo urlencode($book['B_title']); ?>" class="btn btn-primary">list</a>
           <div class="book-card">
                <div class="table table-custom">
                    <p><strong>Subtitle:</strong><br><?php echo htmlspecialchars($book['subtitle']); ?></p>
                    <p><strong>Author:</strong><br><?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Edition:</strong><br><?php echo htmlspecialchars($book['edition']); ?></p>
                </div>
                <div class="table table-custom">
                    <p><strong>LCCN:</strong><br><?php echo htmlspecialchars($book['LCCN']); ?></p>
                    <p><strong>ISBN:</strong><br><?php echo htmlspecialchars($book['ISBN']); ?></p>
                    <p><strong>ISSN:</strong><br><?php echo htmlspecialchars($book['ISSN']); ?></p>
                </div>
                <div class="table table-custom">
                    <p><strong>Material Type:</strong><br><?php echo htmlspecialchars($book['MT']); ?></p>
                    <p><strong>Subject Type:</strong><br><?php echo htmlspecialchars($book['ST']); ?></p>
                </div>
                <div class="table table-custom">
                    <p><strong>Place:</strong><br><?php echo htmlspecialchars($book['place']); ?></p>
                    <p><strong>Publisher:</strong><br><?php echo htmlspecialchars($book['publisher']); ?></p>
                    <p><strong>Publication Date:</strong><br><?php echo htmlspecialchars($book['Pdate']); ?></p>
                    <p><strong>Copyright:</strong><br><?php echo htmlspecialchars($book['copyright']); ?></p>
                </div>
                <div class="table table-custom">
                    <p><strong>Extent:</strong><br><?php echo htmlspecialchars($book['extent']); ?></p>
                    <p><strong>Other Details:</strong><br><?php echo htmlspecialchars($book['Odetail']); ?></p>
                    <p><strong>Size:</strong><br><?php echo htmlspecialchars($book['size']); ?></p>
                </div>
<!-- start here -->

            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>Co-authors</h5>
                    <div class="book-card">
                        <?php if ($coAuthorsResult->num_rows > 0): ?>
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $coAuthorsResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Co_Name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Co_Date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Co_Role']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No co-authors available.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>Series</h5>
                    <div class="book-card">
                        <?php if ($seriesResult->num_rows > 0): ?>
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Lexille</th>
                                        <th>Volume</th>
                                        <th>Interest Level</th>
                                        <th>Fountas and Pinnell</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $seriesResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['lexille']); ?></td>
                                            <td><?php echo htmlspecialchars($row['volume']); ?></td>
                                            <td><?php echo htmlspecialchars($row['IL']); ?></td>
                                            <td><?php echo htmlspecialchars($row['F_and_P']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No series information available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>Subjects</h5>
                    <div class="book-card">
                        <?php if ($subjectsResult->num_rows > 0): ?>
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Subject Head</th>
                                        <th>Body</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $subjectsResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Sub_Head']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Sub_Head_input']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Sub_Body_1']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Sub_input_1']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Sub_Body_2']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Sub_input_2']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Sub_Body_3']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Sub_input_3']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No subject information available.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>Resources</h5>
                    <div class="book-card">
                        <?php if ($resourcesResult->num_rows > 0): ?>
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $resourcesResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['Description']); ?></td>
                                            <td><a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank"><?php echo htmlspecialchars($row['url']); ?></a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No resource information available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5>Alternate Titles</h5>
                    <div class="book-card">
                        <?php if ($alternateTitlesResult->num_rows > 0): ?>
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Uniform Title</th>
                                        <th>Varying Form</th>
                                        <th>Series Uniform Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $alternateTitlesResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['UTitle']); ?></td>
                                            <td><?php echo htmlspecialchars($row['SUTitle']); ?></td>
                                            <td><?php echo htmlspecialchars($row['VForm']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No alternate titles available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
