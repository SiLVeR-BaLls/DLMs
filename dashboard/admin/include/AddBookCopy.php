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
        <script src="https://cdn.tailwindcss.com"></script>


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
        <form action="CopyConnection.php" method="post" class="max-w-4xl mx-auto p-4 space-y-4">

<!-- Display the title -->
<h4 class="book-title text-center mb-4">
    <?php echo htmlspecialchars($book['B_title']); ?>
</h4>
<a href="../ViewBook.php?title=<?php echo urlencode($book['B_title']); ?>" class="btn btn-primary block mx-auto mb-6">List</a>

<input type="hidden" name="B_title" id="B_title" value="<?php echo htmlspecialchars($book['B_title']); ?>">

<!-- Status and Rating (Grouped in one row) -->
<div class="flex flex-wrap gap-4 mb-4">
    <!-- Status -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select w-full">
            <option selected>Available</option>
            <option>Checked Out</option>
            <option>Lost</option>
        </select>
    </div>

    <!-- Rating -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="rating" class="form-label">Rating</label>
        <select id="rating" name="rating" class="form-select w-full" required>
            <option value="5">5 Stars</option>
            <option value="4">4 Stars</option>
            <option value="3">3 Stars</option>
            <option value="2">2 Stars</option>
            <option value="1">1 Star</option>
        </select>
    </div>

    <!-- Circulation Type -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="circulationType" class="form-label">Circulation Type</label>
        <select id="circulationType" name="circulationType" class="form-select w-full">
            <option selected>General Circulation</option>
            <option>Reference</option>
            <option>Reserve</option>
        </select>
    </div>

    <!-- Date Acquired -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="dateAcquired" class="form-label">Date Acquired</label>
        <input type="date" id="dateAcquired" name="dateAcquired" class="form-control w-full">
    </div>
</div>

<!-- Copy Information Section (Grouped in one row) -->
<h5 class="mt-4 mb-4 text-center">Copy Information</h5>
<div class="flex flex-wrap gap-4 mb-4">
    <!-- QR Code -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="copy_ID" class="form-label">QR Code</label>
        <input type="text" id="copy_ID" name="copy_ID" class="form-control w-full" required>
    </div>

    <!-- Call Number -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="callNumber" class="form-label">Call Number</label>
        <input type="text" id="callNumber" name="callNumber" class="form-control w-full" required>
    </div>
</div>

<!-- Purchase Price and Notes (Grouped in one row) -->
<div class="flex flex-wrap gap-4 mb-4">
    <!-- Purchase Price -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="purchasePrice" class="form-label">Purchase Price</label>
        <input type="number" step="0.1" id="purchasePrice" name="purchasePrice" class="form-control w-full">
    </div>

    <!-- Notes -->
    <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
        <label for="notes" class="form-label">Notes</label>
        <textarea class="form-control w-full" id="notes" name="note" placeholder="Any additional information about the book"></textarea>
    </div>
</div>

<!-- Accession and Number Fields Grouped Together Using Flex -->
<h5 class="mt-4 mb-4 text-center">Accession and Number</h5>
<div class="flex flex-wrap gap-4 mb-4">
    <!-- Accession Fields Group -->
    <div class="flex flex-wrap gap-4 w-full sm:w-1/2 lg:w-1/2 mb-4">
        <!-- Accession 1 -->
        <div class="w-full mb-4">
            <label for="description1" class="form-label">Accession</label>
            <input type="text" id="description1" name="description1" class="form-control w-full">
        </div>

        <!-- Accession 2 -->
        <div class="w-full mb-4">
            <label for="description2" class="form-label">Accession</label>
            <input type="text" id="description2" name="description2" class="form-control w-full">
        </div>

        <!-- Accession 3 -->
        <div class="w-full mb-4">
            <label for="description3" class="form-label">Accession</label>
            <input type="text" id="description3" name="description3" class="form-control w-full">
        </div>
    </div>

    <!-- Number Fields Group -->
    <div class="flex flex-wrap gap-4 w-full sm:w-1/2 lg:w-1/2 mb-4">
        <!-- Number 1 -->
        <div class="w-full mb-4">
            <label for="number1" class="form-label">Number</label>
            <input type="number" id="number1" name="number1" class="form-control w-full">
        </div>

        <!-- Number 2 -->
        <div class="w-full mb-4">
            <label for="number2" class="form-label">Number</label>
            <input type="number" id="number2" name="number2" class="form-control w-full">
        </div>

        <!-- Number 3 -->
        <div class="w-full mb-4">
            <label for="number3" class="form-label">Number</label>
            <input type="number" id="number3" name="number3" class="form-control w-full">
        </div>
    </div>
</div>

<!-- Copy Number -->
<div class="mb-4">
    <label for="copyNumber" class="form-label">Copy Number</label>
    <input type="number" id="copyNumber" name="copyNumber" class="form-control w-full">
</div>

<!-- Group: Sublocation, Vendor, Funding Source (Grouped in one row) -->
<h5 class="mt-4 mb-4 text-center">Additional Information</h5>
<div class="flex justify-center gap-4 mb-4">
    <!-- Sublocation -->
    <div class="w-full sm:w-1/4 lg:w-1/4 mb-4">
        <label for="sublocation" class="form-label">Sublocation</label>
        <select id="sublocation" name="sublocation" class="form-select w-full">
            <option selected>Technical Section</option>
            <option>Circulation Section</option>
            <option>Reference Section</option>
        </select>
    </div>

    <!-- Vendor -->
    <div class="w-full sm:w-1/4 lg:w-1/4 mb-4">
        <label for="vendor" class="form-label">Vendor</label>
        <select id="vendor" name="vendor" class="form-select w-full">
            <option selected>DTFOS Bookstore</option>
            <option>Other</option>
        </select>
    </div>

    <!-- Funding Source -->
    <div class="w-full sm:w-1/4 lg:w-1/4 mb-4">
        <label for="fundingSource" class="form-label">Funding Source</label>
        <select id="fundingSource" name="fundingSource" class="form-select w-full">
            <option selected>Purchased</option>
            <option>Donated</option>
            <option>Other</option>
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary mt-4 block mx-auto">Submit</button>
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