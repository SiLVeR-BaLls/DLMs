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
</head>

<body class="flex flex-col min-h-screen truncate bg-gray-100 text-gray-900">

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- BrowseBook Content Section -->
        <div class="flex-grow">
        <!-- Parent container with 100% width and 80% height -->
<div class="w-full h-auto mx-auto"> <!-- This will take 100% of the container width and 80% of the viewport height -->

<!-- Navbar -->
<div class="w-full h-16 flex sticky top-0 justify-evenly gap-4 p-2 bg-blue-600"> <!-- Full width navbar with centered buttons -->
    
    <!-- Button to Return Book Report -->
    <div id="returnedSection" class="w-auto">
        <a href=Report_return.php">
            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition text-sm">
                Returned Reports
            </button>
        </a>
    </div>

    <!-- Button to Borrow Report -->
    <div id="ratingSection" class="w-auto">
        <a href="report_borrow.php">
            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition text-sm">
                Borrowed Reports
            </button>
        </a>
    </div>

    <!-- Button to Rating Book Report -->
    <div id="borrowedSection" class="w-auto">
        <a href="report_rating.php">
            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition text-sm">
                Rating Reports
            </button>
        </a>
    </div>
</div>

<!-- Include Book Report Rating -->
<div class="w-full">
    <?php include 'include/book_report_returned.php'; ?>
</div>
</div>

            <!-- Footer at the Bottom -->
            <footer class="bg-blue-600 text-white p-4 mt-6">
                <?php include 'include/footer.php'; ?>
            </footer>
        </div>
    </main>

</body>

</html>
