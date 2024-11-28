<?php
  include '../config.php'; // Include the config file

  // Initialize variables for error/success messages
  $successMessage = '';
  $errorMessage = '';

  // Get search query and filter type from POST request
  $searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';
  $filterType = isset($_POST['filterType']) ? $_POST['filterType'] : 'all';

  // Handle form submission for book return and rating update
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approve'])) {
      $ID = $_POST["ID"];
      $rating = $_POST["rating"];

      if (!empty($ID)) {
          // Check if the Borrow ID exists and book is still borrowed
          $checkID = $conn->prepare("SELECT ID FROM borrow_book WHERE ID = ? AND return_date IS NULL");
          $checkID->bind_param("i", $ID);
          $checkID->execute();
          $checkID->store_result();

          if ($checkID->num_rows > 0) {
              // Begin transaction
              $conn->begin_transaction();

              // Update the rating in the book_copies table
              $updateRating = $conn->prepare("UPDATE book_copies SET rating = ? WHERE ID = ?");
              $updateRating->bind_param("ii", $rating, $ID);
              $updateRating->execute();

              // Update the return date in borrow_book
              $stmt = $conn->prepare("UPDATE borrow_book SET return_date = NOW() WHERE ID = ?");
              $stmt->bind_param("i", $ID);
              $stmt->execute();

              // Update the book status to 'Available'
              $updateBook = $conn->prepare("UPDATE book_copies SET status = 'Available' WHERE ID = ?");
              $updateBook->bind_param("i", $ID);
              $updateBook->execute();

              // Commit transaction
              $conn->commit();
              $successMessage = "Book returned successfully and rating updated!";
          } else {
              $errorMessage = "Invalid Borrow ID or book already returned.";
          }
      } else {
          $errorMessage = "Borrow ID is missing.";
      }
  }

  // Fetch borrowed books with optional search and filter
  $query = "
      SELECT 
          bb.ID, bb.borrow_id, bb.borrow_date, ui.IDno, ui.Fname, ui.Sname, 
          bc.B_title, b.author, bb.due_date, ud.college, ud.course, bc.rating
      FROM borrow_book AS bb
      JOIN users_info AS ui ON bb.IDno = ui.IDno
      JOIN user_details AS ud ON bb.IDno = ud.IDno
      JOIN book_copies AS bc ON bb.ID = bc.ID
      JOIN book AS b ON bc.B_title = b.B_title
      WHERE bb.return_date IS NULL
  ";

  // Apply search and filter
  if (!empty($searchQuery)) {
      if ($filterType != 'all') {
          $query .= " AND ($filterType LIKE ?)";
      } else {
          $query .= " AND (
              bc.B_title LIKE ? OR ui.Fname LIKE ? OR 
              ui.Sname LIKE ? OR bb.ID LIKE ? OR ui.IDno LIKE ?
          )";
      }
  }

  $stmt = $conn->prepare($query);
  if (!empty($searchQuery)) {
      $searchTerm = "%$searchQuery%";
      if ($filterType != 'all') {
          $stmt->bind_param("s", $searchTerm);
      } else {
          $stmt->bind_param("sssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
      }
  }
  $stmt->execute();
  $result = $stmt->get_result();

  // Helper function to calculate overdue status
  function calculateOverdue($due_date)
  {
      $currentDate = new DateTime();
      $dueDate = new DateTime($due_date);

      return ($dueDate < $currentDate) ? 'Overdue' : 'On time';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Borrowed Books</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow">

<div class="container mx-auto px-4 py-6 ">

      <h2 class="text-3xl font-semibold mb-6">Borrowed Books</h2>
      <!-- Search and Filter -->
      <div class="flex flex-row gap-4 mb-6 items-center">
      <input type="text" id="searchBox"         
      class="form-input block w-40 sm:w-60 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm"
      placeholder="Search..." />
        <select id="filterType"         
        class="form-select block px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm"
        >
          <option value="all">All</option>
          <option value="bc.B_title">Book Title</option>
          <option value="ui.Fname">First Name</option>
          <option value="ui.Sname">Surname</option>
          <option value="bb.ID">Book ID</option>
          <option value="ui.IDno">User ID</option>
        </select>
      </div>

      <!-- Borrowed Books Table -->
      <div id="booksTableContainer">
        <?php if ($result && $result->num_rows > 0): ?>
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
          <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th class="px-4 py-2">Book ID</th>
                <th class="px-4 py-2">Username</th>
                <th class="px-4 py-2">First Name</th>
                <th class="px-4 py-2">Book Title</th>
                <th class="px-4 py-2">Borrow Date</th>
                <th class="px-4 py-2">Due Date</th>
                <th class="px-4 py-2">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
              <tr class="cursor-pointer" data-id="<?= $row['ID'] ?>" data-rating="<?= $row['rating'] ?>">
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['ID']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['IDno']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['Fname']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['B_title']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['borrow_date']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= htmlspecialchars($row['due_date']) ?>
                </td>
                <td class="px-4 py-2">
                  <?= calculateOverdue($row['due_date']) ?>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <p>No records found</p>
        <?php endif; ?>
      </div>
      </div>
          <!-- Footer at the Bottom -->
          <footer class="bg-blue-600 text-white p-4 mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>

  <!-- Modal pup up-->
  <div id="adminModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
      <h3 class="text-xl font-semibold mb-4 text-center">Admin Approval</h3>
      <form action="" method="POST" id="approvalForm">
        <input type="hidden" name="ID" id="borrowId">
        <div class="mb-4">
          <p><strong>Borrow ID:</strong> <span id="borrowIdDisplay" class="font-medium text-gray-700"></span></p>
          <p><strong>Book Title:</strong> <span id="bookTitle" class="font-medium text-gray-700"></span></p>
          <p><strong>Author:</strong> <span id="author" class="font-medium text-gray-700"></span></p>
          <p><strong>Publisher:</strong> <span id="publisher" class="font-medium text-gray-700"></span></p>
          <p><strong>Borrow Date:</strong> <span id="borrowDate" class="font-medium text-gray-700"></span></p>
          <p><strong>Rating:</strong>
            <input type="number" id="rating" name="rating" min="0" max="5"
              class="w-20 p-2 mt-2 border border-gray-300 rounded-md" value="">
          </p>
        </div>
        <!-- buttons -->
        <div class="flex justify-between">
          <button type="button" id="noBtn" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cancel</button>
          <button type="submit" name="approve" class="bg-green-600 text-white px-4 py-2 rounded-md">Approve</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Live search functionality
    $('#searchBox').on('input', function () {
      var searchQuery = $(this).val();
      var filterType = $('#filterType').val();

      $.ajax({
        url: '', // Current page URL
        method: 'POST',
        data: { searchQuery, filterType },
        success: function (response) {
          $('#booksTableContainer').html($(response).find('#booksTableContainer').html());
        }
      });
    });

    // Show approval modal
    $('.cursor-pointer').on('click', function () {
      $('#borrowId').val($(this).data('id'));
      $('#borrowIdDisplay').text($(this).data('id'));
      $('#bookTitle').text($(this).data('rating'));
      $('#adminModal').removeClass('hidden');
    });

    // Hide modal
    $('#noBtn').on('click', function () {
      $('#adminModal').addClass('hidden');
    });
  </script>

  <script>
    // Handle click event on the rows to open the modal
    document.querySelectorAll('tr.cursor-pointer').forEach(row => {
      row.addEventListener('click', function () {
        var borrowId = this.dataset.id;
        var bookTitle = this.cells[3].innerText;
        var author = this.cells[2].innerText;
        var publisher = this.cells[3].innerText;
        var borrowDate = this.cells[4].innerText;
        var rating = this.dataset.rating;

        document.getElementById('borrowId').value = borrowId;
        document.getElementById('borrowIdDisplay').innerText = borrowId;
        document.getElementById('bookTitle').innerText = bookTitle;
        document.getElementById('author').innerText = author;
        document.getElementById('publisher').innerText = publisher;
        document.getElementById('borrowDate').innerText = borrowDate;
        document.getElementById('rating').value = rating; // Set the rating value

        document.getElementById('adminModal').classList.remove('hidden');
      });
    });

    // Handle clicking the 'No' button to close the modal
    document.getElementById('noBtn').addEventListener('click', function () {
      document.getElementById('adminModal').classList.add('hidden');
    });

    // Close the modal if clicked outside of the modal content
    document.getElementById('adminModal').addEventListener('click', function (event) {
      if (event.target === this) {
        document.getElementById('adminModal').classList.add('hidden');
      }
    });


  </script>
  
</body>

</html>