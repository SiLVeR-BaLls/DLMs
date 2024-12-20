<?php
    include '../config.php';

    // Initialize message variables
    $message = "";
    $message_type = "";

    // Get the book title from the query string
    $title = $_GET['title'] ?? '';

    if ($title) {
        // Fetch the book details
        $sql = "SELECT * FROM Book WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $title);

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
                $coAuthorsResult = fetch_related_data($conn, "SELECT * FROM CoAuthor WHERE book_id = ?", $title);
                $subjectsResult = fetch_related_data($conn, "SELECT * FROM Subject WHERE book_id = ?", $title);
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
            /* Style for the input fields */
        input.form-control, select.form-select, textarea.form-control {
            border-left: 2px solid #333333; /* Darker border color */
            border-bottom: 2px solid #333333; /* Darker bottom border */
            border-top: none; /* No border on top */
            border-right: none; /* No border on right */
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 8px;
            padding-bottom: 8px;
            background-color: #f2f2f2; /* Light gray background */
            color: #333333; /* Dark text color for better contrast */
            transition: border-color 0.3s ease, background-color 0.3s ease; /* Smooth transition for border and background color */
        }

        /* Style for focus effect */
        input.form-control:focus, select.form-select:focus, textarea.form-control:focus {
            border-color: #1d1d1d; /* Even darker border color on focus */
            background-color: #e6e6e6; /* Slightly darker background when focused */
            outline: none; /* Remove default focus outline */
        }

        /* Optional: Style the focus effect with a box-shadow for more emphasis */
        input.form-control:focus, select.form-select:focus, textarea.form-control:focus {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Dark shadow for focus */
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
  <!-- Main Content Area with Sidebar and BrowseBook Section -->
  <main class="flex flex-grow">
    <!-- Sidebar Section -->
    <?php include 'include/sidebar.php'; ?>
    <!-- BrowseBook Content Section -->
    <div class="flex-grow ">
      <!-- Header at the Top -->
      <?php include 'include/header.php'; ?>

      <div class="container mx-auto px-4 py-6 ">
        <!-- Breadcrumb Section -->
        <div class="text-sm text-gray-600 mb-4">
    <a href="index.php" class="hover:text-blue-800 hover:underline">Home</a> &rarr;
    <a href="ViewBook.php?title=<?php echo urlencode($book['book_id']); ?>" class="hover:text-blue-800 hover:underline">
            <?php echo htmlspecialchars($book['B_title']); ?>
        </a> &rarr;
    <a href="AddBookCopy.php?title=<?php echo urlencode($book['book_id']); ?>" class="hover:text-blue-800 hover:underline">Edit Copy</a>
</div>
        <a href="ViewBook.php?title=<?php echo urlencode($book['book_id']); ?>"
          class="hover:text-blue-800 hover:underline">&larr; Back</a>
        <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>">
          <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        <form action="CopyConnection.php" method="post" class="book-card">

          <!-- Display the title -->
        <div class="text-center mb-4">
            <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($book['B_title']); ?></h2>
            <input type="hidden" name="B_title" id="B_title" value="<?php echo htmlspecialchars($book['B_title']); ?>">
        </div>

          <input type="hidden" name="B_title" id="B_title" value="<?php echo htmlspecialchars($book['B_title']); ?>">

          <!-- Status and Rating (Grouped in one row) -->
          <div class="flex flex-wrap gap-4 justify-center mb-4">
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
              <input type="date" id="dateAcquired" name="dateAcquired" class="form-control w-full" required>
            </div>
          </div>

          <!-- Copy Information Section (Grouped in one row) -->
          <h5 class="mt-4 mb-4 text-center">Copy Information</h5>
          <div class="flex justify-center flex-wrap gap-4 mb-4">
            <!-- QR Code -->
            <div class="flex justify-center flex-wrap gap-4 mb-4">
              <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
                <label for="copy_ID" class="form-label">QR Code</label>
                <input type="text" id="copy_ID" name="copy_ID" class="form-control w-full" required>
              </div>

              <!-- Call Number -->
              <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
                <label for="callNumber" class="form-label">Call Number</label>
                <input type="text" id="callNumber" name="callNumber" class="form-control w-full" required>
              </div>

              <!-- Purchase Price -->
              <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
                <label for="purchasePrice" class="form-label">Purchase Price</label>
                <input type="number" step="0.1" id="purchasePrice" name="purchasePrice" class="form-control w-full">
              </div>
              <!-- Copy Number -->
              <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
                <label for="copyNumber" class="form-label">Copy Number</label>
                <input type="number" id="copyNumber" name="copyNumber" class="form-control w-full">
              </div>
            </div>
            <!-- Notes -->
            <div class="w-full sm:w-1/2 lg:w-1/3 mb-4">
              <label for="notes" class="form-label">Notes</label>
              <textarea class="form-control w-full" id="notes" name="note"
                placeholder="Any additional information about the book"></textarea>
            </div>
          </div>

          <!-- Accession and Number Fields Grouped Together Using Flex -->
          <h5 class="mt-4 mb-4 text-center">Accession and Number</h5>
          <div class="flex justify-center flex-wrap gap-4">
            <!-- Accession Fields Group -->
            <div class=" flex-col sm:flex-row gap-4 w-full sm:w-1/2 lg:w-1/3 mb-4">
              <!-- Accession 1 -->
              <label for="description1" class="form-label w-full">Accession</label>
              <div class="w-full mb-4">
                <input type="text" id="description1" name="description1" class="form-control w-full">
              </div>

              <!-- Accession 2 -->
              <div class="w-full mb-4">
                <input type="text" id="description2" name="description2" class="form-control w-full">
              </div>

              <!-- Accession 3 -->
              <div class="w-full mb-4">
                <input type="text" id="description3" name="description3" class="form-control w-full">
              </div>
            </div>

            <!-- Number Fields Group -->
            <div class=" flex-col sm:flex-row gap-4 w-full sm:w-1/2 lg:w-1/3 mb-4">
              <!-- Number 1 -->
              <label for="number1" class="form-label w-full">Number</label>
              <div class="w-full mb-4">
                <input type="number" id="number1" name="number1" class="form-control w-full">
              </div>

              <!-- Number 2 -->
              <div class="w-full mb-4">
                <input type="number" id="number2" name="number2" class="form-control w-full">
              </div>

              <!-- Number 3 -->
              <div class="w-full mb-4">
                <input type="number" id="number3" name="number3" class="form-control w-full">
              </div>
            </div>
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
              <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900"
                onclick="showSublocationInput()">Add New Sublocation</button>
              <div class="flex">
                <input type="text"
                  class="border-b border-gray-400 bg-gray-200 text-gray-700 p-2 px-3 w-40 mt-2 hidden focus:border-black"
                  id="newSublocation" placeholder="Enter new sublocation">
                <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900 hidden"
                  id="addSublocationBtn" onclick="addSublocation()">Add</button>
              </div>
            </div>

            <!-- Vendor -->
            <div class="w-full sm:w-1/4 lg:w-1/4 mb-4">
              <label for="vendor" class="form-label">Vendor</label>
              <select id="vendor" name="vendor" class="form-select w-full">
                <option selected>DTFOS Bookstore</option>
                <option>Other</option>
              </select>
              <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900"
                onclick="showVendorInput()">Add New Vendor</button>
              <div class="flex">
                <input type="text"
                  class="border-b border-gray-400 bg-gray-200 text-gray-700 p-2 px-3 w-40 mt-2 hidden focus:border-black"
                  id="newVendor" placeholder="Enter new vendor">
                <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900 hidden"
                  id="addVendorBtn" onclick="addVendor()">Add</button>
              </div>
            </div>

            <!-- Funding Source -->
            <div class="w-full sm:w-1/4 lg:w-1/4 mb-4">
              <label for="fundingSource" class="form-label">Funding Source</label>
              <select id="fundingSource" name="fundingSource" class="form-select w-full">
                <option selected>Purchased</option>
                <option>Donated</option>
                <option>Other</option>
              </select>
              <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900"
                onclick="showFundingSourceInput()">Add New Funding
                Source</button>
              <div class="flex">
                <input type="text"
                  class="border-b border-gray-400 bg-gray-200 text-gray-700 p-2 px-3 w-40 mt-2 hidden focus:border-black"
                  id="newFundingSource" placeholder="Enter new funding source">
                <button type="button" class="btn btn-link text-gray-500 hover:text-gray-700 active:text-gray-900 hidden"
                  id="addFundingSourceBtn" onclick="addFundingSource()">Add</button>
              </div>
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
      <!-- Footer at the Bottom -->
      <footer class="bg-blue-600 text-white mt-auto">
        <?php include 'include/footer.php'; ?>
      </footer>
  </main>
</body>

</html>