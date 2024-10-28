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

            // Initialize $series with default values if no data is returned
            $series = $seriesResult->fetch_assoc() ?? ['volume' => '', 'IL' => '', 'lexille' => '', 'F_and_P' => ''];
       
            // Initialize $subject with default values if no data is returned
            $subject = $subjectsResult->fetch_assoc() ?? ['Sub_Head' => '', 'Sub_Head_input' => '', 'Sub_Body_1' => '', 'Sub_Input_1' => '', 'Sub_Body_2' => '', 'Sub_Input_2' => '', 'Sub_Body_3' => '', 'Sub_Input_3' => ''];
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
    $updatedVolume = $_POST['volume'];
    $updatedIL = $_POST['IL'];
    $updatedLexile = $_POST['lexille'];
    $updatedF_and_P = $_POST['F_and_P'];

    $updatedSub_Head = $_POST['Sub_Head'];
    $updatedSub_Head_input = $_POST['Sub_Head_input'];
    $updatedSub_Body_1 = $_POST['Sub_Body_1'];
    $updatedSub_input_1 = $_POST['Sub_input_1'];
    $updatedSub_Body_2 = $_POST['Sub_Body_2'];
    $updatedSub_input_2 = $_POST['Sub_input_2'];
    $updatedSub_Body_3 = $_POST['Sub_Body_3'];
    $updatedSub_input_3 = $_POST['Sub_input_3'];
    


    // Update the book in the database
    $updateSql = "UPDATE Book SET subtitle=?, author=?, edition=?, LCCN=?, ISBN=?, ISSN=?, MT=?, ST=?, place=?, publisher=?, Pdate=?, copyright=?, extent=?, Odetail=?, size=? WHERE B_title=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssssssssssss", $updatedSubtitle, $updatedAuthor, $updatedEdition, $updatedLCCN, $updatedISBN, $updatedISSN, $updatedMT, $updatedST, $updatedPlace, $updatedPublisher, $updatedPdate, $updatedCopyright, $updatedExtent, $updatedOdetail, $updatedSize, $title);

    // Update the series in the database
    $updateSeriesSql = "UPDATE Series SET volume=?, IL=?, lexille=?, F_and_P=? WHERE B_title=?";
    $updateSeriesStmt = $conn->prepare($updateSeriesSql);
    $updateSeriesStmt->bind_param("sssss", $updatedVolume, $updatedIL, $updatedLexile, $updatedF_and_P, $title);

    
    $updateSubjectSql = "UPDATE Subject SET Sub_Head=? WHERE B_title=?";
    $updateSubjectStmt = $conn->prepare($updateSubjectSql);
    $updateSubjectStmt->bind_param("ss", $updatedSubHead, $title);


    if ($updateStmt->execute() && $updateSeriesStmt->execute()) {
        // Redirect after a successful update
        header("Location: ../index.php?message=success&title=" . urlencode($title));
        exit();
    } else {
        $message = "Error updating book: " . $updateStmt->error;
        $message_type = "error";
    }
    $updateStmt->close();
    $updateSeriesStmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-card {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 20px;
        }


        .book-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .form-section {
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="body_contain">
        <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>

        <?php if (isset($book)): ?>
        <h4 class="book-title">Editing:
            <?php echo htmlspecialchars($book['B_title']); ?>
        </h4>
        <button onclick="history.back();" class="btn btn-secondary mb-3">Back to Browse</button>
        <form method="POST" class="book-card">
            <div class="row">
                <div class="col-md-4 form-section">
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" id="author" name="author"
                            value="<?php echo htmlspecialchars($book['author']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="LCCN">LCCN:</label>
                        <input type="text" class="form-control" id="LCCN" name="LCCN"
                            value="<?php echo htmlspecialchars($book['LCCN']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ISBN">ISBN:</label>
                        <input type="text" class="form-control" id="ISBN" name="ISBN"
                            value="<?php echo htmlspecialchars($book['ISBN']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ISSN">ISSN:</label>
                        <input type="text" class="form-control" id="ISSN" name="ISSN"
                            value="<?php echo htmlspecialchars($book['ISSN']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                            value="<?php echo htmlspecialchars($book['subtitle']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="edition">Edition:</label>
                        <input type="text" class="form-control" id="edition" name="edition"
                            value="<?php echo htmlspecialchars($book['edition']); ?>">
                    </div>
                </div>

                <div class="col-md-4 form-section">
                    <div class="form-group">
                        <label for="MT">Material Type:</label>
                        <input type="text" class="form-control" id="MT" name="MT"
                            value="<?php echo htmlspecialchars($book['MT']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ST">Subject Type:</label>
                        <input type="text" class="form-control" id="ST" name="ST"
                            value="<?php echo htmlspecialchars($book['ST']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="extent">Extent:</label>
                        <input type="text" class="form-control" id="extent" name="extent"
                            value="<?php echo htmlspecialchars($book['extent']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="Odetail">Other Details:</label>
                        <input type="text" class="form-control" id="Odetail" name="Odetail"
                            value="<?php echo htmlspecialchars($book['Odetail']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" id="size" name="size"
                            value="<?php echo htmlspecialchars($book['size']); ?>">
                    </div>
                </div>

                <div class="col-md-4 form-section">
                    <div class="form-group">
                        <label for="place">Place:</label>
                        <input type="text" class="form-control" id="place" name="place"
                            value="<?php echo htmlspecialchars($book['place']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" name="publisher"
                            value="<?php echo htmlspecialchars($book['publisher']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="Pdate">Publication Date:</label>
                        <input type="date" class="form-control" id="Pdate" name="Pdate"
                            value="<?php echo htmlspecialchars($book['Pdate']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="copyright">Copyright:</label>
                        <input type="text" class="form-control" id="copyright" name="copyright"
                            value="<?php echo htmlspecialchars($book['copyright']); ?>">
                    </div>
                </div>

                <!-- Series Fields -->
                <div class="col-md-4 form-section">
                    <div class="form-group">
                        <label for="volume">Volume:</label>
                        <input type="text" class="form-control" id="volume" name="volume"
                            value="<?php echo htmlspecialchars($series['volume']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="IL">Interest Level (IL):</label>
                        <input type="text" class="form-control" id="IL" name="IL"
                            value="<?php echo htmlspecialchars($series['IL']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="lexille">Lexile Measure:</label>
                        <input type="text" class="form-control" id="lexille" name="lexille"
                            value="<?php echo htmlspecialchars($series['lexille'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="F_and_P">Fountas and Pinnell:</label>
                        <input type="text" class="form-control" id="F_and_P" name="F_and_P"
                            value="<?php echo htmlspecialchars($series['F_and_P'] ?? ''); ?>">
                    </div>
                </div>

                <div class="col-md-4 form-section">
                <div class="form-group">
                        <input class="form-select mt-3" name="Sub_Head" id="Sub_Head"
                        value="<?php echo htmlspecialchars($subject['Sub_Head'] ?? ''); ?>">
                            
                        <input type="text" name="Sub_Head_input" id="Sub_Head_input"
                        value="<?php echo htmlspecialchars($subject['Sub_Head_input'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-select mt-3" name="Sub_Body_1" id="Sub_Body_1" 
                        value="<?php echo htmlspecialchars($subject['Sub_Body_1'] ?? ''); ?>">
                            
                        </input>
                        <input type="text" name="Sub_input_1" id="Sub_input_1"
                        value="<?php echo htmlspecialchars($subject['Sub_input_1'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <input class="form-select mt-3" name="Sub_Body_2" id="Sub_Body_2"
                        value="<?php echo htmlspecialchars($subject['Sub_Body_2'] ?? ''); ?>">

                        </input>
                        <input type="text" name="Sub_input_2" id="Sub_input_2"
                        value="<?php echo htmlspecialchars($subject['Sub_input_2'] ?? ''); ?>">

                    </div>
                    <div class="form-group">
                        <input class="form-select mt-3" name="Sub_Body_3" id="Sub_Body_3"
                        value="<?php echo htmlspecialchars($subject['Sub_Body_3'] ?? ''); ?>">

                           
                        </input>
                        <input type="text" name="Sub_input_3" id="Sub_input_3"
                        value="<?php echo htmlspecialchars($subject['Sub_input_3'] ?? ''); ?>">

                    </div>
</div>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
        <?php endif; ?>
    </div>
</body>

</html>