<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<!-- Main Content -->
<main class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-6 text-center">Borrowed Books Report</h2>
    <div class="flex flex-col lg:flex-row gap-8 justify-center">
        <!-- Borrowed by Course -->
        <div class="chart-container w-full lg:w-1/2  h-[80vh] overflow-hidden"> <!-- Set width and height, hide overflow -->
            <h3 class="chart-title text-xl font-semibold mb-4 text-center">Borrowed Books by Course</h3>
            <canvas id="borrowedCourseChart" class="h-[80%] w-full"></canvas> <!-- Set canvas height to 80% of container -->
        </div>
        <!-- Borrowed by College -->
        <div class="chart-container w-full lg:w-1/2  h-[80vh] overflow-hidden"> <!-- Set width and height, hide overflow -->
            <h3 class="chart-title text-xl font-semibold mb-4 text-center">Borrowed Books by College</h3>
            <canvas id="borrowedCollegeChart" class="h-[80%] w-full"></canvas> <!-- Set canvas height to 80% of container -->
        </div>
    </div>
</main>


<?php
  // SQL Queries for Borrowed Books (instead of returned books)
  $borrowedQuery = "
      SELECT u.course, u.college, COUNT(bb.ID) AS borrow_count
      FROM borrow_book AS bb
      LEFT JOIN user_details AS u ON bb.IDno = u.IDno
      WHERE bb.return_date IS NULL  -- We want books that have been borrowed and not yet returned
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
  array_multisort($borrowedCourseData, SORT_DESC, $borrowedCourseLabels);
  array_multisort($borrowedCollegeData, SORT_DESC, $borrowedCollegeLabels);
?>

    <!-- Chart.js Scripts -->
<script>
// Borrowed Data from PHP
const borrowedCourseLabels = <?php echo json_encode($borrowedCourseLabels); ?>;
const borrowedCourseData = <?php echo json_encode($borrowedCourseData); ?>;
const borrowedCollegeLabels = <?php echo json_encode($borrowedCollegeLabels); ?>;
const borrowedCollegeData = <?php echo json_encode($borrowedCollegeData); ?>;

// Chart logic remains unchanged
    function generateColors(count) {
        return Array.from({ length: count }, () => {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return `rgb(${r}, ${g}, ${b})`;
        });
    }

    // Dynamic datasets for courses
    const courseDatasets = borrowedCourseLabels.map((label, index) => ({
        label: label, // Use the course name as the dataset label
        data: [borrowedCourseData[index]], // Data for this course
        backgroundColor: generateColors(1), // Unique color for each course
    }));

    // Dynamic datasets for colleges
    const collegeDatasets = borrowedCollegeLabels.map((label, index) => ({
        label: label, // Use the college name as the dataset label
        data: [borrowedCollegeData[index]], // Data for this college
        backgroundColor: generateColors(1), // Unique color for each college
    }));

    // Borrowed Books by Course
    new Chart(document.getElementById('borrowedCourseChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Borrowed Books'], // Single bar for all datasets
            datasets: courseDatasets,
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right', // Legend on the right side
                }
            },
            responsive: true,
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Borrow Count'
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5, // Set step size to 5 on the Y-axis
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Courses'
                    },
                    reverse: true, // Reverses the order of bars so the highest appears on the right
                }
            }
        }
    });

    // Borrowed Books by College
    new Chart(document.getElementById('borrowedCollegeChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Borrowed Books'], // Single bar for all datasets
            datasets: collegeDatasets,
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'right', // Legend on the right side
                }
            },
            responsive: true,
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Borrow Count'
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5, // Set step size to 5 on the Y-axis
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Colleges'
                    },
                    reverse: true, // Reverses the order of bars so the highest appears on the right
                }
            }
        }
    });
</script>
</body>
</html>
