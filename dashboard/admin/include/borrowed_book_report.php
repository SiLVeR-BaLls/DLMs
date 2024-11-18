
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Borrowed Books Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Main Content -->
    <main class="container mx-auto mt-4 px-4">
        <section id="borrowedSection" class="mt-4">
            <h2 class="text-xl font-semibold mb-4">Borrowed Books Report</h2>
            <div class="charts-wrapper">
                <!-- Borrowed by Course -->
                <div class="chart-container">
                    <h3 class="chart-title">Borrowed Books by Course</h3>
                    <canvas id="borrowedCourseChart"></canvas>
                </div>
                <!-- Borrowed by College -->
                <div class="chart-container">
                    <h3 class="chart-title">Borrowed Books by College</h3>
                    <canvas id="borrowedCollegeChart"></canvas>
                </div>
            </div>
        </section>
    </main>

    <?php
    // SQL Queries for Borrowed Books
    $borrowedQuery = "
        SELECT u.course, u.college, COUNT(bb.ID) AS borrow_count
        FROM borrow_book AS bb
        LEFT JOIN user_details AS u ON bb.IDno = u.IDno
        WHERE bb.return_date IS NULL
        GROUP BY u.course, u.college
    ";
    $borrowedResult = $conn->query($borrowedQuery);

    $borrowedCourseData = [];
    $borrowedCourseLabels = [];
    $borrowedCollegeData = [];
    $borrowedCollegeLabels = [];

    while ($row = $borrowedResult->fetch_assoc()) {
        $borrowedCourseLabels[] = $row['course'];
        $borrowedCourseData[] = $row['borrow_count'];
        $borrowedCollegeLabels[] = $row['college'];
        $borrowedCollegeData[] = $row['borrow_count'];
    }
    ?>

    <!-- Chart.js Scripts -->
    <script>
        // Borrowed Data
        const borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels); ?>;
        const borrowedCourseData = <?php echo json_encode($borrowedCourseData); ?>;
        const borrowedCollegeLabels = <?php echo json_encode($borrowedCollegeLabels); ?>;
        const borrowedCollegeData = <?php echo json_encode($borrowedCollegeData); ?>;

        // Initialize Borrowed Charts
        new Chart(document.getElementById('borrowedCourseChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: borrowedCourseLabels,
                datasets: [{
                    label: 'Borrowed Books',
                    data: borrowedCourseData,
                    backgroundColor: '#4CAF50',
                }]
            }
        });

        new Chart(document.getElementById('borrowedCollegeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: borrowedCollegeLabels,
                datasets: [{
                    label: 'Borrowed Books',
                    data: borrowedCollegeData,
                    backgroundColor: '#4CAF50',
                }]
            }
        });
    </script>
</body>
</html>
