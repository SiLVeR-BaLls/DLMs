<?php
    $Fname = $_POST['Fname'];
    $Sname = $_POST['Sname'];
    $Mname = $_POST['Mname'];
    $DOB = $_POST['DOB'];
    $position = $_POST['position'];
    $gender = $_POST['gender'];
    $dept = $_POST['dept'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Contact = $_POST['Contact'];   
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    // Hash the password for security
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost','root','','system');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration(Fname, Sname, Mname, DOB, position, gender, dept, Email, Address, Contact, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $Fname, $Sname, $Mname, $DOB, $position, $gender, $dept, $Email, $Address, $Contact, $Username, $hashedPassword);
        $execval = $stmt->execute();

        // Determine the prefix based on gender
        $prefix = '';
        if ($gender === 'm') {
            $prefix = 'Mr.';
        } elseif ($gender === 'f') {
            $prefix = 'Ms.';
        } else {
            $prefix = 'SMr.'; // Use a gender-neutral prefix or "Other" for unspecified genders
        }

        // Full name with prefix
        $fullName = $prefix . ' ' . htmlspecialchars($Sname) . ' ' . htmlspecialchars($Fname);

        // Load the HTML template
        $htmlTemplate = file_get_contents('confirmation.html');

        // Replace placeholders with actual values
        $htmlOutput = str_replace(
            ['{{registration_status}}', '{{full_name}}', '{{email}}'],
            [$execval ? 'Registration Successful!' : 'Registration Failed!', $fullName, htmlspecialchars($Email)],
            $htmlTemplate
        );

        // Output the final HTML
        echo $htmlOutput;

        $stmt->close();
        $conn->close();
    }
?>
