<?php
// register_user.php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Handle image upload
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Check file size (5MB limit)
    if ($_FILES["profile_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Allow certain file formats
    if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit();
    }

    // Upload file
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        // Insert user data into the database
        $query = "INSERT INTO users (first_name, last_name, username, password, email, status, profile_image) VALUES ('$first_name', '$last_name', '$username', '$password', '$email', 'pending', '$target_file')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: index.html"); // Redirect after registration
            exit();
        } else {
            echo "Registration failed: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
