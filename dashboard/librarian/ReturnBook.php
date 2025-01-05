<!-- retunbook.php -->

<?php
include 'include/ReturnConnect.php';

// Handle AJAX request to fetch borrow book details and rating
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true' && isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // SQL query to fetch all matching records
    $stmt = $conn->prepare("
        SELECT book.id AS book_id, book.B_title, book.author, book.publisher, 
               book_copies.copy_ID, borrow_book.ID AS borrow_id, borrow_book.IDno, 
               borrow_book.borrow_date, borrow_book.return_date, 
               book_copies.rating
        FROM borrow_book
        JOIN book_copies ON borrow_book.ID = Book_copies.book_copy_ID
        JOIN book ON book_copies.B_title = book.B_title
        WHERE borrow_book.return_date IS NULL AND borrow_book.ID LIKE ?
    ");

    $searchTerm = "%" . $ID . "%"; // Add wildcards for partial matching
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response = "<p class='text-lg font-semibold'>Click on a Book to View Details:</p><ul class='list-disc pl-6'>";

        while ($borrow = $result->fetch_assoc()) {
            $bookDetails = json_encode($borrow); // Convert to JSON for JavaScript handling
            $response .= "<li class='cursor-pointer list-none text-blue-500 hover:underline' onclick='displaySelectedBook(this)' 
                            data-book='" . htmlspecialchars($bookDetails, ENT_QUOTES, 'UTF-8') . "'>";
            $response .= "ID: " . $borrow['borrow_id'] . " | Title: " . $borrow['B_title'];
            $response .= "</li>";
        }

        $response .= "</ul><div id='bookDetails' class='mt-4'></div>";
        echo $response;
    } else {
        echo "<p class='text-red-500'>No active borrow record found for this ID.</p>";
    }

    $conn->close();
    exit;
}

// Update the rating if the form is submitted
if (isset($_POST['approve'])) {
    $ID = $_POST['ID'];

    // Check if the rating is set, even if it's 0
    if (isset($_POST['rating']) && $_POST['rating'] !== '') {
        $rating = $_POST['rating'];

        // Debugging: log the received rating value
        error_log("Received rating: " . $rating);

        // Update query to save the rating before returning the book
        $stmt = $conn->prepare("UPDATE book_copies SET rating = ? WHERE ID = ?");
        $stmt->bind_param("ii", $rating, $ID);

        if ($stmt->execute()) {
            $successMessage = "Book return and rating update successful.";
        } else {
            $errorMessage = "Failed to update rating.";
        }
    } else {
        $errorMessage = "Rating is required and cannot be blank.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Return Book</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

  <!-- Header -->
  <?php include 'include/header.php'; ?>

  <!-- Main Content Area -->
  <main class="flex flex-grow overflow-auto"> <!-- Added overflow-auto here -->
    <!-- Sidebar Section -->
    <?php include 'include/sidebar.php'; ?>

    <!-- Main Content Section -->
    <div class="flex-grow">
      <div class="container max-w-3xl mx-auto px-4 py-6">

        <!-- Return Book Form -->
        <h2 class="text-2xl font-semibold mb-4 text-center">Return Book</h2>
        <form method="POST" action="">
          <div>
            <label for="ID" class="block text-lg">Book ID:</label>
            <input type="text" id="ID" name="ID" required class="w-full p-2 border border-gray-300 rounded-md"
              oninput="fetchBorrowDetails()">
          </div>
          <div id="borrowDetails" class="mt-4">
            <!-- Borrow book details will be displayed here -->
          </div>
          <div>
            <button type="button" onclick="openConfirmationDialog()"
              class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Return Book</button>
          </div>
        </form>
      </div>
      <!-- Footer -->
      <footer class="bg-blue-600 text-white p-4 mt-auto">
        <?php include 'include/footer.php'; ?>
      </footer>
    </div>
  </main>

  <!-- Confirmation Pop-up -->
  <div id="confirmationPopUp" class="hidden fixed inset-0 bg-gray-200 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-md shadow-lg text-center">
      <h3 class="text-lg font-semibold">Confirm Book Return</h3>
      <p class="mt-2">Are you sure you want to return this book?</p>
      <div class="mt-4">
        <form method="POST" action="">
          <input type="hidden" id="confirmID" name="ID">
          <input type="hidden" id="confirmRating" name="rating">
          <button type="submit" name="approve" value="1"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Approve</button>
          <button type="button" onclick="closePopUp('confirmationPopUp')"
            class="ml-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Cancel</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function fetchBorrowDetails() {
      var ID = document.getElementById("ID").value;

      if (ID.length >= 1) {
        $.ajax({
          url: '', // Request to the same page
          type: 'GET',
          data: { ID: ID, ajax: 'true' },
          success: function (response) {
            $('#borrowDetails').html(response);
          },
          error: function () {
            $('#borrowDetails').html('<p class="text-red-500">Error fetching details.</p>');
          }
        });
      } else {
        $('#borrowDetails').html('');
      }
    }

    function openConfirmationDialog() {
      var ID = document.getElementById("ID").value;
      var rating = document.getElementById("rating") ? document.getElementById("rating").value : "";

      if (ID && rating >= 0) { // Check for valid ID and rating
        document.getElementById("confirmID").value = ID;
        document.getElementById("confirmRating").value = rating;
        document.getElementById("confirmationPopUp").style.display = 'flex';
      } else {
        alert("Please select a book and provide a valid rating!");
      }
    }

    function closePopUp(popUpId) {
      document.getElementById(popUpId).style.display = 'none';
    }

    function displaySelectedBook(element) {
      var bookData = element.getAttribute('data-book');
      if (bookData) {
        try {
          var book = JSON.parse(bookData);
          if (book && book.borrow_id) {
            var details = ` 
                            <p><strong>Borrow ID:</strong> ${book.borrow_id}</p>
                            <p><strong>Book Title:</strong> ${book.B_title}</p>
                            <p><strong>Author:</strong> ${book.author}</p>
                            <p><strong>Publisher:</strong> ${book.publisher}</p>
                            <p><strong>Borrow Date:</strong> ${book.borrow_date}</p>
                            <p><strong>Rating:</strong> 
                                <input type='number' id='rating' name='rating' value='${book.rating}' min='0' max='5' class='w-20 p-1 border border-gray-300 rounded-md'>
                            </p>
                        `;
            document.getElementById("bookDetails").innerHTML = details;
            document.getElementById("ID").value = book.borrow_id;
          }
        } catch (error) {
          console.error("Error parsing book data:", error);
        }
      }
    }
  </script>
</body>

</html>