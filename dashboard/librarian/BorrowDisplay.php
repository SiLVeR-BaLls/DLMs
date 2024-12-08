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


  
  // Handle extend action
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['extendBook'])) {
    $ID = $_POST["ID"];
    $newDueDate = $_POST["newDueDate"];

    if (!empty($ID) && !empty($newDueDate)) {
        $stmt = $conn->prepare("UPDATE borrow_book SET due_date = ? WHERE ID = ?");
        $stmt->bind_param("si", $newDueDate, $ID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $successMessage = "Due date extended successfully!";
        } else {
            $errorMessage = "Failed to extend due date.";
        }
    } else {
        $errorMessage = "Borrow ID or new due date is missing.";
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

  <!-- Modal for Extend or Return -->
<div id="actionModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xs">
        <h3 class="text-xl font-semibold mb-4 text-center text-gray-900">Extend or Return?</h3>
        <div class="flex justify-between">
            <button id="extendBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md">Extend</button>
            <button id="returnBtn" class="bg-green-600 text-white px-4 py-2 rounded-md">Return</button>
        </div>
    </div>
</div>

<!-- Modal for Extend -->
<div id="extendModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xs">
        <h3 class="text-xl font-semibold mb-4 text-center text-gray-900">Extend Due Date</h3>
        <form method="POST">
            <input type="hidden" name="ID" id="borrowIdExtend">
            <p><strong class="text-gray-900">Borrow ID:</strong> <span id="borrowIdExtendDisplay" class="font-medium text-gray-700"></span></p>

            <p><strong class="text-gray-900">Book Title:</strong> <span id="bookTitleExtend" class="font-medium text-gray-700"></span></p>
            <p><strong class="text-gray-900">Author:</strong> <span id="authorExtend" class="font-medium text-gray-700"></span></p>
            <p><strong class="text-gray-900">Publisher:</strong> <span id="publisherExtend" class="font-medium text-gray-700"></span></p>
            <label for="newDueDate" class="block mb-2 text-gray-900 font-bold">New Due Date:</label>
            <input type="date" id="newDueDate" name="newDueDate" class="w-full p-2 border border-gray-300 rounded-md mb-4">
            <div class="flex justify-between">
                <button type="button" id="cancelExtendBtn" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" name="extendBook" class="bg-blue-600 text-white px-4 py-2 rounded-md">OK</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for librarian Approval -->
<div id="librarianModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xs">
        <h3 class="text-xl font-semibold mb-4 text-center text-gray-900">librarian Approval</h3>
        <form action="" method="POST" id="approvalForm">
            <input type="hidden" name="ID" id="borrowId">
            <div class="mb-4">
                <p><strong class="text-gray-900">Borrow ID:</strong> <span id="borrowIdDisplay" class="font-medium text-gray-700"></span></p>
                <p><strong class="text-gray-900">Book Title:</strong> <span id="bookTitle" class="font-medium text-gray-700"></span></p>
                <p><strong class="text-gray-900">Author:</strong> <span id="author" class="font-medium text-gray-700"></span></p>
                <p><strong class="text-gray-900">Publisher:</strong> <span id="publisher" class="font-medium text-gray-700"></span></p>
                <p><strong class="text-gray-900">Borrow Date:</strong> <span id="borrowDate" class="font-medium text-gray-700"></span></p>
                <p><strong class="text-gray-900">Rating:</strong>
                    <input type="number" id="rating" name="rating" min="0" max="5" class="w-20 p-2 mt-2 border border-gray-300 rounded-md" value="">
                </p>
            </div>
            <div class="flex justify-between">
                <button type="button" id="noBtn" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" name="approve" class="bg-green-600 text-white px-4 py-2 rounded-md">Approve</button>
            </div>
        </form>
    </div>
</div>

  <script>
   // Live search functionality with event delegation
$('#searchBox').on('input', function () {
    var searchQuery = $(this).val();
    var filterType = $('#filterType').val();

    $.ajax({
        url: '', // Current page URL
        method: 'POST',
        data: { searchQuery, filterType },
        success: function (response) {
            // Update the table content
            $('#booksTableContainer').html($(response).find('#booksTableContainer').html());

            // Rebind the event listeners for the newly loaded rows
            bindRowClickEvent(); // Function to bind event listeners
        }
    });
});

// Function to bind the click event to rows
function bindRowClickEvent() {
    // Add event listener to all rows inside the table body (using event delegation)
    $('#booksTableContainer tbody tr').on('click', function () {
        var borrowId = $(this).data('id');
        var bookTitle = $(this).find('td').eq(3).text(); // Assuming Book Title is in the 4th column
        var author = $(this).find('td').eq(2).text(); // Assuming Author is in the 3rd column
        var publisher = $(this).find('td').eq(3).text(); // Adjust if necessary
        var borrowDate = $(this).find('td').eq(4).text();
        var rating = $(this).data('rating');
        var dueDate = $(this).find('td').eq(5).text();

        // Set data for modal display
        $('#borrowIdExtendDisplay').text(borrowId);
        $('#borrowId').val(borrowId);
        $('#borrowIdDisplay').text(borrowId);
        $('#bookTitle').text(bookTitle);
        $('#author').text(author);
        $('#publisher').text(publisher);
        $('#borrowDate').text(borrowDate);
        $('#rating').val(rating); // Set rating value
        $('#borrowIdExtend').val(borrowId);
        $('#bookTitleExtend').text(bookTitle);
        $('#authorExtend').text(author);
        $('#publisherExtend').text(publisher);

        // Show the action modal (extend or return)
        $('#actionModal').removeClass('hidden');
    });
}

// Initial binding when the page loads
bindRowClickEvent();
    // Show approval modal
    $('.cursor-pointer').on('click', function () {
      $('#borrowId').val($(this).data('id'));
      $('#borrowIdDisplay').text($(this).data('id'));
      $('#bookTitle').text($(this).data('rating'));
      $('#actionModal').removeClass('hidden');
    });

    // Hide modal
    $('#noBtn').on('click', function () {
      $('#actionModal').addClass('hidden');
    });
  </script>


<script>
  // Handle click event on the rows to open the action modal (Extend or Return)
  document.querySelectorAll('tr.cursor-pointer').forEach(row => {
    row.addEventListener('click', function () {
      var borrowId = this.dataset.id;
      var bookTitle = this.cells[3].innerText;
      var author = this.cells[2].innerText;
      var publisher = this.cells[3].innerText; // Assuming publisher is in the same column as title, adjust if necessary
      var borrowDate = this.cells[4].innerText;
      var rating = this.dataset.rating;
      var dueDate = this.cells[5].innerText;

      // Set the data to be displayed in the modals
      document.getElementById('borrowIdExtendDisplay').innerText = borrowId;

      document.getElementById('borrowId').value = borrowId;
      document.getElementById('borrowIdDisplay').innerText = borrowId;
      document.getElementById('bookTitle').innerText = bookTitle;
      document.getElementById('author').innerText = author;
      document.getElementById('publisher').innerText = publisher;
      document.getElementById('borrowDate').innerText = borrowDate;
      document.getElementById('rating').value = rating; // Set the rating value
      document.getElementById('borrowIdExtend').value = borrowId;
      document.getElementById('bookTitleExtend').innerText = bookTitle;
      document.getElementById('authorExtend').innerText = author;
      document.getElementById('publisherExtend').innerText = publisher;

      // Show the action modal first (Extend or Return)
      document.getElementById('actionModal').classList.remove('hidden');
    });
  });

  // Handle Extend button click (Hide action modal, show extend modal)
  document.getElementById('extendBtn').addEventListener('click', function () {
    document.getElementById('actionModal').classList.add('hidden'); // Hide action modal
    document.getElementById('extendModal').classList.remove('hidden'); // Show extend modal
  });

  // Handle Return button click (Hide action modal, show librarian modal)
  document.getElementById('returnBtn').addEventListener('click', function () {
    document.getElementById('actionModal').classList.add('hidden'); // Hide action modal
    document.getElementById('librarianModal').classList.remove('hidden'); // Show librarian modal
  });

  // Cancel Extend Modal (close extend modal)
  document.getElementById('cancelExtendBtn').addEventListener('click', function () {
    document.getElementById('extendModal').classList.add('hidden'); // Hide extend modal
  });

  // Cancel librarian Modal (close librarian modal)
  document.getElementById('noBtn').addEventListener('click', function () {
    document.getElementById('librarianModal').classList.add('hidden'); // Hide librarian modal
  });

  // Close modals if clicked outside of the modal content
  document.getElementById('actionModal').addEventListener('click', function (event) {
    if (event.target === this) {
      document.getElementById('actionModal').classList.add('hidden'); // Hide action modal
    }
  });

  document.getElementById('extendModal').addEventListener('click', function (event) {
    if (event.target === this) {
      document.getElementById('extendModal').classList.add('hidden'); // Hide extend modal
    }
  });

  document.getElementById('librarianModal').addEventListener('click', function (event) {
    if (event.target === this) {
      document.getElementById('librarianModal').classList.add('hidden'); // Hide librarian modal
    }
  });
</script>

  
</body>

</html>