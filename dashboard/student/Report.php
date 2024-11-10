<?php
include '../config.php'; // include database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Borrowed Books Report</title>
    <style>
        .no-books-alert {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background-color: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 5px;
            font-size: 1.2rem;
            z-index: 10;
        }

        .table-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php 
    include 'include/header.php';
    include 'include/navbar.php'; 
    ?>

    <div class="container mt-4">
        <h2 class="text-center">Borrowed Books Report by Course</h2>

        <?php
        // Start SQL query to fetch borrow counts grouped by course
        $query = "
            SELECT 
                ud.course, 
                COUNT(bb.ID) AS borrow_count
            FROM borrow_book AS bb
            JOIN users_info AS ui ON bb.IDno = ui.IDno
            JOIN user_details AS ud ON bb.IDno = ud.IDno
            WHERE bb.return_date IS NULL
            GROUP BY ud.course
            ORDER BY borrow_count DESC
        ";

        // Execute the query
        $result = $conn->query($query);

        // Check for query error
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        // Check if there are any results
        if ($result && $result->num_rows > 0) {
            echo "<div class='table-container'>
                    <div class='table-responsive'>
                        <table class='table table-striped table-bordered'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Course</th>
                                    <th>Borrow Count</th>
                                </tr>
                            </thead>
                            <tbody>";

            // Loop through each record and display the data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['course']) . "</td>
                        <td>" . htmlspecialchars($row['borrow_count']) . "</td>
                      </tr>";
            }
            echo "</tbody></table></div></div>";
        } else {
            // No records found, display a warning message
            echo "<div class='no-books-alert'>No borrowed books found for any course.</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
