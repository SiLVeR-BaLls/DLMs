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
        // For courses
        $borrowedCourseLabels[] = $row['course'];
        $borrowedCourseData[] = $row['borrow_count'];

        // For colleges
        $borrowedCollegeLabels[] = $row['college'];
        $borrowedCollegeData[] = $row['borrow_count'];
    }

    // Sort the data (course/college) based on the borrow count (ascending order)
    array_multisort($borrowedCourseData, SORT_ASC, $borrowedCourseLabels);
    array_multisort($borrowedCollegeData, SORT_ASC, $borrowedCollegeLabels);
?>

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
    <main class="container mx-auto">
        <section id="borrowedSection">
            <h2 class="text-2xl font-semibold mb-6 text-center">Borrowed Books Report</h2>
            <div class="flex flex-col lg:flex-row gap-8 justify-center">
                <!-- Borrowed by Course -->
                <div class="chart-container w-full lg:w-1/2 p-6">
                    <h3 class="chart-title text-xl font-semibold mb-4 text-center">Borrowed Books by Course</h3>
                    <canvas id="borrowedCourseChart" height="500"></canvas>
                </div>
                <!-- Borrowed by College -->
                <div class="chart-container w-full lg:w-1/2 p-6">
                    <h3 class="chart-title text-xl font-semibold mb-4 text-center">Borrowed Books by College</h3>
                    <canvas id="borrowedCollegeChart" height="500"></canvas>
                </div>
            </div>
        </section>
    </main>

    <!-- Chart.js Scripts -->
    <script>
        // Borrowed Data from PHP
        const borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels); ?>;
        const borrowedCourseData = <?php echo json_encode($borrowedCourseData); ?>;
        const borrowedCollegeLabels = <?php echo json_encode($borrowedCollegeLabels); ?>;
        const borrowedCollegeData = <?php echo json_encode($borrowedCollegeData); ?>;

        // Utility function to calculate dynamic step size and max value for Y-axis
        function getChartConfig(data) {
            const maxVal = Math.max(...data);  // Get the max borrow count
            const stepSize = 5;               // Fixed step size for X-axis

            // Round the max value up to the nearest multiple of 5
            const roundedMax = Math.ceil(maxVal / stepSize) * stepSize;

            return {
                min: 0,  // Start Y-axis from 0
                max: roundedMax, // Round up the max value to the nearest multiple of 5
                stepSize: stepSize, // Step size of 5
            };
        }

        // Initialize Borrowed Charts for Course
        new Chart(document.getElementById('borrowedCourseChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: borrowedCourseData, // Borrow count on X-axis
                datasets: [{
                    label: 'Borrowed Books by Course',
                    data: borrowedCourseData,    // Borrow count data
                    backgroundColor: '#4CAF50',  // Green for course chart
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const count = tooltipItem.raw;
                                const course = borrowedCourseLabels[tooltipItem.dataIndex];
                                return `${course}: ${count} borrows`; // Show course name and borrow count
                            }
                        }
                    }
                },
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Borrow Count' // X-axis will display borrow count
                        },
                        ...getChartConfig(borrowedCourseData), // Dynamic X-axis configuration
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Course'
                        },
                        ticks: {
                            autoSkip: true,
                            maxRotation: 45,
                            minRotation: 30,
                        }
                    }
                }
            }
        });

        // Initialize Borrowed Charts for College
        new Chart(document.getElementById('borrowedCollegeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: borrowedCollegeData, // Borrow count on X-axis
                datasets: [{
                    label: 'Borrowed Books by College',
                    data: borrowedCollegeData,   // Borrow count data
                    backgroundColor: '#4CAF50', // Green for college chart
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const count = tooltipItem.raw;
                                const college = borrowedCollegeLabels[tooltipItem.dataIndex];
                                return `${college}: ${count} borrows`; // Show college name and borrow count
                            }
                        }
                    }
                },
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Borrow Count' // X-axis will display borrow count
                        },
                        ...getChartConfig(borrowedCollegeData), // Dynamic X-axis configuration
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'College'
                        },
                        ticks: {
                            autoSkip: true,
                            maxRotation: 45,
                            minRotation: 30,
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
