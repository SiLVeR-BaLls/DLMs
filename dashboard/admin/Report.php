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

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow ">
        <!-- Header at the Top -->
        <?php include 'include/header.php'; ?>

      <div class="">
            <!-- Parent container with 100% width and 80% height -->
            <div class="w-full h-auto mx-auto"> <!-- This will take 100% of the container width and 80% of the viewport height -->

                <!-- Navbar -->
                <div class="w-full h-16 flex sticky top-0 justify-evenly gap-4 p-2 bg-blue-600"> <!-- Full width navbar with centered buttons -->
                    <!-- Button to Statistical Book Report -->
                    <div id="returnedSection" class="w-auto">
                        <a href="Report.php">
                        <button class="w-full bg-blue-900 text-white p-2 rounded hover:bg-blue-800 transition text-sm">
                            Statistical Reports
                            </button>
                        </a>
                    </div>

                    <!-- Button to Return Book Report -->
                    <div id="returnedSection" class="w-auto">
                        <a href="Report_return.php">
                            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-400 transition text-sm">
                                Returned Reports
                            </button>
                        </a>
                    </div>

                    <!-- Button to Borrow Report -->
                    <div id="ratingSection" class="w-auto">
                        <a href="report_borrow.php">
                            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-400 transition text-sm">
                                Borrowed Reports
                            </button>
                        </a>
                    </div>

                    <!-- Button to Rating Book Report -->
                    <div id="borrowedSection" class="w-auto">
                        <a href="report_rating.php">
                            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-400 transition text-sm">
                                Rating Reports
                            </button>
                        </a>
                    </div>

                    <!-- Button to Count Book Report -->
                    <div id="borrowedSection" class="w-auto">
                        <a href="Report_book_count.php">
                            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-400 transition text-sm">
                                Count Reports
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Book Report Content -->
                <div class="w-full  overflow-y-auto"> <!-- Make the content scrollable with max height -->
                    <?php include 'include/book_report.php'; ?>
                </div>

            </div>
            </div>

       <!-- Footer at the Bottom -->
       <footer class="bg-blue-600 text-white mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>

</body>

</html>
