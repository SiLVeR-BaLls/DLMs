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

            // Helper function to fetch related data
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
    <title>Library Book Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <form action="CopyConnection.php" method="post">

            <!-- display the title -->
            <h4 class="book-title">
                <?php echo htmlspecialchars($book['B_title']); ?>
            </h4>
            <a href="ViewBook.php?title=<?php echo urlencode($book['B_title']); ?>" class="btn btn-primary">list</a>

            <input type="hidden" name="B_title" id="B_title" value="<?php echo htmlspecialchars($book['B_title']); ?>">


            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option selected>Available</option>
                    <option>Checked Out</option>
                    <option>Lost</option>
                </select>
            </div>

            <!-- QR Code -->
            <div class="mb-3">
                <label for="copy_ID" class="form-label">QR Code</label>
                <input type="text" class="form-control" id="copy_ID" name="copy_ID" required>
            </div>

            <!-- Call Number -->
            <div class="mb-3">
                <label for="callNumber" class="form-label">Call Number</label>
                <input type="text" class="form-control" id="callNumber" name="callNumber" required>
            </div>

            <!-- Rating -->
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Select a Rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>


            <!-- Purchase Price -->
            <div class="mb-3">
                <label for="purchasePrice" class="form-label">Purchase Price</label>
                <input type="number" step="0.01" class="form-control" id="purchasePrice" name="purchasePrice">
            </div>

            <!-- Circulation Type -->
            <div class="mb-3">
                <label for="circulationType" class="form-label">Circulation Type</label>
                <select class="form-select" id="circulationType" name="circulationType">
                    <option selected>General Circulation</option>
                    <option>Reference</option>
                    <option>Reserve</option>
                </select>
            </div>

            <!-- Date Acquired -->
            <div class="mb-3">
                <label for="dateAcquired" class="form-label">Date Acquired</label>
                <input type="date" class="form-control" id="dateAcquired" name="dateAcquired">
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes"
                    rows="2">There are no notes for this copy.</textarea>
            </div>

            <!-- Copy Information -->
            <h5>Copy Information</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="description1" class="form-label">Description 1</label>
                    <input type="text" class="form-control" id="description1" name="description1">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="number1" class="form-label">Number 1</label>
                    <input type="number" class="form-control" id="number1" name="number1">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description2" class="form-label">Description 2</label>
                    <input type="text" class="form-control" id="description2" name="description2">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="number2" class="form-label">Number 2</label>
                    <input type="number" class="form-control" id="number2" name="number2">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description3" class="form-label">Description 3</label>
                    <input type="text" class="form-control" id="description3" name="description3">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="number3" class="form-label">Number 3</label>
                    <input type="number" class="form-control" id="number3" name="number3">
                </div>
            </div>

            <!-- Copy Number -->
            <div class="mb-3">
                <label for="copyNumber" class="form-label">Copy Number</label>
                <input type="number" class="form-control" id="copyNumber" name="copyNumber">
            </div>

            <!-- Sublocation -->
            <div class="mb-3">
                <label for="sublocation" class="form-label">Sublocation</label>
                <select class="form-select" id="sublocation" name="sublocation">
                    <option selected>Technical Section</option>
                    <option>Circulation Section</option>
                    <option>Reference Section</option>
                </select>
                <button type="button" class="btn btn-link" onclick="showSublocationInput()">Add New Sublocation</button>
                <input type="text" class="form-control hidden" id="newSublocation" placeholder="Enter new sublocation">
                <button type="button" class="btn btn-sm btn-outline-primary hidden" id="addSublocationBtn"
                    onclick="addSublocation()">Add</button>
            </div>

            <!-- Vendor -->
            <div class="mb-3">
                <label for="vendor" class="form-label">Vendor</label>
                <select class="form-select" id="vendor" name="vendor">
                    <option selected>DTFOS Bookstore</option>
                    <option>Other</option>
                </select>
                <button type="button" class="btn btn-link" onclick="showVendorInput()">Add New Vendor</button>
                <input type="text" class="form-control hidden" id="newVendor" placeholder="Enter new vendor">
                <button type="button" class="btn btn-sm btn-outline-primary hidden" id="addVendorBtn"
                    onclick="addVendor()">Add</button>
            </div>

            <!-- Funding Source -->
            <div class="mb-3">
                <label for="fundingSource" class="form-label">Funding Source</label>
                <select class="form-select" id="fundingSource" name="fundingSource">
                    <option selected>Purchased</option>
                    <option>Donated</option>
                    <option>Other</option>
                </select>
                <button type="button" class="btn btn-link" onclick="showFundingSourceInput()">Add New Funding
                    Source</button>
                <input type="text" class="form-control hidden" id="newFundingSource"
                    placeholder="Enter new funding source">
                <button type="button" class="btn btn-sm btn-outline-primary hidden" id="addFundingSourceBtn"
                    onclick="addFundingSource()">Add</button>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Vendor Functions
            function showVendorInput() {
                document.getElementById('newVendor').classList.remove('hidden');
                document.getElementById('addVendorBtn').classList.remove('hidden');
            }

            function addVendor() {
                var newVendor = document.getElementById('newVendor').value;
                if (newVendor) {
                    var vendorSelect = document.getElementById('vendor');
                    var option = document.createElement('option');
                    option.value = newVendor;
                    option.text = newVendor;
                    vendorSelect.add(option);
                    vendorSelect.value = newVendor; // Select the newly added vendor
                    resetVendorInput();
                }
            }

            function resetVendorInput() {
                document.getElementById('newVendor').classList.add('hidden');
                document.getElementById('addVendorBtn').classList.add('hidden');
                document.getElementById('newVendor').value = 'add'; // Clear input
            }

            // Sublocation Functions
            function showSublocationInput() {
                document.getElementById('newSublocation').classList.remove('hidden');
                document.getElementById('addSublocationBtn').classList.remove('hidden');
            }

            function addSublocation() {
                var newSublocation = document.getElementById('newSublocation').value;
                if (newSublocation) {
                    var sublocationSelect = document.getElementById('sublocation');
                    var option = document.createElement('option');
                    option.value = newSublocation;
                    option.text = newSublocation;
                    sublocationSelect.add(option);
                    sublocationSelect.value = newSublocation; // Select the newly added sublocation
                    resetSublocationInput();
                }
            }

            function resetSublocationInput() {
                document.getElementById('newSublocation').classList.add('hidden');
                document.getElementById('addSublocationBtn').classList.add('hidden');
                document.getElementById('newSublocation').value = ''; // Clear input
            }

            // Funding Source Functions
            function showFundingSourceInput() {
                document.getElementById('newFundingSource').classList.remove('hidden');
                document.getElementById('addFundingSourceBtn').classList.remove('hidden');
            }

            function addFundingSource() {
                var newFundingSource = document.getElementById('newFundingSource').value;
                if (newFundingSource) {
                    var fundingSourceSelect = document.getElementById('fundingSource');
                    var option = document.createElement('option');
                    option.value = newFundingSource;
                    option.text = newFundingSource;
                    fundingSourceSelect.add(option);
                    fundingSourceSelect.value = newFundingSource; // Select the newly added funding source
                    resetFundingSourceInput();
                }
            }

            function resetFundingSourceInput() {
                document.getElementById('newFundingSource').classList.add('hidden');
                document.getElementById('addFundingSourceBtn').classList.add('hidden');
                document.getElementById('newFundingSource').value = ''; // Clear input
            }
        </script>
    </div>
</body>

</html>