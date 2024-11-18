

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Returned Books Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Main Content -->
    <main class="container mx-auto mt-4 px-4">
        <section id="returnedSection" class="mt-4">
            <h2 class="text-xl font-semibold mb-4">Returned Books Report</h2>
            <div class="charts-wrapper">
                <!-- Returned by Course -->
                <div class="chart-container">
                    <h3 class="chart-title">Returned Books by Course</h3>
                    <canvas id="returnedCourseChart"></canvas>
                </div>
                <!-- Returned by College -->
                <div class="chart-container">
                    <h3 class="chart-title">Returned Books by College</h3>
                    <canvas id="returnedCollegeChart"></canvas>
                </div>
            </div>
        </section>
    </main>

<?php
    // SQL Queries for Returned Books
    $returnedQuery = "
        SELECT u.course, u.college, COUNT(bb.ID) AS return_count
        FROM borrow_book AS bb
        LEFT JOIN user_details AS u ON bb.IDno = u.IDno
        WHERE bb.return_date IS NOT NULL
        GROUP BY u.course, u.college
    ";
    $returnedResult = $conn->query($returnedQuery);

    $returnedCourseData = [];
    $returnedCourseLabels = [];
    $returnedCollegeData = [];
    $returnedCollegeLabels = [];

    while ($row = $returnedResult->fetch_assoc()) {
        $returnedCourseLabels[] = $row['course'];
        $returnedCourseData[] = $row['return_count'];
        $returnedCollegeLabels[] = $row['college'];
        $returnedCollegeData[] = $row['return_count'];
    }
?>

    <!-- Chart.js Scripts -->
<script>
        // Returned Data
        const returnedCourseLabels = <?php echo json_encode($returnedCourseLabels); ?>;
        const returnedCourseData = <?php echo json_encode($returnedCourseData); ?>;
        const returnedCollegeLabels = <?php echo json_encode($returnedCollegeLabels); ?>;
        const returnedCollegeData = <?php echo json_encode($returnedCollegeData); ?>;

        // Initialize Returned Charts
        new Chart(document.getElementById('returnedCourseChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: returnedCourseLabels,
                datasets: [{
                    label: 'Returned Books',
                    data: returnedCourseData,
                    backgroundColor: '#2196F3',
                }]
            }
        });

        new Chart(document.getElementById('returnedCollegeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: returnedCollegeLabels,
                datasets: [{
                    label: 'Returned Books',
                    data: returnedCollegeData,
                    backgroundColor: '#2196F3',
                }]
            }
        });
</script>
</body>
</html>
