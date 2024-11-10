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
    <title>Books Report: Borrowed and Returned</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <style>
        .chart-container {
            display:flex;
            width: 25%;
            margin: auto;
            padding-top: 40px;
        }

        .chart-container canvas {
            max-width: 100%;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php 
    include 'include/header.php';
    include 'include/navbar.php'; 
    ?>

    <div class="container mt-4">
        <h2>Books Report: Borrowed and Returned</h2>

        <?php
        // SQL query to fetch borrowed books counts, grouped by course, college, and year
        $borrowedQuery = "
            SELECT 
                ud.course, 
                ud.college, 
                YEAR(bb.borrow_date) AS borrow_year, 
                COUNT(bb.ID) AS borrow_count
            FROM borrow_book AS bb
            JOIN users_info AS ui ON bb.IDno = ui.IDno
            JOIN user_details AS ud ON bb.IDno = ud.IDno
            WHERE bb.return_date IS NULL
            GROUP BY ud.course, ud.college, borrow_year
            ORDER BY ud.college, ud.course, borrow_year DESC
        ";

        // SQL query to fetch returned books counts, grouped by course, college, and year
        $returnedQuery = "
            SELECT 
                ud.course, 
                ud.college, 
                YEAR(bb.return_date) AS return_year, 
                COUNT(bb.ID) AS return_count
            FROM borrow_book AS bb
            JOIN users_info AS ui ON bb.IDno = ui.IDno
            JOIN user_details AS ud ON bb.IDno = ud.IDno
            WHERE bb.return_date IS NOT NULL
            GROUP BY ud.course, ud.college, return_year
            ORDER BY ud.college, ud.course, return_year DESC
        ";

        // Execute the borrowed books query
        $borrowedResult = $conn->query($borrowedQuery);
        // Execute the returned books query
        $returnedResult = $conn->query($returnedQuery);

        // Prepare data for the bar graph
        $borrowedLabels = [];
        $borrowedData = [];
        $returnedLabels = [];
        $returnedData = [];

        // Loop through the borrowed result set and prepare data for borrowed books
        if ($borrowedResult && $borrowedResult->num_rows > 0) {
            while ($row = $borrowedResult->fetch_assoc()) {
                $borrowedLabels[] = htmlspecialchars($row['course']) . " (" . htmlspecialchars($row['borrow_year']) . ")";
                $borrowedData[] = (int) $row['borrow_count'];
            }
        }

        // Loop through the returned result set and prepare data for returned books
        if ($returnedResult && $returnedResult->num_rows > 0) {
            while ($row = $returnedResult->fetch_assoc()) {
                $returnedLabels[] = htmlspecialchars($row['course']) . " (" . htmlspecialchars($row['return_year']) . ")";
                $returnedData[] = (int) $row['return_count'];
            }
        }

        // Close the database connection
        $conn->close();
        ?>

        <!-- Create chart container -->
        <div class="chart-container">
            <h3>Borrowed Books by Course and Year</h3>
            <canvas id="borrowedChart"></canvas>
        </div>

        <div class="chart-container">
            <h3>Returned Books by Course and Year</h3>
            <canvas id="returnedChart"></canvas>
        </div>
        
    </div>

    <script>
        // Borrowed Books Chart
        var borrowedLabels = <?php echo json_encode($borrowedLabels); ?>;
        var borrowedData = <?php echo json_encode($borrowedData); ?>;

        var ctxBorrowed = document.getElementById('borrowedChart').getContext('2d');
        var borrowedChart = new Chart(ctxBorrowed, {
            type: 'bar',
            data: {
                labels: borrowedLabels,
                datasets: [{
                    label: 'Borrowed Books',
                    data: borrowedData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Course (Year)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Borrow Count'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Returned Books Chart
        var returnedLabels = <?php echo json_encode($returnedLabels); ?>;
        var returnedData = <?php echo json_encode($returnedData); ?>;

        var ctxReturned = document.getElementById('returnedChart').getContext('2d');
        var returnedChart = new Chart(ctxReturned, {
            type: 'bar',
            data: {
                labels: returnedLabels,
                datasets: [{
                    label: 'Returned Books',
                    data: returnedData,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', // Green
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Course (Year)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Return Count'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
