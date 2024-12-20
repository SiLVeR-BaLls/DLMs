<?php
  // Initialize the query
  $usersQuery = "
      SELECT users_info.IDno,
          users_info.Fname,
          users_info.Sname, 
          user_details.course, 
          user_details.college, 
          user_details.yrLVL AS year,
          user_log.U_Type
      FROM users_info
      JOIN user_details ON users_info.IDno = user_details.IDno
      JOIN user_log ON users_info.IDno = user_log.IDno
      WHERE user_log.status = 'approved'";

  // Apply U_Type filter if selected
  if (isset($_GET['U_Type']) && !empty($_GET['U_Type'])) {
      $U_Type = mysqli_real_escape_string($conn, $_GET['U_Type']);
      $usersQuery .= " AND user_log.U_Type = '$U_Type'";
  }

  // Fetch users without pagination (no LIMIT clause)
  $usersResult = mysqli_query($conn, $usersQuery);

  // Handle delete request
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
      // Handle delete logic here (make sure to execute the delete query and return success or failure response)
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
  --container_width: 450px; /* Adjusted width for the content */
  position: relative;
  display: flex;
  align-items: center;
  border-radius: 10px;
  background-color: #F4F4F4; /* Alabaster background for inactive state */
  color: #000;
  width: var(--container_width);
  overflow: hidden;
  border: 2px solid #F4F4F4; /* Alabaster border for inactive state */
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
  color: #000; /* Default text color */
  transition: all 0.3s ease;
}

/* Hover Effect */
.radio-input label:hover {
  background-color: #93C5FD; /* Blue-300 on hover */
}

.selection {
  display: none;
  position: absolute;
  height: 100%;
  width: calc(var(--container_width) / 5); /* Adjust for 5 options */
  z-index: 0;
  left: 0;
  top: 0;
  background-color: #F4F4F4; /* Alabaster background for inactive state */
  transition: 0.15s ease;
}

/* Active (selected) state - Blue-600 */
.radio-input label:has(input:checked) {
  background-color: #1D4ED8; /* Blue-600 background when selected */
  color: #fff; /* White text color when selected */
}

.radio-input label:has(input:checked) ~ .selection {
  display: inline-block;
  background-color: #1D4ED8; /* Blue-600 for active state */
}

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
        <!-- Search input comes first, then the dropdown -->
        <input type="text" id="searchInput" placeholder="Search..."
          class="border border-gray-300 rounded px-4 py-2 w-full">
        <select id="searchCategory" class="border border-gray-300 rounded px-4 py-2">
          <option value="IDno">IDno</option>
          <option value="Fname">First Name</option>
          <option value="Sname">Last Name</option>
          <option value="course">Course</option>
          <option value="college">College</option>
          <option value="year">Year</option>
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
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">College</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
          <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
          <tr class="user-row" data-user-type="<?php echo htmlspecialchars($row['U_Type']); ?>">
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['IDno']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['Fname']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['Sname']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['course']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['year']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap">
              <?php echo htmlspecialchars($row['college']); ?>
            </td>
            <td class="px-4 py-2 whitespace-nowrap flex space-x-2">
              <a href="include/user_details.php?id=<?php echo htmlspecialchars($row['IDno']); ?>"
                class="bg-blue-500 text-white px-3 py-1 rounded text-sm">View</a>
              <button class="bg-red-500 text-white px-3 py-1 rounded text-sm"
                onclick="deleteUser('<?php echo htmlspecialchars($row['IDno']); ?>')">Delete</button>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="pagination-controls flex justify-center items-center space-x-4 mt-6 flex-col md:flex-row md:space-x-6">
      <button id="prevBtn" onclick="prevPage()" class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-300 hover:bg-gray-600" disabled>Previous</button>
      <span id="pageInfo" class="text-lg text-gray-600 font-medium">Page 1 of X</span>  <!-- Placeholder for page info -->
      <button id="nextBtn" onclick="nextPage()" class="btn-pagination px-6 py-2 bg-gray-800 text-white rounded-lg cursor-pointer transition duration-300 hover:bg-gray-600">Next</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

<script>
document.querySelectorAll('input[name="userType"]').forEach(function (radio) {
    radio.addEventListener('click', function () {
        // Check if this radio button is already checked
        if (this.checked) {
            // If the clicked radio is already checked, uncheck all
            document.querySelectorAll('input[name="userType"]').forEach(function (r) {
                r.checked = false;
            });
            // Manually trigger the change event so that we can react to it
            this.checked = true;
        } else {
            // If not checked, do nothing (we won't uncheck an active radio)
            this.checked = false;
        }
        // Trigger the change event manually after the state change
        this.dispatchEvent(new Event('change'));
    });
});


// Function to handle filter change and update table rows dynamically
document.querySelectorAll('input[name="userType"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        const userType = this.value;
        const rows = document.querySelectorAll('.user-row');
        
        // If "All" is selected, show all rows
        if (userType === "all") {
            rows.forEach(row => row.style.display = "");
            return;
        }
        
        // Otherwise, filter rows based on the selected user type
        rows.forEach(row => {
            const rowType = row.getAttribute('data-user-type');
            if (rowType === userType) {
                row.style.display = "";  // Show matching rows
            } else {
                row.style.display = "none";  // Hide non-matching rows
            }
        });
    });
});


    // Handle the deletion of a user
    function deleteUser(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('action=delete&id=' + encodeURIComponent(id));

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal("Deleted!", "User has been deleted successfully.", "success")
                            .then(() => {
                                location.reload(true);  // Reload the page after deletion
                            });
                        } else {
                            swal("Error!", response.message, "error");
                        }
                    } else {
                        swal("Error!", "Error: " + xhr.status, "error");
                    }
                };
            }
        });
    }

    // JavaScript for enhanced search functionality
    document.getElementById('searchInput').addEventListener('keyup', function () {
      var filter = this.value.toLowerCase();
      var category = document.getElementById('searchCategory').value;
      var rows = document.querySelectorAll('#tableBody tr');

      rows.forEach(function (row) {
        var cellValue = row.querySelector(`td:nth-child(${getColumnIndex(category)})`).innerText.toLowerCase();
        row.style.display = cellValue.includes(filter) ? '' : 'none';
      });
    });

    // Function to get the column index based on the selected category
    function getColumnIndex(category) {
      switch (category) {
        case 'IDno': return 1;
        case 'Fname': return 2;
        case 'Sname': return 3;
        case 'course': return 4;
        case 'year': return 5;
        case 'college': return 6;
        default: return 1;
      }
    }

    let currentPage = 1;
    const rowsPerPage = 10; // Number of rows per page

    function displayTablePage(page) {
        const table = document.getElementById("usersTable");
        const rows = table.getElementsByTagName("tr");
        const totalPages = Math.ceil((rows.length - 1) / rowsPerPage); // Adjust for table header row
        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
            rows[i].style.display = (i > page * rowsPerPage || i <= (page - 1) * rowsPerPage) ? "none" : "";
        }
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
        const totalPages = Math.ceil((document.getElementById("usersTable").getElementsByTagName("tr").length - 1) / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayTablePage(currentPage);
        }
    }

    function updatePageControls(page, totalPages) {
        // Enable or disable the "Previous" and "Next" buttons based on the current page
        document.getElementById("prevBtn").disabled = page === 1;
        document.getElementById("nextBtn").disabled = page === totalPages;
    }

    // Call this on page load to initialize the table view
    document.addEventListener("DOMContentLoaded", function() {
        displayTablePage(currentPage);
    });
</script>
