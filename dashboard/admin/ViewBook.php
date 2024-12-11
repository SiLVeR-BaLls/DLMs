<!-- ViewBook.php -->
<?php
    include '../config.php';

    // Initialize message variables
    $message = "";
    $message_type = "";

    // Define the target directory for photos
    $targetDir = '../../pic/Book/';

    // Get the book title from the query string
    $title = $_GET['title'] ?? '';

    if ($title) {
        // Fetch the book details
        $sql = "SELECT * FROM Book WHERE B_title = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $title);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                $message = "No book found with that title.";
                $message_type = "error";
            } else {
                $book = $result->fetch_assoc();
                
                // Handle photo upload
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                    // Validate image format
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                    $file_type = mime_content_type($_FILES['photo']['tmp_name']);

                    if (!in_array($file_type, $allowed_types)) {
                        echo "<script>alert('Invalid image format. The image format should be JPG, PNG, or GIF.');</script>";
                        echo '<script>window.history.back();</script>';
                        exit;
                    }

                    // Fetch the current photo from the database
                    $sql = "SELECT photo FROM Book WHERE B_title = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $title);
                    $stmt->execute();
                    $stmt->bind_result($currentPhoto);
                    $stmt->fetch();
                    $stmt->close();

                    // Delete the current photo from the server if it exists
                    if ($currentPhoto) {
                        $current_photo_path = $targetDir . $currentPhoto;
                        if (file_exists($current_photo_path)) {
                            unlink($current_photo_path); // Delete the current photo
                        }
                    }

                    // Check if the uploads directory exists; if not, create it
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0755, true); // Create directory with appropriate permissions
                    }

                    // Set the photo name and ensure it is unique
                    $photo_name = pathinfo($_FILES['photo']['name'], PATHINFO_FILENAME);
                    $photo_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    $photo = $photo_name . "_" . time() . "." . $photo_extension; // Append timestamp to avoid collision
                    $targetFilePath = $targetDir . $photo;

                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                        // Update the database with the new photo path
                        $updateSql = "UPDATE Book SET photo = ? WHERE B_title = ?";
                        $updateStmt = $conn->prepare($updateSql);
                        $updateStmt->bind_param("ss", $photo, $title);
                        $updateStmt->execute();
                        $updateStmt->close();
                    } else {
                        $message = "Error uploading photo.";
                        $message_type = "error";
                    }
                }

                // Fetch related data using a helper function
                function fetch_related_data($conn, $query, $title) {
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $title);
                    $stmt->execute();
                    return $stmt->get_result();
                }
            }
        } else {
            $message = "Error executing query: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "No book title provided.";
        $message_type = "error";
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLMs</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow ">
        <!-- Header at the Top -->
        <?php include 'include/header.php'; ?>

      <div class="container mx-auto px-4 py-6 ">

<!-- Breadcrumb Section -->
<div class="text-sm text-gray-600 mb-4">
    <a href="index.php" class="hover:text-blue-800 hover:underline">Home</a> &rarr;
    <a href="ViewBook.php?title=<?php echo urlencode($book['B_title']); ?>" class="hover:text-blue-800 hover:underline">
        <?php echo htmlspecialchars($book['B_title']); ?>
    </a>
</div>


            <!-- Message -->
            <?php if ($message): ?>
            <div class="mb-4 p-4 text-center rounded-lg <?php echo $message_type === 'error' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600'; ?>">
                <?php echo $message; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($book)): ?>
                <a href="index.php" class="hover:text-blue-800 hover:underline">&larr; Back</a>
            <div class="text-center mb-6">
                
                <?php if ($book['photo']): ?>
                <img src="../../pic/Book/<?php echo htmlspecialchars($book['photo']); ?>" alt="Book Photo"
                    class="w-48 h-48 mx-auto rounded-lg shadow-md">
                <?php endif; ?>

                <h2 class="text-3xl font-semibold mt-4">
                    <?php echo htmlspecialchars($book['B_title']); ?>
                </h2>

                <div class="flex justify-center gap-4 mt-4">
                    <a href="edit_book.php?title=<?php echo urlencode($book['B_title']); ?>"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                    <a href="AddBookCopy.php?title=<?php echo urlencode($book['B_title']); ?>"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Copy</a>
                    <a href="BookList.php?title=<?php echo urlencode($book['B_title']); ?>"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">List</a>
                </div>
            </div>

            <!-- Book Information Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">General Information</h3>
                    <p><strong>Subtitle:</strong> <?php echo htmlspecialchars($book['subtitle']); ?></p>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Edition:</strong> <?php echo htmlspecialchars($book['edition']); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Identifiers</h3>
                    <p><strong>LCCN:</strong> <?php echo htmlspecialchars($book['LCCN']); ?></p>
                    <p><strong>ISBN:</strong> <?php echo htmlspecialchars($book['ISBN']); ?></p>
                    <p><strong>ISSN:</strong> <?php echo htmlspecialchars($book['ISSN']); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Classification</h3>
                    <p><strong>Material Type:</strong> <?php echo htmlspecialchars($book['MT']); ?></p>
                    <p><strong>Subject Type:</strong> <?php echo htmlspecialchars($book['ST']); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Publication Details</h3>
                    <p><strong>Place:</strong> <?php echo htmlspecialchars($book['place']); ?></p>
                    <p><strong>Publisher:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
                    <p><strong>Publication Date:</strong> <?php echo htmlspecialchars($book['Pdate']); ?></p>
                    <p><strong>Copyright:</strong> <?php echo htmlspecialchars($book['copyright']); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Physical Details</h3>
                    <p><strong>Extent:</strong> <?php echo htmlspecialchars($book['extent']); ?></p>
                    <p><strong>Other Details:</strong> <?php echo htmlspecialchars($book['Odetail']); ?></p>
                    <p><strong>Size:</strong> <?php echo htmlspecialchars($book['size']); ?></p>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8">
    <h3 class="text-2xl font-semibold mb-4">Additional Information</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Co-authors -->
                    

         

        <!-- Series -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Series</h4>
            <ul class="list-none list-inside">
                <li>Volume <?php echo htmlspecialchars($book['volume']); ?> - <?php echo htmlspecialchars($book['IL']); ?> (<?php echo htmlspecialchars($book['F_and_P']); ?>)</li>
            </ul>
        </div>

        <!-- Subjects -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Subjects</h4>
            <ul class="list-none list-inside">
                <li><?php echo htmlspecialchars($book['Sub_Head']) . ": " . htmlspecialchars($book['Sub_Head_input']); ?></li>
            </ul>
        </div>

        <!-- Resources -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Resources</h4>
            <ul class="list-none list-inside">
                <?php if (!empty($book['url']) && !empty($book['Description'])): ?>
                    <li><a href="<?php echo htmlspecialchars($book['url']); ?>" class="text-blue-500 underline" target="_blank"><?php echo htmlspecialchars($book['Description']); ?></a></li>
                <?php elseif (!empty($book['url'])): ?>
                    <li><a href="<?php echo htmlspecialchars($book['url']); ?>" class="text-blue-500 underline" target="_blank">No description available</a></li>
                <?php elseif (!empty($book['Description'])): ?>
                    <li><?php echo htmlspecialchars($book['Description']); ?></li>
                <?php else: ?>
                    <li>No link or description available.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Alternate Titles -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Alternate Titles</h4>
            <ul class="list-none list-inside">
                <li><?php echo htmlspecialchars($book['UTitle']); ?></li>
                <li><?php echo htmlspecialchars($book['VForm']); ?></li>
                <li><?php echo htmlspecialchars($book['SUTitle']); ?></li>
            </ul>
        </div>
    </div>
</div>

            <?php endif; ?>
        </div>

          <!-- Footer at the Bottom -->
          <footer class="bg-blue-600 text-white mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>
</body>

</html>