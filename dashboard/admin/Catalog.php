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

            <!-- BrowseBook Content -->
            <?php include 'include/AddbookTable.php'; ?>
        </div>
        <!-- Footer at the Bottom -->
        <footer class="bg-blue-600 text-white mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>


</body>
</html>
