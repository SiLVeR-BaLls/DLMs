<?php
include '../config.php';

// Initialize variables
$message = "";
$message_type = "";

// Check connection
if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
    $message_type = "error";
} else {
    // Fetch all books
    $sql = "SELECT B_title, author, (SELECT GROUP_CONCAT(Co_Name SEPARATOR ', ') FROM CoAuthor WHERE B_title = Book.B_title) AS coauthors, LCCN, ISBN, ISSN, MT, extent FROM Book";
    $result = $conn->query($sql);
}
?>
  <title>Browse Books</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootsrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <body>
<div class="container mt-5">
    <h2>Browse Books</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Co-authors</th>
                <th>LCCN</th>
                <th>ISBN</th>
                <th>ISSN</th>
                <th>Material Type</th>
                <th>Extent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['B_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['coauthors']); ?></td>
                        <td><?php echo htmlspecialchars($row['LCCN']); ?></td>
                        <td><?php echo htmlspecialchars($row['ISBN']); ?></td>
                        <td><?php echo htmlspecialchars($row['ISSN']); ?></td>
                        <td><?php echo htmlspecialchars($row['MT']); ?></td>
                        <td><?php echo htmlspecialchars($row['extent']); ?></td>
                        <td>
                            <a href="include/ViewBook.php?title=<?php echo urlencode($row['B_title']); ?>" class="btn btn-info">View</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No books found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
$conn->close();
?>
