<?php
include '../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the copy ID from the URL
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM book_copies WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    $message = "Error retrieving copy details: " . $conn->error;
    $message_type = "danger"; // Bootstrap class for error
} elseif ($result->num_rows == 0) {
    $message = "No copy found with the specified ID.";
    $message_type = "warning"; // Bootstrap class for warning
    $copy_data = [];
} else {
    $copy_data = $result->fetch_assoc();
}

$stmt->close();
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
            <!-- BrowseBook Content Section -->
            <div class="p-8">
                <!-- Return to Copy Details button with both B_title and ID in the query string -->
                <a href="BookList.php?title=<?php echo urlencode($copy_data['B_title']); ?>&ID=<?php echo urlencode($copy_data['ID']); ?>"
                    class="bg-gray-500 text-white py-2 px-6 rounded-md hover:bg-gray-600 mb-8 inline-block">
                    Return to Copy Details
                </a>
                <h2 class="text-3xl font-bold text-center mb-8">Book Copy Details</h2>

                <!-- Display message if exists -->
                <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?> p-4 rounded-md mb-6">
                    <?php echo htmlspecialchars($message); ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($copy_data)): ?>
                <div class="book-page p-6 bg-yellow-50 border-4 border-gray-200 rounded-xl shadow-inner">
                    <!-- Two-column Layout for Copy Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Column 1: Book Details -->
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="font-semibold text-lg w-32">ID:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['ID']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Title:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['B_title']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Copy ID:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['copy_ID']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Call Number:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['callNumber']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Status:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['status']); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Additional Details -->
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Vendor:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['vendor']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Funding Source:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['fundingSource']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Sublocation:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php echo htmlspecialchars($copy_data['Sublocation']); ?>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="font-semibold text-lg w-32">Rating:</div>
                                <div class="text-gray-700 flex-grow">
                                    <?php
                                    // Get the rating value from the database
                                    $rating = (int) $copy_data['rating'];

                                    // Display a star depending on the rating value
                                    if ($rating == 0) {
                                        // Show broken star (not glowing)
                                        echo '<span class="text-gray-400">&#9734;</span>'; // Broken star
                                    } else {
                                        // Display glowing stars for rating > 0
                                        echo '<span class="text-yellow-400">&#9733;</span>'; // Glowing star
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit and Delete Buttons -->
                <div class="mt-8 flex justify-between">
                    <a href="include/edit_copy.php?ID=<?php echo urlencode($copy_data['ID']); ?>"
                        class="bg-yellow-500 text-white py-3 px-6 rounded-md hover:bg-yellow-600">
                        Edit Copy
                    </a>
                    <a href="delete_copy.php?ID=<?php echo urlencode($copy_data['ID']); ?>"
                        class="bg-red-500 text-white py-3 px-6 rounded-md hover:bg-red-600">
                        Delete Copy
                    </a>
                </div>
                </div>

                <?php endif; ?>
                
                <!-- Footer at the Bottom -->
                <footer class="bg-blue-600 text-white p-4 mt-auto">
                    <?php include 'include/footer.php'; ?>
                </footer>
            </div>
        </div>
    </main>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
