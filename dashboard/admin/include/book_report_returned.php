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
    <main class="container mx-auto">
        <section id="returnedSection">
            <h2 class="text-2xl font-semibold mb-6 text-center">Returned Books Report</h2>
            <div class="flex flex-col lg:flex-row gap-8 justify-center">
                <!-- Returned by Course -->
                <div class="chart-container w-full lg:w-1/2 p-6">
                    <h3 class="chart-title text-xl font-semibold mb-4 text-center">Returned Books by Course</h3>
                    <canvas id="returnedCourseChart" height="500"></canvas> <!-- Chart height adjusted -->
                </div>
                <!-- Returned by College -->
                <div class="chart-container w-full lg:w-1/2 p-6">
                    <h3 class="chart-title text-xl font-semibold mb-4 text-center">Returned Books by College</h3>
                    <canvas id="returnedCollegeChart" height="500"></canvas> <!-- Chart height adjusted -->
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
        // For courses
        $returnedCourseLabels[] = $row['course'];
        $returnedCourseData[] = $row['return_count'];

        // For colleges
        $returnedCollegeLabels[] = $row['college'];
        $returnedCollegeData[] = $row['return_count'];
    }

    // Sort the data (course/college) based on the returned count
    array_multisort($returnedCourseData, SORT_ASC, $returnedCourseLabels);
    array_multisort($returnedCollegeData, SORT_ASC, $returnedCollegeLabels);
?>

    <!-- Chart.js Scripts -->
<script>
        // Returned Data from PHP
        const returnedCourseLabels = <?php echo json_encode($returnedCourseLabels); ?>;
        const returnedCourseData = <?php echo json_encode($returnedCourseData); ?>;
        const returnedCollegeLabels = <?php echo json_encode($returnedCollegeLabels); ?>;
        const returnedCollegeData = <?php echo json_encode($returnedCollegeData); ?>;

        // Utility function to get dynamic step size and max value for the Y-axis
        function getChartConfig(data) {
            const maxVal = Math.max(...data);
            const minVal = Math.min(...data);
            const stepSize = Math.ceil((maxVal - minVal) / 5); // Create a step size based on the range

            return {
                min: 0,  // Starting point for the axis (1)
                max: maxVal + 1, // Set max value to the highest count + 1
                stepSize: stepSize,
            };
        }

        // Initialize Returned Charts for Course
        new Chart(document.getElementById('returnedCourseChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: returnedCourseData,  // Display the borrower count on the x-axis
                datasets: [{
                    label: 'Count of Borrows by Course',
                    data: returnedCourseData,   // Data (counts of borrows)
                    backgroundColor: '#2196F3',
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Modify the tooltip label to show the course name and borrow count
                                const course = returnedCourseLabels[tooltipItem.dataIndex];  // Get the course name
                                const count = tooltipItem.raw;  // Get the count of borrows
                                return course + ': ' + count + ' borrows';
                            }
                        }
                    }
                },
                responsive: true,  // Ensures the chart is responsive
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Borrower Count'
                        },
                        min: 0, // Start from 1
                        max: Math.max(...returnedCourseData) + 5, // Dynamic max based on data
                        ticks: {
                            stepSize: 1, // Display counts step-by-step
                            beginAtZero: true,
                            autoSkip: true,  // Automatically skip labels if they overlap
                            maxRotation: 45, // Rotate labels if needed
                            minRotation: 30, // Minimum rotation angle
                            font: {
                                size: 10, // Adjust font size if labels are long
                            },
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Borrow Count'
                        },
                        ...getChartConfig(returnedCourseData) // Dynamic configuration for Y-Axis
                    }
                }
            }
        });

        // Initialize Returned Charts for College
        new Chart(document.getElementById('returnedCollegeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: returnedCollegeData,  // Display the borrower count on the x-axis
                datasets: [{
                    label: 'Count of Borrows by College',
                    data: returnedCollegeData,   // Data (counts of borrows)
                    backgroundColor: '#2196F3',
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Modify the tooltip label to show the college name and borrow count
                                const college = returnedCollegeLabels[tooltipItem.dataIndex];  // Get the college name
                                const count = tooltipItem.raw;  // Get the count of borrows
                                return college + ': ' + count + ' borrows';
                            }
                        }
                    }
                },
                responsive: true,  // Ensures the chart is responsive
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Borrower Count'
                        },
                        min: 1, // Start from 1
                        max: Math.max(...returnedCollegeData) + 1, // Dynamic max based on data
                        ticks: {
                            stepSize: 1, // Display counts step-by-step
                            beginAtZero: true,
                            autoSkip: true,  // Automatically skip labels if they overlap
                            maxRotation: 45, // Rotate labels if needed
                            minRotation: 30, // Minimum rotation angle
                            font: {
                                size: 10, // Adjust font size if labels are long
                            },
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Borrow Count'
                        },
                        ...getChartConfig(returnedCollegeData) // Dynamic configuration for Y-Axis
                    }
                }
            }
        });
</script>

</body>
</html>
