<?php
// Initialize variables for messages
$message = ""; // Variable to store messages
$message_type = ""; // Variable to store message type (e.g. success, error)

// Check connection to the database
if ($conn->connect_error) {
    // If connection fails, set the error message and message type
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "danger"; // Danger type for error messages
} else {
    // Modify SQL query to fetch book information along with copies data (no pagination)
    $sql = "SELECT 
    book.book_id, 
    book.B_title, 
    book.subtitle, 
    book.author, 
    book.LCCN, 
    book.ISBN, 
    book.ISSN, 
    book.copyright, 
    book.MT, 
    book.extent,
    GROUP_CONCAT(DISTINCT coauthor.Co_Name SEPARATOR ', ') AS coauthor,  
    COUNT(CASE WHEN book_copies.status = 'Available' THEN 1 END) AS available_count,
    COUNT(book_copies.ID) AS total_count
FROM 
    book 
LEFT JOIN 
    coauthor ON book.book_id = coauthor.book_id  
LEFT JOIN 
    book_copies ON book.B_title = book_copies.B_title
GROUP BY 
    book.book_id, 
    book.B_title, 
    book.subtitle, 
    book.author, 
    book.LCCN, 
    book.ISBN, 
    book.ISSN, 
    book.copyright, 
    book.MT, 
    book.extent
ORDER BY 
    book.B_title;
";

    $result = $conn->query($sql); // Execute the query and get the result
}
?>
<style>
  #popup {
    position: absolute;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    display: none;
    /* Initially hidden */
    transition: opacity 0.2s ease;
    opacity: 0;
  }

  #popup.show {
    display: block;
    opacity: 1;
  }

  #popup.hidden {
    display: none;
    opacity: 0;
  }
</style>
<div class="my-6 px-4 flex justify-between items-center">
  <!-- Centered Search Controls -->
  <div class="flex flex-row gap-4 items-center">
    <!-- Search Input -->
    <input type="text" id="searchInput"
      class="form-input block w-40 sm:w-60 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm"
      placeholder="Enter search term...">

    <!-- Search Type Selection -->
    <select id="searchType"
      class="form-select block px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-700 text-sm">
      <option value="all">All</option>
      <option value="title">Title</option>
      <option value="author">Author</option>
      <option value="coauthor">Co-authors</option>
      <option value="lccn">LCCN</option>
      <option value="isbn">ISBN</option>
      <option value="issn">ISSN</option>
      <option value="MT">Material Type</option>
      <option value="extent">Extent</option>
    </select>
  </div>
</div>

<div class="my-6 px-4 overflow-x-auto rounded-lg shadow-md">
  <table class="min-w-full table-auto">
    <thead class="bg-gray-800 text-white overflow-x-auto rounded-lg shadow-md">
      <tr>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Author</th>
        <th class="px-4 py-2">Co-authors</th>

        <th class="px-4 py-2">Material Type</th>
        <th class="px-4 py-2">Extent</th>
        <th class="px-4 py-2">Copies</th>
      </tr>
    </thead>
    <tbody id="bookTableBody" class="bg-white">
      <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr class="border-y border-solid cursor-pointer hover:bg-gray-200"
        data-title="<?php echo htmlspecialchars($row['B_title']); ?>"
        data-author="<?php echo htmlspecialchars($row['author']); ?>"
        data-coauthor="<?php echo htmlspecialchars($row['coauthor']); ?>"
        data-lccn="<?php echo htmlspecialchars($row['LCCN']); ?>"
        data-isbn="<?php echo htmlspecialchars($row['ISBN']); ?>"
        data-issn="<?php echo htmlspecialchars($row['ISSN']); ?>"
        data-material-type="<?php echo htmlspecialchars($row['MT']); ?>"
        data-extent="<?php echo htmlspecialchars($row['extent']); ?>"
        data-available-count="<?php echo $row['available_count']; ?>"
        data-total-count="<?php echo $row['total_count']; ?>"
        data-copyright="<?php echo htmlspecialchars($row['copyright']); ?>"
        onclick="window.location.href='ViewBook.php?title=<?php echo urlencode($row['book_id']); ?>';"
        onmouseenter="showPopup(event, this)" onmouseleave="hidePopup()">


        <td class="px-4 py-2 title">
          <?php echo htmlspecialchars($row['B_title']); ?>
        </td>
        <td class="px-4 py-2 author">
          <?php echo htmlspecialchars($row['author']); ?>
        </td>
        <td class="px-4 py-2 coauthor">
          <?php echo htmlspecialchars($row['coauthor']); ?>
        </td>

        <td class="px-4 py-2 MT">
          <?php echo htmlspecialchars($row['MT']); ?>
        </td>
        <td class="px-4 py-2 extent">
          <?php echo htmlspecialchars($row['extent']); ?>
        </td>
        <td class="px-4 py-2 flex justify-center gap-2">
          <?php if ($row['available_count'] > 0): ?>
          <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
            ✔
          </div>
          <?php else: ?>
          <div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center">
            ✖
          </div>
          <?php endif; ?>
        </td>
      </tr>
      <?php endwhile; ?>
      <?php else: ?>
      <tr>
        <td colspan="9" class="text-center py-4">No books found.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Popup Container -->
<div id="popup" class="hidden bg-white p-4 border shadow-lg rounded-lg z-50"></div>

<div class="pagination-controls flex justify-center items-center space-x-4 my-6 flex-col md:flex-row md:space-x-6">
  <button id="prevBtn" onclick="prevPage()"
    class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-300 hover:bg-gray-600"
    disabled>Previous</button>
  <span id="pageInfo" class="text-lg text-gray-600 font-medium">Page 1 of X</span> <!-- Placeholder for page info -->
  <button id="nextBtn" onclick="nextPage()"
    class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer transition duration-300 hover:bg-gray-600">Next</button>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript to filter the table based on search input and search type -->
  <script>
    $(document).ready(function () {
      // Event listener for input changes
      $('#searchInput').on('keyup', filterTable); // Trigger filter on keyup in search input
      $('#searchType').on('change', filterTable); // Trigger filter on change in search type

      function filterTable() {
        // Get selected search type
        const searchType = $('#searchType').val();
        // Get the search text in lowercase for case-insensitive comparison
        const searchText = $('#searchInput').val().toLowerCase();

        // Filter the table rows
        $('#bookTableBody tr').filter(function () {
          // Get the text values of the current row
          const rowTitle = $(this).find('.title').text().toLowerCase();
          const rowAuthor = $(this).find('.author').text().toLowerCase();
          const rowbooks = $(this).find('.coauthor').text().toLowerCase();
          const rowLCCN = $(this).find('.lccn').text().toLowerCase();
          const rowISBN = $(this).find('.isbn').text().toLowerCase();
          const rowISSN = $(this).find('.issn').text().toLowerCase();
          const rowMT = $(this).find('.MT').text().toLowerCase();
          const rowExtent = $(this).find('.extent').text().toLowerCase();

          // Initialize match variable
          let matchSearchType = false;

          // Matching based on search type
          switch (searchType) {
            case 'all':
              matchSearchType = rowTitle.indexOf(searchText) > -1 ||
                rowAuthor.indexOf(searchText) > -1 ||
                rowbooks.indexOf(searchText) > -1 ||
                rowLCCN.indexOf(searchText) > -1 ||
                rowISBN.indexOf(searchText) > -1 ||
                rowISSN.indexOf(searchText) > -1 ||
                rowMT.indexOf(searchText) > -1 ||
                rowExtent.indexOf(searchText) > -1;
              break;
            case 'title':
              matchSearchType = rowTitle.indexOf(searchText) > -1;
              break;
            case 'author':
              matchSearchType = rowAuthor.indexOf(searchText) > -1;
              break;
            case 'coauthor':
              matchSearchType = rowbooks.indexOf(searchText) > -1;
              break;
            case 'lccn':
              matchSearchType = rowLCCN.indexOf(searchText) > -1;
              break;
            case 'isbn':
              matchSearchType = rowISBN.indexOf(searchText) > -1;
              break;
            case 'issn':
              matchSearchType = rowISSN.indexOf(searchText) > -1;
              break;
            case 'MT':
              matchSearchType = rowMT.indexOf(searchText) > -1;
              break;
            case 'extent':
              matchSearchType = rowExtent.indexOf(searchText) > -1;
              break;
          }

          // Toggle row visibility based on match
          $(this).toggle(matchSearchType);
        });
      }
    });
  </script>

  <script>
    let popupTimeout;

    // Show the popup when hovering over a row
    function showPopup(event, row) {
      // Clear any previous timeout to prevent multiple popups
      clearTimeout(popupTimeout);

      // Delay showing the popup to avoid flickering
      popupTimeout = setTimeout(function () {
        var popup = document.getElementById('popup');

        // Retrieve data from row attributes
        var title = row.getAttribute('data-title');
        var author = row.getAttribute('data-author');
        var coauthor = row.getAttribute('data-coauthor');
        var lccn = row.getAttribute('data-lccn');
        var isbn = row.getAttribute('data-isbn');
        var issn = row.getAttribute('data-issn');
        var materialType = row.getAttribute('data-material-type');
        var extent = row.getAttribute('data-extent');
        var copyright = row.getAttribute('data-copyright');
        var availableCount = row.getAttribute('data-available-count');
        var totalCount = row.getAttribute('data-total-count');

        // Populate popup content
        popup.innerHTML = `
            <strong>Title:</strong> ${title}<br>
            <strong>Author:</strong> ${author}<br>
            <strong>Co-authors:</strong> ${coauthor || 'N/A'}<br>
            <strong>LCCN:</strong> ${lccn || 'N/A'}<br>
            <strong>ISBN:</strong> ${isbn || 'N/A'}<br>
            <strong>ISSN:</strong> ${issn || 'N/A'}<br>
            <strong>Material Type:</strong> ${materialType || 'N/A'}<br>
            <strong>Extent:</strong> ${extent || 'N/A'}<br>
            <strong>Copyright:</strong> ${copyright || 'N/A'}<br>
            <strong>Available/Total:</strong> ${availableCount}/${totalCount}
        `;

        // Position the popup near the mouse cursor
        var popupWidth = popup.offsetWidth;
        var popupHeight = popup.offsetHeight;
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;

        var popupX = event.pageX + 15;
        var popupY = event.pageY + 15;

        // Prevent the popup from going out of the screen on the right or bottom
        if (popupX + popupWidth > windowWidth) {
          popupX = windowWidth - popupWidth - 15;
        }

        if (popupY + popupHeight > windowHeight) {
          popupY = windowHeight - popupHeight - 15;
        }

        // Set position of the popup
        popup.style.left = popupX + 'px';
        popup.style.top = popupY + 'px';

        // Show the popup
        popup.classList.remove('hidden');
        popup.classList.add('show');
      }, 500); // Delay of 500ms before showing the popup
    }

    // Hide the popup when the mouse leaves the row
    function hidePopup() {
      var popup = document.getElementById('popup');
      popup.classList.remove('show');
      popup.classList.add('hidden');
    }

    // Adding event listeners for mouse enter and leave
    $(document).ready(function () {
      // When mouse enters a table row
      $('#bookTableBody tr').on('mouseenter', function (event) {
        showPopup(event, this);
      });

      // When mouse leaves a table row
      $('#bookTableBody tr').on('mouseleave', function () {
        hidePopup();
      });

      // Ensure the popup is hidden if mouse is outside the table
      $(document).on('mousemove', function (event) {
        var popup = document.getElementById('popup');
        var table = document.getElementById('bookTableBody');
        var isMouseInTable = table.contains(event.target);
        var isMouseInPopup = popup.contains(event.target);

        if (!isMouseInTable && !isMouseInPopup) {
          hidePopup();
        }
      });
    });


  </script>

  <script>

    let currentPage = 1;
    const rowsPerPage = 10; // Number of rows per page

    function displayTablePage(page) {
      const rows = document.querySelectorAll("#bookTableBody tr");
      const totalPages = Math.ceil(rows.length / rowsPerPage);

      if (page < 1) page = 1;
      if (page > totalPages) page = totalPages;

      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      rows.forEach((row, index) => {
        if (index >= start && index < end) {
          row.style.display = ""; // Show the row
        } else {
          row.style.display = "none"; // Hide the row
        }
      });

      document.getElementById("pageInfo").innerText = `Page ${page} of ${totalPages}`;
      updatePageControls(page, totalPages); // Update page control buttons
    }

    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        displayTablePage(currentPage);
      }
    }

    function nextPage() {
      const rows = document.querySelectorAll("#bookTableBody tr");
      const totalPages = Math.ceil(rows.length / rowsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        displayTablePage(currentPage);
      }
    }

    function updatePageControls(page, totalPages) {
      document.getElementById("prevBtn").disabled = page === 1;
      document.getElementById("nextBtn").disabled = page === totalPages;
    }

    // Call this on page load to initialize the table view
    document.addEventListener("DOMContentLoaded", function () {
      displayTablePage(currentPage);
    });

  </script>

  </body>