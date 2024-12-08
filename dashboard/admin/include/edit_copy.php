<?php
include '../../config.php';

// Initialize message variables
$message = "";
$message_type = "";

// Get the copy ID from the URL
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';

// Fetch the current copy details from the database
$sql = "SELECT * FROM book_copies WHERE ID = '" . $conn->real_escape_string($ID) . "'";
$result = $conn->query($sql);

if (!$result) {
    $message = "Error retrieving copy details: " . $conn->error;
    $message_type = "error";
    $copy_data = [];
} elseif ($result->num_rows == 0) {
    $message = "No copy found with the specified ID.";
    $message_type = "warning";
    $copy_data = [];
} else {
    $copy_data = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $B_title = isset($_POST['B_title']) ? $_POST['B_title'] : '';
    $copy_ID = isset($_POST['copy_ID']) ? $_POST['copy_ID'] : '';
    $callNumber = isset($_POST['callNumber']) ? $_POST['callNumber'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $vendor = isset($_POST['vendor']) ? $_POST['vendor'] : '';
    $fundingSource = isset($_POST['fundingSource']) ? $_POST['fundingSource'] : '';
    $Sublocation = isset($_POST['Sublocation']) ? $_POST['Sublocation'] : '';
    $rating = isset($_POST['rating']) ? $_POST['rating'] : '';

    // Update the book copy in the database
    $update_sql = "UPDATE book_copies SET 
        B_title = '" . $conn->real_escape_string($B_title) . "',
        copy_ID = '" . $conn->real_escape_string($copy_ID) . "',
        callNumber = '" . $conn->real_escape_string($callNumber) . "',
        status = '" . $conn->real_escape_string($status) . "',
        vendor = '" . $conn->real_escape_string($vendor) . "',
        fundingSource = '" . $conn->real_escape_string($fundingSource) . "',
        Sublocation = '" . $conn->real_escape_string($Sublocation) . "',
        rating = '" . $conn->real_escape_string($rating) . "' 
        WHERE ID = '" . $conn->real_escape_string($ID) . "'";

    if ($conn->query($update_sql) === TRUE) {
        $message = "Copy updated successfully.";
        $message_type = "success";
    } else {
        $message = "Error updating copy: " . $conn->error;
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Copy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 px-4">
        <a href="../viewcopy.php?ID=<?php echo urlencode($copy_data['ID']); ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Return to Copy Details</a>

        <h2 class="text-2xl font-semibold mt-4 mb-4">Edit Copy</h2>
        <?php if ($message): ?>
            <div class="p-4 mb-4 text-white <?php echo $message_type === 'success' ? 'bg-green-500' : ($message_type === 'warning' ? 'bg-yellow-500' : 'bg-red-500'); ?> rounded">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($copy_data)): ?>
            <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Title</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="B_title" name="B_title" value="<?php echo htmlspecialchars($copy_data['B_title']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Copy ID</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="copy_ID" name="copy_ID" value="<?php echo htmlspecialchars($copy_data['copy_ID']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Call Number</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="callNumber" name="callNumber" value="<?php echo htmlspecialchars($copy_data['callNumber']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Status</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="status" name="status" required>
                                    <option value="Available" <?php echo $copy_data['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="Borrowed" <?php echo $copy_data['status'] == 'Borrowed' ? 'selected' : ''; ?>>Borrowed</option>
                                    <option value="Weeding" <?php echo $copy_data['status'] == 'Weeding' ? 'selected' : ''; ?>>Weeding</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Vendor</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="vendor" name="vendor" value="<?php echo htmlspecialchars($copy_data['vendor']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Funding Source</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="fundingSource" name="fundingSource" value="<?php echo htmlspecialchars($copy_data['fundingSource']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Sublocation</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="Sublocation" name="Sublocation" value="<?php echo htmlspecialchars($copy_data['Sublocation']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">Rating</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline" id="rating" name="rating" required>
                                    <option value="0" <?php echo $copy_data['rating'] == '0' ? 'selected' : ''; ?>>0</option>
                                    <option value="1" <?php echo $copy_data['rating'] == '1' ? 'selected' : ''; ?>>1</option>
                                    <option value="2" <?php echo $copy_data['rating'] == '2' ? 'selected' : ''; ?>>2</option>
                                    <option value="3" <?php echo $copy_data['rating'] == '3' ? 'selected' : ''; ?>>3</option>
                                    <option value="4" <?php echo $copy_data['rating'] == '4' ? 'selected' : ''; ?>>4</option>
                                    <option value="5" <?php echo $copy_data['rating'] == '5' ? 'selected' : ''; ?>>5</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save Changes</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
