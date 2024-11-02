<?php
// submit.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST['author_name'];
    $registrationDate = $_POST['registration_date'];
    $coAuthors = $_POST['Co_Name'];
    $coAuthorDates = $_POST['Co_Date'];
    $coAuthorRoles = $_POST['Co_Role'];

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

    // Insert the author
    $stmt = $conn->prepare("INSERT INTO authors (name, registration_date) VALUES (?, ?)");
    $stmt->bind_param("ss", $authorName, $registrationDate);
    $stmt->execute();
    $authorId = $stmt->insert_id; // Get the inserted author ID
    $stmt->close();

    // Insert co-authors
    foreach ($coAuthors as $index => $coAuthor) {
        $coAuthorDate = $coAuthorDates[$index];
        $coAuthorRole = $coAuthorRoles[$index];
        $stmt = $conn->prepare("INSERT INTO co_authors (author_id, name, co_author_date, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $authorId, $coAuthor, $coAuthorDate, $coAuthorRole);
        $stmt->execute();
        $stmt->close();
    }

    echo "Registration successful! Author ID: " . $authorId;
    echo '<br><a href="index.php">Register another author</a>';
    echo '<br><a href="display.php">View Authors</a>';

    $conn->close();
}
?>
