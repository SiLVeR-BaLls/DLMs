<?php
include '../config.php'; // Include the config file

// Initialize variables for error/success messages
$successMessage = '';
$errorMessage = '';

// Check if form is submitted via POST (non-AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approve'])) {
    // Get the Borrow ID from the form
    $ID = $_POST["ID"];

    // Handle the confirmation and book return process
    if (!empty($ID)) {
        // Check if the Borrow ID exists in the database
        $checkID = $conn->prepare("SELECT ID FROM borrow_book WHERE ID = ? AND return_date IS NULL");
        $checkID->bind_param("i", $ID);
        $checkID->execute();
        $checkID->store_result();

        if ($checkID->num_rows > 0) { // ID exists and book is still borrowed
            // Start transaction to ensure atomicity
            $conn->begin_transaction();

            // Update the return date for the borrowed book entry
            $stmt = $conn->prepare("UPDATE borrow_book SET return_date = NOW() WHERE ID = ?");
            $stmt->bind_param("i", $ID);
            $stmt->execute();

            // Update the book's status to 'Available'
            $updateBook = $conn->prepare("UPDATE book_copies SET status = 'Available' WHERE ID = ?");
            $updateBook->bind_param("i", $ID);
            $updateBook->execute();

            // Commit transaction if everything is successful
            $conn->commit();

            // Set success message
        } else {
            // Handle invalid Borrow ID or already returned books
        }
    } else {
    }
}



// Fetch search term and filter type from GET request (if any)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchBy = isset($_GET['search_by']) ? $_GET['search_by'] : 'all'; // Default to 'all' if not set

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

// Add search conditions based on selected search type and search term
if ($searchTerm != '') {
    $searchTerm = '%' . $searchTerm . '%'; // Add wildcard for SQL LIKE
    switch ($searchBy) {
        case 'title':
            $query .= " AND bc.B_title LIKE '$searchTerm'";
            break;
        case 'author':
            $query .= " AND b.author LIKE '$searchTerm'";
            break;
        case 'borrower_name':
            $query .= " AND (ui.Fname LIKE '$searchTerm' OR ui.Sname LIKE '$searchTerm')";
            break;
        case 'college':
            $query .= " AND ud.college LIKE '$searchTerm'"; 
            break;
        case 'course':
            $query .= " AND ud.course LIKE '$searchTerm'"; 
            break;
        case 'all':
        default:
            $query .= " AND (bc.B_title LIKE '$searchTerm' OR b.author LIKE '$searchTerm' OR ui.Fname LIKE '$searchTerm' OR ui.Sname LIKE '$searchTerm' OR ud.college LIKE '$searchTerm' OR ud.course LIKE '$searchTerm')";
            break;
    }
}

// Execute the query
$result = $conn->query($query); // Execute the query

// Check for query error
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>
