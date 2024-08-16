<?php include 'app/includes/inc_sign_up.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Registration</title>
    <link rel="stylesheet" href="css/sign_up.css">
</head>
<body>
    <div class="registration-container">
        <div class="form-section">
            <form method="post">
                <input type="text" placeholder="Firstname" id="Fname" name="Fname" required>
                <input type="text" placeholder="Surname" id="Sname" name="Sname" required>
                <input type="text" placeholder="Middle Name" id="Mname" name="Mname">
                <input type="date" placeholder="Birth Date" id="DOB" name="DOB" required>
                <select required name="position">
                    <option value="" disabled selected>Type of User</option>
                    <option value="s">Student</option>
                    <option value="f">Faculty</option>
                </select>
                <select name="gender" id="gender">
                    <option value="" disabled selected>Gender</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    <option value="o">Other</option>
                </select>
                <select required name="dept">
                    <option value="" disabled selected>Department</option>
                    <option value="s1">Sample 1</option>
                    <option value="s2">Sample 2</option>
                </select>
                <input type="email" placeholder="Email" name="Email" id="Email" required>
                <input type="text" placeholder="Address" name="Address" id="Address" required>
                <input type="text" placeholder="Contact no." name="Contact" id="Contact" required>

                <input type="text" placeholder="Username" name="Username" id="Username" required>
                <input type="Password" placeholder="Password" name="Password" id="Password" required>
                <div>
                    <button type="submit" class="button">Register</button>
                    <button type="reset" class="button">Reset</button>
                    <button type="button" class="button" onclick="history.back()">Back</button>
                </div>
            </form>
        </div>
        <div class="info-section">
            <img src="images/logo-removebg-preview.png" alt="Digital Library Logo">
            <h1>Digital Library Management System</h1>
        </div>
    </div>
</body>
</html>
