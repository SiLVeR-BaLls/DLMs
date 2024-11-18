<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Book Ratings</title>
    <style>
        .chart-container {
            width: 97%; /* Reduce the container width by 3% */
            margin: 0 auto;
        }
        #ratingsChart {
            width: 100% !important; /* Ensure canvas takes the full container width */
            height: 90% !important; /* Adjust the height (reduce by 10%) */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Main Content -->
    <main class="container mx-auto">
        <section id="ratingSection">
            <h2 class="text-2xl font-semibold mb-6 text-center">Book Ratings</h2>
            <div class="charts-wrapper">
                <!-- Chart container -->
                <div class="chart-container">
                    <h3 class="text-lg font-semibold mb-2">Ratings Distribution</h3>
                    <canvas id="ratingsChart"></canvas>
                </div>
            </div>
        </section>
    </main>

<?php
    // SQL Query to Get Count of Books by Rating
    $ratingQuery = "
        SELECT rating, COUNT(*) AS rating_count 
        FROM book_copies
        WHERE rating IS NOT NULL AND status IN ('Available', 'Borrowed')
        GROUP BY rating
    ";
    $ratingResult = $conn->query($ratingQuery);

    // Arrays to store rating data for the chart
    $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    $booksByRating = [];

    // Fetch the rating data from the database
    while ($row = $ratingResult->fetch_assoc()) {
        $ratingCounts[(int)$row['rating']] = $row['rating_count'];

        // Get the titles of books with the specific rating
        $bookTitlesQuery = "
            SELECT B_title FROM book_copies 
            WHERE rating = '" . $row['rating'] . "' AND status IN ('Available', 'Borrowed')
        ";
        $titlesResult = $conn->query($bookTitlesQuery);

        $bookTitles = [];
        while ($titleRow = $titlesResult->fetch_assoc()) {
            $bookTitles[] = $titleRow['B_title'];
        }

        // Store book titles for hover display
        $booksByRating[(int)$row['rating']] = $bookTitles;
    }
?>

    <!-- Chart.js Scripts -->
<script>
    // Rating Data for Bar Chart
    const ratingLabels = ['1', '2', '3', '4', '5'];
    const ratingData = <?php echo json_encode(array_values($ratingCounts)); ?>;
    const bookTitles = <?php echo json_encode($booksByRating); ?>;

    // Initialize the Chart.js Bar Chart
    const ctx = document.getElementById('ratingsChart').getContext('2d');
    const ratingsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ratingLabels,
            datasets: [{
                label: 'Number of Books',
                data: ratingData,
                backgroundColor: '#4CAF50',
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        // Display the book titles and count on hover
                        afterLabel: function(tooltipItem) {
                            const rating = tooltipItem.label;
                            const titles = bookTitles[rating];
                            return 'Books: ' + titles.join(', ');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Book Count'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
