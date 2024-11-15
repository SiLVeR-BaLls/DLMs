<?php
include '../config.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Books Report: Borrowed and Returned</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .chart-container {
            flex: 1;
            margin: 10px;
            display: none; /* Hide all charts by default */
            width: 100%; /* Set a default width */
            max-width: 600px; /* Set a maximum width */
            height: 400px; /* Set a default height for the chart */
        }

        .charts-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center; /* Center the charts horizontally */
        }

        .chart-container canvas {
            max-width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #4CAF50;
        }

        .navbar button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .navbar button:hover {
            background-color: #45a049;
        }

        .filter-btns button {
            background-color: #2196F3;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-btns button:hover {
            background-color: #0b7dda;
        }

        .active {
            background-color: #4CAF50;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9fafb;
            justify-content: flex-start;
        }

        main {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            padding: 0 20px;
            margin: 0 auto;
        }

        .table-container {
            margin-top: 40px;
        }

        .table-title {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Header at the Top -->
    <?php include 'include/header.php'; ?>

    <!-- Main Content Area with Sidebar and Return Book Section -->
    <main>
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>

        <!-- BrowseBook Content and Footer Section -->
        <div class="flex-grow">
            <div class="container mx-auto mt-4 px-4">
                <h2 class="text-3xl font-semibold text-center mb-10">Books Report: Borrowed and Returned</h2>

                <!-- Borrowed / Returned Section Buttons -->
                <div class="navbar flex flex-col md:flex-row justify-center gap-2 py-2">
                    <button id="borrowedBtn" class="text-white text-sm py-2 px-4 rounded-lg hover:bg-green-600 transition-all duration-200" onclick="showSection('borrowed')">
                        Borrowed
                    </button>
                    <button id="returnedBtn" class="text-white text-sm py-2 px-4 rounded-lg hover:bg-red-600 transition-all duration-200" onclick="showSection('returned')">
                        Returned
                    </button>
                </div>

                <!-- Filter Period Buttons -->
                <div class="filter-btns flex flex-wrap justify-center gap-2 mt-4">
                    <button id="dailyBtn" class="text-sm py-2 px-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-all duration-200" onclick="filterPeriod('daily')">
                        Daily
                    </button>
                    <button id="weeklyBtn" class="text-sm py-2 px-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-all duration-200" onclick="filterPeriod('weekly')">
                        Weekly
                    </button>
                    <button id="monthlyBtn" class="text-sm py-2 px-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-all duration-200" onclick="filterPeriod('monthly')">
                        Monthly
                    </button>
                    <button id="yearlyBtn" class="text-sm py-2 px-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-all duration-200" onclick="filterPeriod('yearly')">
                        Yearly
                    </button>
                </div>

                <?php
// SQL queries for Borrowed books (grouped by course and college)
$queries = [
    "yearly" => "
       SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS borrow_count
FROM borrow_book AS bb
LEFT JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "monthly" => "
       SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS borrow_count
FROM borrow_book AS bb
LEFT JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "weekly" => "
       SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS borrow_count
FROM borrow_book AS bb
LEFT JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "daily" => "
       SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS borrow_count
FROM borrow_book AS bb
LEFT JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    "
];

// Prepare arrays to store chart data for borrowed books
$borrowedCourseLabels = [];
$borrowedCollegeLabels = [];
$borrowedCourseData = [];
$borrowedCollegeData = [];

// Loop through each query (Yearly, Monthly, Weekly, Daily) for borrowed books
foreach ($queries as $period => $query) {
    $result = $conn->query($query);

    // Prepare data for each period
    if ($result && $result->num_rows > 0) {
        $course_data = [];
        $college_data = [];

        while ($row = $result->fetch_assoc()) {
            // For each period, merge data based on course and college
            $course = $row['course'];
            $college = $row['college'];
            $borrow_count = (int) $row['borrow_count'];

            // Merge data for course
            if (!isset($course_data[$course])) {
                $course_data[$course] = 0;
            }
            $course_data[$course] += $borrow_count;

            // Merge data for college
            if (!isset($college_data[$college])) {
                $college_data[$college] = 0;
            }
            $college_data[$college] += $borrow_count;
        }

        // Store merged data for the period
        $borrowedCourseLabels[$period] = array_keys($course_data);
        $borrowedCourseData[$period] = array_values($course_data);
        $borrowedCollegeLabels[$period] = array_keys($college_data);
        $borrowedCollegeData[$period] = array_values($college_data);
    }
}


  // SQL for returned books (grouped by course and college)
$returnedQueries = [
    "yearly" => "
        SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS return_count
FROM borrow_book AS bb
JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NOT NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "monthly" => "
        SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS return_count
FROM borrow_book AS bb
JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NOT NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "weekly" => "
        SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS return_count
FROM borrow_book AS bb
JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NOT NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    ",
    "daily" => "
        SELECT 
    u.course, 
    u.college, 
    COUNT(DISTINCT bb.ID) AS return_count
FROM borrow_book AS bb
JOIN user_details AS u ON bb.IDno = u.IDno
WHERE bb.return_date IS NOT NULL
GROUP BY u.course, u.college
ORDER BY u.college, u.course

    "
];

// Prepare arrays to store chart data for returned books
$returnedCourseLabels = [];
$returnedCollegeLabels = [];
$returnedCourseData = [];
$returnedCollegeData = [];

// Loop through each query for returned books
foreach ($returnedQueries as $period => $query) {
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $course_data = [];
        $college_data = [];

        while ($row = $result->fetch_assoc()) {
            // For each period, merge data based on course and college
            $course = $row['course'];
            $college = $row['college'];
            $return_count = (int) $row['return_count'];

            // Merge data for course
            if (!isset($course_data[$course])) {
                $course_data[$course] = 0;
            }
            $course_data[$course] += $return_count;

            // Merge data for college
            if (!isset($college_data[$college])) {
                $college_data[$college] = 0;
            }
            $college_data[$college] += $return_count;
        }

        // Store merged data for the period
        $returnedCourseLabels[$period] = array_keys($course_data);
        $returnedCourseData[$period] = array_values($course_data);
        $returnedCollegeLabels[$period] = array_keys($college_data);
        $returnedCollegeData[$period] = array_values($college_data);
    }
}
?>

            

                <!-- Chart Section -->
                <div class="charts-wrapper">
                    <!-- Borrowed by Course Chart -->
                    <div id="borrowedCourseChart" class="chart-container">
                        <h3 class="chart-title">Borrowed Books by Course</h3>
                        <canvas id="borrowedCourseBarChart"></canvas>
                    </div>

                    <!-- Borrowed by College Chart -->
                    <div id="borrowedCollegeChart" class="chart-container">
                        <h3 class="chart-title">Borrowed Books by College</h3>
                        <canvas id="borrowedCollegeBarChart"></canvas>
                    </div>

                    <!-- Returned by Course Chart -->
                    <div id="returnedCourseChart" class="chart-container">
                        <h3 class="chart-title">Returned Books by Course</h3>
                        <canvas id="returnedCourseBarChart"></canvas>
                    </div>

                    <!-- Returned by College Chart -->
                    <div id="returnedCollegeChart" class="chart-container">
                        <h3 class="chart-title">Returned Books by College</h3>
                        <canvas id="returnedCollegeBarChart"></canvas>
                    </div>
                </div>

                <script>
                    // Function to show/hide the borrowed and returned sections
                    function showSection(section) {
                        if (section === 'borrowed') {
                            document.getElementById('borrowedCourseChart').style.display = 'block';
                            document.getElementById('borrowedCollegeChart').style.display = 'block';
                            document.getElementById('returnedCourseChart').style.display = 'none';
                            document.getElementById('returnedCollegeChart').style.display = 'none';
                            document.getElementById('borrowedBtn').classList.add('active');
                            document.getElementById('returnedBtn').classList.remove('active');
                        } else {
                            document.getElementById('borrowedCourseChart').style.display = 'none';
                            document.getElementById('borrowedCollegeChart').style.display = 'none';
                            document.getElementById('returnedCourseChart').style.display = 'block';
                            document.getElementById('returnedCollegeChart').style.display = 'block';
                            document.getElementById('returnedBtn').classList.add('active');
                            document.getElementById('borrowedBtn').classList.remove('active');
                        }
                    }

                    // Initial call to show 'borrowed' data by default
                    showSection('borrowed');

                    // Data for the borrowed and returned books charts (Course-wise)
                    var borrowedCourseData = <?php echo json_encode($borrowedCourseData['monthly']); ?>;
                    var borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['monthly']); ?>;
                    var returnedCourseData = <?php echo json_encode($returnedCourseData['monthly']); ?>;
                    var returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['monthly']); ?>;
                    
                    // Data for the borrowed and returned books charts (College-wise)
                    var borrowedCollegeData = <?php echo json_encode($borrowedCollegeData['monthly']); ?>;
                    var borrowedCollegeLabels = <?php echo json_encode($borrowedCollegeLabels['monthly']); ?>;
                    var returnedCollegeData = <?php echo json_encode($returnedCollegeData['monthly']); ?>;
                    var returnedCollegeLabels = <?php echo json_encode($returnedCollegeLabels['monthly']); ?>;

                    // Borrowed Books by Course Bar Chart
                    var ctx1 = document.getElementById('borrowedCourseBarChart').getContext('2d');
                    new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: borrowedCourseLabels,
                            datasets: [{
                                label: 'Borrowed Books Count',
                                data: borrowedCourseData,
                                backgroundColor: '#4CAF50',
                                borderColor: '#388E3C',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Borrowed Books by College Bar Chart
                    var ctx2 = document.getElementById('borrowedCollegeBarChart').getContext('2d');
                    new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: borrowedCollegeLabels,
                            datasets: [{
                                label: 'Borrowed Books Count',
                                data: borrowedCollegeData,
                                backgroundColor: '#4CAF50',
                                borderColor: '#388E3C',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Returned Books by Course Bar Chart
                    var ctx3 = document.getElementById('returnedCourseBarChart').getContext('2d');
                    new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: returnedCourseLabels,
                            datasets: [{
                                label: 'Returned Books Count',
                                data: returnedCourseData,
                                backgroundColor: '#F44336',
                                borderColor: '#D32F2F',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Returned Books by College Bar Chart
                    var ctx4 = document.getElementById('returnedCollegeBarChart').getContext('2d');
                    new Chart(ctx4, {
                        type: 'bar',
                        data: {
                            labels: returnedCollegeLabels,
                            datasets: [{
                                label: 'Returned Books Count',
                                data: returnedCollegeData,
                                backgroundColor: '#F44336',
                                borderColor: '#D32F2F',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    function filterPeriod(period) {
    // Dynamically update the chart data for the selected period
    var borrowedCourseData = <?php echo json_encode($borrowedCourseData['monthly']); ?>;
    var borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['monthly']); ?>;
    var returnedCourseData = <?php echo json_encode($returnedCourseData['monthly']); ?>;
    var returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['monthly']); ?>;
    
    // Adjust the data based on the selected period
    switch (period) {
        case 'daily':
            borrowedCourseData = <?php echo json_encode($borrowedCourseData['daily']); ?>;
            borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['daily']); ?>;
            returnedCourseData = <?php echo json_encode($returnedCourseData['daily']); ?>;
            returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['daily']); ?>;
            break;
        case 'weekly':
            borrowedCourseData = <?php echo json_encode($borrowedCourseData['weekly']); ?>;
            borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['weekly']); ?>;
            returnedCourseData = <?php echo json_encode($returnedCourseData['weekly']); ?>;
            returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['weekly']); ?>;
            break;
        case 'monthly':
            borrowedCourseData = <?php echo json_encode($borrowedCourseData['monthly']); ?>;
            borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['monthly']); ?>;
            returnedCourseData = <?php echo json_encode($returnedCourseData['monthly']); ?>;
            returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['monthly']); ?>;
            break;
        case 'yearly':
            borrowedCourseData = <?php echo json_encode($borrowedCourseData['yearly']); ?>;
            borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels['yearly']); ?>;
            returnedCourseData = <?php echo json_encode($returnedCourseData['yearly']); ?>;
            returnedCourseLabels = <?php echo json_encode($returnedCourseLabels['yearly']); ?>;
            break;
    }

    // Update Borrowed Books by Course Chart
    var ctx1 = document.getElementById('borrowedCourseBarChart').getContext('2d');
    var borrowedCourseChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: borrowedCourseLabels,
            datasets: [{
                label: 'Borrowed Books Count',
                data: borrowedCourseData,
                backgroundColor: '#4CAF50',
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Update Returned Books by Course Chart
    var ctx3 = document.getElementById('returnedCourseBarChart').getContext('2d');
    var returnedCourseChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: returnedCourseLabels,
            datasets: [{
                label: 'Returned Books Count',
                data: returnedCourseData,
                backgroundColor: '#F44336',
                borderColor: '#D32F2F',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

                    
                </script>

            </div>
        </div>
    </main>

</body>
</html>