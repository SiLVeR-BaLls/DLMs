<?php
// display.php
// Database connection (replace with your own DB credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authors_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch authors and their co-authors
$sql = "
    SELECT authors.id AS author_id, authors.name AS author_name, authors.registration_date, 
           co_authors.name AS co_author_name, co_authors.co_author_date, co_authors.role
    FROM authors
    LEFT JOIN co_authors ON authors.id = co_authors.author_id
    ORDER BY authors.id
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Registered Authors and Co-Authors</h1>";
    $currentAuthorId = null;

    while ($row = $result->fetch_assoc()) {
        if ($currentAuthorId != $row['author_id']) {
            if ($currentAuthorId !== null) {
                echo "</ul>";
            }
            $currentAuthorId = $row['author_id'];
            echo "<h2>" . htmlspecialchars($row['author_name']) . " (Registered on: " . htmlspecialchars($row['registration_date']) . ")</h2>";
            echo "<ul>";
        }
        if ($row['co_author_name']) {
            echo "<li>" . htmlspecialchars($row['co_author_name']) . " (Date: " . htmlspecialchars($row['co_author_date']) . ", Role: " . htmlspecialchars($row['role']) . ")</li>";
        }
    }
    echo "</ul>";
} else {
    echo "No authors found.";
}

echo '<br><a href="index.php">Register a new author</a>';

$conn->close();
?>