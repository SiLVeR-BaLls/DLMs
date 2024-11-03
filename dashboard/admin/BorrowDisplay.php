<?php
// Database connection details
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dlms';

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">   
    <title>Borrowing</title>
</head>

<body>
    <?php 
    include 'include/header.php';
    include 'include/navbar.php'; 
    ?>

    <div class="container">
        <h2>Borrowed Books</h2>

        <?php
        // Fetch borrowed books with user and book details
        $query = "
            SELECT *
            FROM 
                borrow_book AS bb
            JOIN 
                users_info AS u ON bb.IDno = u.IDno
            JOIN 
                book AS b ON bb.ID = b.ID
            JOIN 
                book_copies AS bc ON b.B_title = bc.B_title
            WHERE 
                bb.return_date IS NULL;
        ";

        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Borrow Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['IDno']) . "</td>
                        <td>" . htmlspecialchars($row['Fname']) . "</td>
                        <td>" . htmlspecialchars($row['B_title']) . "</td>
                        <td>" . htmlspecialchars($row['author']) . "</td>
                        <td>" . htmlspecialchars($row['borrow_date']) . "</td>
                        <td>
                            <form action='include/ReturnConnect.php' method='POST'>
                                <input type='hidden' name='borrow_id' value='" . htmlspecialchars($row['borrow_id']) . "'>
                                <input type='submit' value='Return' class='btn btn-danger'>
                            </form>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No borrowed books found.</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
