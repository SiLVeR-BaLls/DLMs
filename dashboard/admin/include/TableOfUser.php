<?php
  // Initialize the query
  $usersQuery = "
      SELECT *
      FROM users_info
      WHERE users_info.status_log = 'approved'";

  // Apply U_Type filter if selected
  if (isset($_GET['U_Type']) && !empty($_GET['U_Type'])) {
      $U_Type = mysqli_real_escape_string($conn, $_GET['U_Type']);
      $usersQuery .= " AND users_info.U_Type = '$U_Type'";
  }

  // Fetch users without pagination (no LIMIT clause)
  $usersResult = mysqli_query($conn, $usersQuery);

  // Handle delete request
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
      $id = $_POST['id'];
      $deleteQuery = "DELETE FROM users_info WHERE IDno = '$id'";
      $deleteResult = mysqli_query($conn, $deleteQuery);
      
      if ($deleteResult) {
          echo json_encode(['success' => true]);
      } else {
          echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
      }
      exit;
  }
?>
<style>
  .radio-input input {
    display: none;
  }

  .radio-input {
    --container_width: 450px;
    position: relative;
    display: flex;
    align-items: center;
    border-radius: 10px;
    background-color: #F4F4F4;
    color: #000;
    width: var(--container_width);
    overflow: hidden;
    border: 2px solid #F4F4F4;
  }

  .radio-input label {
    width: 100%;
    padding: 10px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
    font-weight: 600;
    letter-spacing: -1px;
    font-size: 14px;
    color: #000;
    transition: all 0.3s ease;
  }

  /* Hover Effect */
  .radio-input label:hover {
    background-color: #93C5FD;
  }

  .selection {
    display: none;
    position: absolute;
    height: 100%;
    width: calc(var(--container_width) / 5);
    z-index: 0;
    left: 0;
    top: 0;
    background-color: #F4F4F4;
    transition: 0.15s ease;
  }

  /* Active (selected) state */
  .radio-input label:has(input:checked) {
    background-color: #1D4ED8;
    color: #fff;
  }

  .radio-input label:has(input:checked) ~ .selection {
    display: inline-block;
    background-color: #1D4ED8;
  }

  /* Active state for each label */
  .radio-input label:nth-child(1):has(input:checked) ~ .selection {
    transform: translateX(calc(var(--container_width) * 0 / 5));
  }

  .radio-input label:nth-child(2):has(input:checked) ~ .selection {
    transform: translateX(calc(var(--container_width) * 1 / 5));
  }

  .radio-input label:nth-child(3):has(input:checked) ~ .selection {
    transform: translateX(calc(var(--container_width) * 2 / 5));
  }

  .radio-input label:nth-child(4):has(input:checked) ~ .selection {
    transform: translateX(calc(var(--container_width) * 3 / 5));
  }

  .radio-input label:nth-child(5):has(input:checked) ~ .selection {
    transform: translateX(calc(var(--container_width) * 4 / 5));
  }

</style>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">User Management</h2>

    <!-- Search Bar with Centered and Reversed Order -->
    <div class="flex justify-center items-center mb-4">
      <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3 justify-center">
        <input type="text" id="searchInput" placeholder="Search..." class="border border-gray-300 rounded px-4 py-2 w-full">
        <select id="searchCategory" class="border border-gray-300 rounded px-4 py-2">
          <option value="IDno">IDno</option>
          <option value="Fname">First Name</option>
          <option value="Sname">Last Name</option>
          <option value="course">Course</option>
          <option value="college">College</option>
          <option value="yrLVL">Year</option>
        </select>
      </div>
    </div>

    <!-- Filter Bar with U_Type filter using radio buttons -->
    <div class="flex justify-center items-center mb-4 space-x-6">
      <div class="radio-input">
        <label>
          <input value="all" name="userType" id="allRadio" type="radio" checked />
          <span>All</span>
        </label>
        <label>
          <input value="admin" name="userType" id="adminRadio" type="radio" />
          <span>Admin</span>
        </label>
        <label>
          <input value="student" name="userType" id="studentRadio" type="radio" />
          <span>Student</span>
        </label>
        <label>
          <input value="librarian" name="userType" id="librarianRadio" type="radio" />
          <span>Librarian</span>
        </label>
        <label>
          <input value="faculty" name="userType" id="facultyRadio" type="radio" />
          <span>Faculty</span>
        </label>
        <span class="selection"></span>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table id="usersTable" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IDno</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">U_Type</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">College</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
          <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
          <tr class="user-row" data-user-type="<?php echo htmlspecialchars($row['U_Type']); ?>">
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['IDno']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['Fname']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['Sname']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['course']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['U_Type']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['yrLVL']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['college']); ?></td>
            <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
              <a href="include/user_details.php?id=<?php echo htmlspecialchars($row['IDno']); ?>" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">View</a>
              <button class="bg-red-500 text-white px-3 py-1 rounded text-sm" onclick="deleteUser('<?php echo htmlspecialchars($row['IDno']); ?>')">Delete</button>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
</div>

<div class="pagination-controls flex justify-center items-center space-x-4 mt-6 flex-col md:flex-row md:space-x-6">
      <button id="prevBtn" onclick="prevPage()" class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-300 hover:bg-gray-600" disabled>Previous</button>
      <span id="pageInfo" class="text-lg text-gray-600 font-medium">Page 1 of X</span>  <!-- Placeholder for page info -->
      <button id="nextBtn" onclick="nextPage()" class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer transition duration-300 hover:bg-gray-600">Next</button>
    </div>


    <script>
// JavaScript for managing search and pagination

let currentPage = 1;
const rowsPerPage = 10; // Number of rows per page
let filteredRows = [];  // Holds the filtered rows after applying both userType filter and search filter

// Handle UserType filter changes
document.querySelectorAll('input[name="userType"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        const userType = this.value;  // Get the selected user type value
        
        // Save the selected userType in localStorage
        localStorage.setItem('selectedUserType', userType);

        // Apply the filter immediately to the rows
        filterRows();
    });
});

// Handle search input and category filter
document.getElementById('searchInput').addEventListener('input', filterRows);
document.getElementById('searchCategory').addEventListener('change', filterRows);

// Function to apply the filter to the rows based on userType and search term
function filterRows() {
    const userType = document.querySelector('input[name="userType"]:checked').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const searchCategory = document.getElementById('searchCategory').value;

    const rows = document.querySelectorAll('.user-row');
    filteredRows = [];

    rows.forEach(row => {
        const rowType = row.getAttribute('data-user-type');
        const rowData = row.querySelectorAll('td');
        const searchValue = rowData[getSearchCategoryIndex(searchCategory)].innerText.toLowerCase();

        // Apply userType and search term filter
        if ((userType === 'all' || rowType === userType) && searchValue.includes(searchTerm)) {
            row.style.display = "";  // Show matching rows
            filteredRows.push(row);  // Add to the filtered list
        } else {
            row.style.display = "none";  // Hide non-matching rows
        }
    });

    // Update pagination with filtered rows
    updatePagination();
}

// Get the index of the selected search category
function getSearchCategoryIndex(category) {
    switch (category) {
        case 'IDno': return 0;
        case 'Fname': return 1;
        case 'Sname': return 2;
        case 'course': return 3;
        case 'college': return 4;
        case 'yrLVL': return 5;
        default: return 0;
    }
}

// Function to update pagination based on filtered rows
function updatePagination() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage); // Adjust for filtered rows
    if (currentPage < 1) currentPage = 1;
    if (currentPage > totalPages) currentPage = totalPages;

    // Hide all rows and then display the appropriate ones for the current page
    filteredRows.forEach((row, index) => {
        row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? "" : "none";
    });

    // Update page info text
    document.getElementById("pageInfo").innerText = `Page ${currentPage} of ${totalPages}`;
    updatePageControls(); // Update page control buttons
}

// Function to go to the previous page
function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        updatePagination();
    }
}

// Function to go to the next page
function nextPage() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
    }
}

// Function to update the pagination controls (Previous, Next)
function updatePageControls() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    document.getElementById("prevBtn").disabled = currentPage === 1;
    document.getElementById("nextBtn").disabled = currentPage === totalPages;
}

// On page load, apply the saved filter from localStorage
window.addEventListener('DOMContentLoaded', function () {
    const savedUserType = localStorage.getItem('selectedUserType') || 'all';
    document.querySelector(`#${savedUserType}Radio`).checked = true;

    // Apply the filter to the rows based on the saved userType
    filterRows();
});

// Call this on page load to initialize the table view
document.addEventListener("DOMContentLoaded", function() {
    updatePagination();  // Initialize the table with current page and filter
});
</script>
