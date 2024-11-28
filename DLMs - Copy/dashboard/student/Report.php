<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLMs</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // Function to toggle the visibility of the sections based on navbar link clicks
        function showSection(section) {
            // Hide all sections
            document.getElementById('returnedSection').classList.add('hidden');
            document.getElementById('borrowedSection').classList.add('hidden');
            document.getElementById('ratingSection').classList.add('hidden');

            // Show the clicked section
            document.getElementById(section).classList.remove('hidden');
        }

        // Set default section (Return) on page load
        window.onload = function() {
            showSection('returnedSection');
        };
    </script>
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
            <!-- Navbar Section -->
            <div class="sticky top-0 z-10 bg-white shadow-md mb-6">
                <nav class="flex justify-evenly items-center p-4">
                    <a href="javascript:void(0)" onclick="showSection('returnedSection')" class="text-blue-600 hover:text-blue-800 font-medium">Return</a>
                    <a href="javascript:void(0)" onclick="showSection('borrowedSection')" class="text-green-600 hover:text-green-800 font-medium">Borrow</a>
                    <a href="javascript:void(0)" onclick="showSection('ratingSection')" class="text-yellow-600 hover:text-yellow-800 font-medium">Rating</a>
                </nav>
            </div>

            <!-- Content Sections -->
            <div id="returnedSection" class="hidden">
                <!-- Returned Book Report -->
                <div class="bg-white p-6 rounded shadow-md max-w-full sm:max-w-4xl mx-auto">
                    <?php include 'include/book_report_returned.php'; ?>
                </div>
            </div>

            <div id="borrowedSection" class="hidden">
                <!-- Borrowed Book Report -->
                <div class="bg-white p-6 rounded shadow-md max-w-full sm:max-w-4xl mx-auto">
                    <?php include 'include/book_report_borrowed.php'; ?>
                </div>
            </div>

            <div id="ratingSection" class="hidden">
                <!-- Rating Report -->
                <div class="bg-white p-6 rounded shadow-md max-w-full sm:max-w-4xl mx-auto">
                    <?php include 'include/book_report_rating.php'; ?>
                </div>
            </div>
            
                <!-- Footer at the Bottom -->
                <footer class="bg-blue-600 text-white p-4 mt-auto">
                    <?php include 'include/footer.php'; ?>
                </footer>
        </div>
    </main>

</body>
</html>
