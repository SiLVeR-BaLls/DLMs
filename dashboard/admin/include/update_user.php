<?php
session_start();
include 'db_connection.php'; // Ensure your database connection is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idno = $_POST['IDno'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users_info SET Fname=?, Sname=?, course=?, yrLVL=?, section=? WHERE IDno=?");
    $stmt->bind_param("ssssss", $fname, $sname, $course, $year, $section, $idno);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
}
?>
