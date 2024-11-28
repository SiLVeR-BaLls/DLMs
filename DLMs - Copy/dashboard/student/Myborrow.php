<?php
// Include config and start session to access the logged-in user's ID
include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Borrowed Books - DLMs</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header Section -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Section with Sidebar -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Borrowed Books Content -->
        <div class="flex-grow p-8">
            <h2 class="text-2xl font-semibold text-gray-800">Your Borrowed Books</h2>

            <?php
            // SQL query to fetch borrowed books for the logged-in user
            $query = "
                SELECT 
                    bb.borrow_id,
                    bb.borrow_date,
                    bc.B_title,
                    b.author,
                    DATEDIFF(CURDATE(), bb.borrow_date) AS days_borrowed
                FROM borrow_book AS bb
                JOIN book_copies AS bc ON bb.ID = bc.ID
                JOIN book AS b ON bc.B_title = b.B_title
                WHERE bb.return_date IS NULL AND bb.IDno = ?
            ";

            // Prepare and execute the query
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("s", $userID);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if any rows were returned
                if ($result && $result->num_rows > 0) {
                    echo "<div class='overflow-x-auto bg-white shadow-md rounded-lg'>";
                    echo "<table class='min-w-full table-auto'>
                            <thead class='bg-blue-600 text-white'>
                                <tr>
                                    <th class='px-6 py-3 text-left'>Borrow ID</th>
                                    <th class='px-6 py-3 text-left'>Book Title</th>
                                    <th class='px-6 py-3 text-left'>Author</th>
                                    <th class='px-6 py-3 text-left'>Borrow Date</th>
                                    <th class='px-6 py-3 text-left'>Days Borrowed</th>
                                </tr>
                            </thead>
                            <tbody class='bg-gray-50'>";

                    // Output each row from the query result
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b'>
                                <td class='px-6 py-4'>" . htmlspecialchars($row['borrow_id']) . "</td>
                                <td class='px-6 py-4'>" . htmlspecialchars($row['B_title']) . "</td>
                                <td class='px-6 py-4'>" . htmlspecialchars($row['author']) . "</td>
                                <td class='px-6 py-4'>" . htmlspecialchars($row['borrow_date']) . "</td>
                                <td class='px-6 py-4'>" . htmlspecialchars($row['days_borrowed']) . " days</td>
                              </tr>";
                    }

                    echo "</tbody></table></div>";
                } else {
                    echo "<div class='mt-4 text-center text-gray-500'>No borrowed books found for your account.</div>";
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                echo "<div class='mt-4 text-center text-red-500'>Error retrieving data.</div>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-600 text-white p-4 mt-auto">
        <?php include 'include/footer.php'; ?>
    </footer>

</body>
</html>
