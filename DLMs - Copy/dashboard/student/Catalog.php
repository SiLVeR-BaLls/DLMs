<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/script.js"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex ">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- BrowseBook Content and Footer Section -->
        <div class="flex-grow">
            <!-- BrowseBook Content -->
            <?php include 'include/AddbookTable.php'; ?>

            <!-- Footer at the Bottom -->
            <footer class="bg-blue-600 text-white p-4 mt-auto">
                <?php include 'include/footer.php'; ?>
            </footer>
        </div>
    </main>

</body>
</html>
