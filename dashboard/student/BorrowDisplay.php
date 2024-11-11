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
    <title>Borrowed Books</title>
    <style>
        /* CSS for making search container responsive */
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

        .search-container {
            position:relative;
            width: 100%;
            margin: 0;
            padding: 0px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            align-items: center;
            margin-bottom: 10px;

        }


.clear-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #888;
    font-size: 18px;
    display: none; /* Hide the button initially */
}

/* Optional: Change button color on hover */
.clear-btn:hover {
    color: #f44336;
}

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-group button {
            margin: 5px;
            width: auto;
        }

        /* Make buttons active visually */
        .btn-group button.active {
            background-color: #007bff;
            color: white;
        }

        /* Adjusting the table for responsiveness */
        table {
            width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 0 5%;
            }
        }
    </style>
</head>
<body>
    <?php 
    include 'include/header.php';
    include 'include/navbar.php'; 
    ?>

    <div class="container mt-4">
        <h2>Borrowed Books</h2>

        <!-- Search Form -->
        <form method="GET" class="mb-4 search-container">
                <div class="btn-group"><div class="search-container">
                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Enter search term" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                
                <!-- Search by Title Button -->
                <button type="submit" name="search_by" value="title" class="btn btn-info <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'title') ? 'active' : ''; ?>">Search by Title</button>
                <!-- Search by Author Button -->
                <button type="submit" name="search_by" value="author" class="btn btn-info <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'author') ? 'active' : ''; ?>">Search by Author</button>
                <!-- Search by User Button -->
                <button type="submit" name="search_by" value="user" class="btn btn-info <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'user') ? 'active' : ''; ?>">Search by User</button>
                <!-- Search All Button (Optional) -->
                <button type="submit" name="search_by" value="all" class="btn btn-info <?php echo (isset($_GET['search_by']) && $_GET['search_by'] == 'all') ? 'active' : ''; ?>">Search All</button>
            </div>
        </form>

        <?php
        // Get the search term and search type from GET request (if any)
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $searchBy = isset($_GET['search_by']) ? $_GET['search_by'] : '';

        // Start SQL query to fetch borrowed books
        $query = "SELECT 
             bb.ID, 
             bb.borrow_id, 
             bb.borrow_date,
             ui.IDno, 
             ui.Fname, 
             ui.Sname, 
             bc.B_title, 
             b.author,
             ud.college,  
             ud.course  
          FROM borrow_book AS bb
          JOIN users_info AS ui ON bb.IDno = ui.IDno
          JOIN user_details AS ud ON bb.IDno = ud.IDno
          JOIN book_copies AS bc ON bb.ID = bc.ID
          JOIN book AS b ON bc.B_title = b.B_title
          WHERE bb.return_date IS NULL";

        // If search term is provided, modify the query to filter results
        if (!empty($searchTerm) && !empty($searchBy)) {
            $searchTerm = $conn->real_escape_string($searchTerm); // Prevent SQL injection

            // Perform LIKE search based on selected criteria (Title, Author, or User)
            if ($searchBy == 'title') {
                // Search by title using LIKE
                $query .= " AND bc.B_title LIKE '%$searchTerm%'";
            } elseif ($searchBy == 'author') {
                // Search by author using LIKE
                $query .= " AND b.author LIKE '%$searchTerm%'";
            } elseif ($searchBy == 'user') {
                // Search by user (First Name or Surname) using LIKE
                $query .= " AND (ui.Fname LIKE '%$searchTerm%' OR ui.Sname LIKE '%$searchTerm%' OR ui.IDno LIKE '%$searchTerm%')";
            } elseif ($searchBy == 'all') {
                // Search in both title and author
                $query .= " AND (bc.B_title LIKE '%$searchTerm%' OR b.author LIKE '%$searchTerm%' OR ui.Fname LIKE '%$searchTerm%' OR ui.Sname LIKE '%$searchTerm%')";
            }
        }

        // Execute the query
        $result = $conn->query($query);

        // Check for query error
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        // Check if there are any results
        if ($result && $result->num_rows > 0) {
            echo "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                     <thead class='thead-dark'>
                        <tr>
                            <th class='open'>ID</th>
                            <th class='close'>Borrow ID</th>
                            <th class='open'>Username</th>
                            <th class='open'>First Name</th>
                            <th class='close'>Surname</th>
                            <th class='close'>Book Title</th>
                            <th class='open'>Author</th>
                            <th class='close'>Borrow Date</th>
                            <th class='close'>College</th> <!-- Added College column -->
                            <th class='close'>Course</th> <!-- Added College column -->
                            <th class='open'>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Loop through each record and display the data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='open'>" . htmlspecialchars($row['ID']) . "</td>
                        <td class='close'>" . htmlspecialchars($row['borrow_id']) . "</td>
                        <td class='open'>" . htmlspecialchars($row['IDno']) . "</td>
                        <td class='open'>" . htmlspecialchars($row['Fname']) . "</td>
                        <td class='close'>" . htmlspecialchars($row['Sname']) . "</td>
                        <td class='close'>" . htmlspecialchars($row['B_title']) . "</td>
                        <td class='open'>" . htmlspecialchars($row['author']) . "</td>
                        <td class='close'>" . htmlspecialchars($row['borrow_date']) . "</td>
                        <td class='close'>" . htmlspecialchars($row['college']) . "</td> <!-- Displaying College -->
                        <td class='close'>" . htmlspecialchars($row['course']) . "</td> <!-- Displaying College -->
                        <td class='open'>
                            <form action='include/ReturnConnect.php' method='POST'>
                                <input type='hidden' name='ID' value='" . htmlspecialchars($row['ID']) . "'>
                                <input type='submit' value='Return' class='btn btn-danger'>
                            </form>
                        </td>
                      </tr>";
            }
            echo "</tbody></table></div>";
        } else {
            // No records found, display a warning message outside the table
            echo "<div class='no-books-alert'>No borrowed books found.</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>