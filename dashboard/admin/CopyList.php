<?php
include '../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the URL (filtering by title)
$book_title = isset($_GET['title']) ? $_GET['title'] : '';

// Initialize the SQL query
$sql = "SELECT * FROM book_copies WHERE status IS NOT NULL"; // Exclude NULL statuses by default

// If a specific book title is set, filter by book_id
if (!empty($book_title)) {
    $sql .= " AND book_id = ?";
}

$stmt = $conn->prepare($sql);

if (!empty($book_title)) {
    $stmt->bind_param("s", $book_title);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    $message = "Error retrieving books: " . $conn->error;
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLMs</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow">
            <!-- Header at the Top -->
            <?php include 'include/header.php'; ?>

            <div class="container mx-auto px-4 py-6">
                <h2 class="text-2xl font-semibold mb-4">Book List</h2>

                <?php if ($message): ?>
                <div
                  class="mb-4 p-4 <?php echo $message_type == 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'; ?> rounded">
                  <?php echo htmlspecialchars($message); ?>
                </div>
                <?php endif; ?>

                <!-- Search Input -->
                <div class="mb-4">
                    <input
                        type="text"
                        id="searchInput"
                        class="w-full py-2 px-4 border rounded-md"
                        placeholder="Search by Book Title or ID..."
                        onkeyup="searchBooks()"
                    />
                </div>

                <!-- Filter Buttons -->
                <div class="mb-4">
                    <button id="allBtn" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" onclick="filterBooks('All')">All</button>
                    <button id="availableBtn" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600" onclick="filterBooks('Available')">Available</button>
                    <button id="borrowedBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600" onclick="filterBooks('Borrowed')">Borrowed</button>
                </div>

                <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4 border-b">BOOK ID</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Title</th>
                            <th class="py-2 px-4 border-b">Rating</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody id="bookTableBody">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $statusClass = htmlspecialchars($row['status']) == 'Available' ? 'available' : 'borrowed';
                                echo "<tr class='book-row border-b hover:bg-gray-50 {$statusClass}' data-title='" . htmlspecialchars($row['B_title']) . "' data-id='" . htmlspecialchars($row['book_copy']) . "' data-status='" . htmlspecialchars($row['status']) . "'>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['book_copy']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['status']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['B_title']) . "</td>
                                    <td class='py-2 px-4'>";

                                // Display ratings dynamically
                                $rating = (int) $row['rating'];
                                $maxStars = 1; // Only one star to display

                                for ($i = 1; $i <= $maxStars; $i++) {
                                    if ($rating === 0) {
                                        echo '<span class="text-gray-400 text-lg inline-block">&#9733;</span>';
                                    } else {
                                        $color = match ($rating) {
                                            5 => 'text-green-500',
                                            4 => 'text-blue-500',
                                            3 => 'text-yellow-400',
                                            2 => 'text-orange-500',
                                            1 => 'text-red-500',
                                            default => 'text-gray-400',
                                        };
                                        echo "<span class='{$color} text-lg'>&#9733;</span>";
                                    }
                                }

                                echo "</td>
                                    <td class='py-2 px-4'>
                                        <a href='viewcopyList.php?book_copy_ID=" . urlencode($row['book_copy_ID']) . "' class='bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600'>View</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='py-2 px-4 text-center'>No books available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Footer at the Bottom -->
            <footer class="bg-blue-600 text-white mt-auto">
                <?php include 'include/footer.php'; ?>
            </footer>
        </div>
    </main>

    <script>
        function searchBooks() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.book-row');

            rows.forEach(row => {
                const title = row.getAttribute('data-title').toLowerCase();
                const id = row.getAttribute('data-id').toLowerCase();
                if (title.includes(searchValue) || id.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterBooks(status) {
            const rows = document.querySelectorAll('.book-row');
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'All') {
                    row.style.display = '';
                } else if (rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Track the current filter state globally
let currentFilter = 'All';

// Function to filter books based on status
function filterBooks(status) {
    currentFilter = status; // Update the current filter state
    const rows = document.querySelectorAll('.book-row');

    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        if (status === 'All' || rowStatus === status) {
            row.style.display = ''; // Show rows matching the filter
        } else {
            row.style.display = 'none'; // Hide rows not matching the filter
        }
    });

    // Trigger search to reapply search filtering
    searchBooks();
}

// Function to search books based on title or ID
function searchBooks() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.book-row');

    rows.forEach(row => {
        const title = row.getAttribute('data-title').toLowerCase();
        const id = row.getAttribute('data-id').toLowerCase();
        const rowStatus = row.getAttribute('data-status');

        // Show rows that match the search and the current filter
        if (
            (currentFilter === 'All' || rowStatus === currentFilter) &&
            (title.includes(searchValue) || id.includes(searchValue))
        ) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

    </script>

</body>
</html>
