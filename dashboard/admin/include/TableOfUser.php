<?php
// Set the number of results per page
$resultsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $resultsPerPage;

// Initialize the query
$usersQuery = "
    SELECT users_info.IDno,
           users_info.Fname,
           users_info.Sname, 
           user_details.course, 
           user_details.college, 
           user_details.yrLVL AS year,
           user_log.U_type
    FROM users_info
    JOIN user_details ON users_info.IDno = user_details.IDno
    JOIN user_log ON users_info.IDno = user_log.IDno
    WHERE user_log.status = 'approved'";

// Apply U_type filter if selected
if (isset($_GET['U_type']) && !empty($_GET['U_type'])) {
    $U_type = mysqli_real_escape_string($conn, $_GET['U_type']);
    $usersQuery .= " AND user_log.U_type = '$U_type'";
}

// Add pagination
$usersQuery .= " LIMIT $start, $resultsPerPage";

// Fetch users
$usersResult = mysqli_query($conn, $usersQuery);

// Count total records to calculate total pages
$totalResults = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM users_info
    JOIN user_details ON users_info.IDno = user_details.IDno
    JOIN user_log ON users_info.IDno = user_log.IDno
    WHERE user_log.status = 'approved'");

$totalRows = mysqli_fetch_assoc($totalResults)['total'];
$totalPages = ceil($totalRows / $resultsPerPage);

// Handle delete request (same as above)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    // ... handle delete logic here ...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">User Management</h2>

    <!-- U_type Filter Buttons -->
    <div class="flex justify-center items-center mb-4">
        <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3 justify-center">
            <button id="studentFilter" class="px-1 py-2 border border-gray-300 rounded bg-blue-500 text-white">Student</button>
            <button id="adminFilter" class="px-1 py-2 border border-gray-300 rounded bg-blue-500 text-white">Admin</button>
            <button id="professorFilter" class="px-1 py-2 border border-gray-300 rounded bg-blue-500 text-white">Professor</button>
            <button id="staffFilter" class="px-1 py-2 border border-gray-300 rounded bg-blue-500 text-white">Staff</button>
            <button id="clearFilter" class="px-1 py-2 border border-gray-300 rounded bg-gray-500 text-white">Clear Filter</button>
        </div>
    </div>

    <!-- Search Bar with Centered and Reversed Order -->
    <div class="flex justify-center items-center mb-4">
        <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3 justify-center">
            <!-- Search input comes first, then the dropdown -->
            <input type="text" id="searchInput" placeholder="Search..." class="border border-gray-300 rounded px-4 py-2 w-full">
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
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['IDno']); ?></td>
                        <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['Fname']); ?></td>
                        <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['Sname']); ?></td>
                        <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['course']); ?></td>
                        <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($row['year']); ?></td>
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

    <!-- Pagination Controls -->
    <div class="flex justify-center items-center mt-4 space-x-2">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 bg-gray-200 rounded">Previous</a>
        <?php endif; ?>
        <span class="px-4 py-2 text-gray-700">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 bg-gray-200 rounded">Next</a>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

<script>
    // JavaScript function to handle deletion
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

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            swal("Deleted!", "User has been deleted successfully.", "success")
                            .then(() => {
                                location.reload(true);
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

    // Handle filter buttons
    document.getElementById('studentFilter').addEventListener('click', () => filterByType('Student'));
    document.getElementById('adminFilter').addEventListener('click', () => filterByType('Admin'));
    document.getElementById('professorFilter').addEventListener('click', () => filterByType('Professor'));
    document.getElementById('staffFilter').addEventListener('click', () => filterByType('Staff'));
    document.getElementById('clearFilter').addEventListener('click', () => window.location.href = window.location.pathname);

    function filterByType(type) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('U_type', type);
        window.location.href = currentUrl.toString();
    }

     // JavaScript for enhanced search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var filter = this.value.toLowerCase();
        var category = document.getElementById('searchCategory').value;
        var rows = document.querySelectorAll('#tableBody tr');
        
        rows.forEach(function(row) {
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
</script>

</body>
</html>
