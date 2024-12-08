<?php
include '../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the book title from the URL (filtering by title)
$book_title = isset($_GET['title']) ? $_GET['title'] : '';

// Use prepared statements to fetch filtered book copies
$sql = "SELECT * FROM book_copies";
if (!empty($book_title)) {
    $sql .= " WHERE B_title = ?";
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

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- BrowseBook Content and Footer Section -->
        <div class="flex-grow">
            <div class="container mx-auto p-4 pt-6 mt-6">
                <h2 class="text-2xl font-semibold mb-4">Book List</h2>
                <a href="ViewBook.php?title=<?php echo urlencode($book_title); ?>" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-3">List</a>
                <?php if ($message): ?>
                <div class="mb-4 p-4 <?php echo $message_type == 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'; ?> rounded">
                    <?php echo htmlspecialchars($message); ?>
                </div>
                <?php endif; ?>

                <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Title</th>
                            <th class="py-2 px-4 border-b">Copy ID</th>
                            <th class="py-2 px-4 border-b">Call Number</th>
                            <th class="py-2 px-4 border-b">Vendor</th>
                            <th class="py-2 px-4 border-b">Funding Source</th>
                            <th class="py-2 px-4 border-b">Sublocation</th>
                            <th class="py-2 px-4 border-b">Note</th>
                            <th class="py-2 px-4 border-b">Rating</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='border-b hover:bg-gray-50'>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['ID']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['status']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['B_title']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['copy_ID']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['callNumber']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['vendor']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['fundingSource']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['Sublocation']) . "</td>
                                    <td class='py-2 px-4'>" . htmlspecialchars($row['note']) . "</td>
                                    <td class='py-2 px-4'>";
                                // Display ratings dynamically
                              // Display ratings dynamically
$rating = (int) $row['rating'];
$maxStars = 1; // Only one star to display

for ($i = 1; $i <= $maxStars; $i++) {
    if ($rating === 0) {
        // Empty border if rating is 0
        echo '<span class="text-gray-400 text-lg inline-block">&#9733;</span>';
    } else {
        // Dynamic color based on rating value
        $color = match ($rating) {
            5 => 'text-green-500',  // Green for 5 stars
            4 => 'text-blue-500',   // Blue for 4 stars
            3 => 'text-yellow-400', // Yellow for 3 stars
            2 => 'text-orange-500', // Orange for 2 stars
            1 => 'text-red-500',    // Red for 1 star
            default => 'text-gray-400', // Gray for no rating
        };
        echo "<span class='{$color} text-lg'>&#9733;</span>";
    }
}

                                echo "</td>
                                    <td class='py-2 px-4'>
                                        <a href='ViewCopy.php?ID=" . urlencode($row['ID']) . "' class='bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600'>View</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11' class='py-2 px-4 text-center'>No books available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Footer at the Bottom -->
            <footer class="bg-blue-600 text-white p-4 mt-auto">
                <?php include 'include/footer.php'; ?>
            </footer>
        </div>
    </main>

    <script>
        // Check if the page has already been refreshed
        if (!sessionStorage.getItem('hasRefreshed')) {
            // Set the 'hasRefreshed' flag before the page reload
            sessionStorage.setItem('hasRefreshed', 'true');

            // Reload the page after a short delay (1 second)
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    </script>
</body>

</html>