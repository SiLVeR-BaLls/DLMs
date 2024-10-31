

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Registration</title>
    <link rel="stylesheet" href="css/sign_up1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header>
        <p><strong>DIGITAL LIBRARY MANAGEMENT SYSTEM</strong></p>
        
    </header>
    
    
    <main>
        

        <form id="registration-form" action="php/SignConnect.php" method="post" class="container">
            <div class="plus">
            <div class="form-step form-step-active">
    <p class="top"><b>User Information</b></p>

    <div class="group1">
        <div class="text-group">
            <label for="Fname">Firstname</label>
            <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname"  >
        </div>
        <div class="text-group">
            <label for="Sname">Surname</label>
            <input id="Sname" name="Sname" class="box" type="text" placeholder="Surname"  >
        </div>
        <div class="text-group">
            <label for="Mname">Middle Name</label>
            <input id="Mname" name="Mname" class="box" type="text" placeholder="Middle Name"  >
        </div>
    </div>

    <div class="group-1">
        <div class="group-box">
            <p class="tile">Basic Information</p>
            <div class="text-group">
                <label for="gender">Gender</label>
                <select class="box" name="gender" id="gender"  >
                    <option value="" disabled selected>Select Gender</option>
                    <option value="">Male</option>
                    <option value="f">Female</option>
                    <option value="o">Other</option>
                </select>
            </div>
            <div class="text-group">
                <label for="DOB">Birthdate</label>
                <input id="DOB" name="DOB" class="box" type="date"  >
            </div>
            <div class="text-group">
                <label for="Ename">Extension</label>
                <input class="box" name="Ename" id="Ename" placeholder="Enter Extension">
            </div>
        </div>

        <!-- Address Section -->
        <div class="group-box">
            <p class="tile">Address</p>
            <div class="text-group">
                <label for="municipality">Municipality/City</label>
                <input id="municipality" name="municipality" class="box" type="text" placeholder="Enter Municipality/City"  >
            </div>
           
            <div class="text-group">
                <label for="barangay">Barangay</label>
                <input id="barangay" name="barangay" class="box" type="text" placeholder="Enter Barangay"  >
            </div>
            <div class="text-group">
                <label for="province">Province</label>
                <input id="province" name="province" class="box" type="text" placeholder="Enter Province"  >
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="group-box">
            <p class="tile">Contact</p>
            <div class="text-group">
                <label for="con1">Contact No. 1</label>
                <input id="con1" name="con1" class="box" type="text" placeholder="09*********"   pattern="^\d{11}$" title="Please enter a valid 11-digit number">
            </div>
            <div class="text-group">
                <label for="con2">Contact No. 2</label>
                <input id="con2" name="con2" class="box" type="text" placeholder="09*********" pattern="^\d{11}$" title="Please enter a valid 11-digit number">
            </div>
            <div class="text-group">
                <label for="mail1">Email 1</label>
                <input id="mail1" name="mail1" class="box" type="email" placeholder="sample@gmail.com"  >
            </div>
            <div class="text-group">
                <label for="mail2">Email 2</label>
                <input id="mail2" name="mail2" class="box" type="email" placeholder="sample@gmail.com">
            </div>
        </div>
    </div>
</div>
            
            
<div class="form-step">
    <p class="top"><b class="tile">Site Information</b></p>

    <div class="group-1">

        <div class="group-box">
            <p class="tile">Account Information</p>

            

            <div class="text-group">
                <label for="IDno">ID Number:</label> <!-- Added label text -->
                <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)"  >
            </div>


            <div class="text-group">
                <label for="U_type">User Type</label>
                <select class="box" name="U_type" id="U_type"  >
                    <option value="" selected disabled>Select User Type</option>
                    <option value="student">Student</option>
                    <option value="professor">Professor</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

        </div>

        <div class="group-box">
            <p class="tile">Student Information</p>

            <div class="text-group">
                <label for="college">College</label>
                <select class="box" id="college" name="college"  >
                    <option value="" selected disabled>Select College</option>
                    <option value="cas">College of Arts and Sciences</option>
                    <option value="cea">College of Engineering and Architecture</option>
                    <option value="coe">College of Education</option>
                    <option value="cit">College of Industrial Technology</option>
                </select>
            </div>

            <div class="text-group">
                <label for="course">Course</label>
                <select class="box" id="course" name="course"  >
                    <option value="" selected disabled>Select Course</option>
                    <option value="course1">Course 1</option> <!-- Placeholder options -->
                    <option value="course2">Course 2</option>
                    <option value="course3">Course 3</option>
                </select>
            </div>

            <div class="text-group">
                <label for="yrLVL">Year and Section</label>
                <select class="box" id="yrLVL" name="yrLVL"  >
                <option value="" selected disabled>Select Year and Section</option>
                            <?php for ($year = 1; $year <= 5; $year++): ?>
                                <?php foreach (['A', 'B', 'C', 'D'] as $section): ?>
                                    <option value="<?php echo $year . ' ' . $section; ?>" <?php echo (isset($user['yrLVL']) && $user['yrLVL'] == "$year $section") ? 'selected' : ''; ?>>
                                        <?php echo $year . ' ' . $section; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endfor; ?>
                </select>
            </div>

        </div>
    </div>
</div>            
            
<div class="form-step">
    <p class="top"><b>User Information</b></p>

    <div class="group-1">
        <div class="group-box">
            <p class="title">Account Information</p>

            <div class="text-group">
                <label for="username">Username</label>
                <input id="username" name="username" class="box" type="text" placeholder="Enter Username"  >
            </div>

            <div class="text-group">
                <label for="password">Password</label>
                <div class="pass">
                    <input id="password" name="password" class="box" type="password" placeholder="Enter Password"  >
                    <span id="password-toggle" class="show-password" onclick="togglePasswordVisibility('password', 'password-toggle')">📚</span>
                </div>
            </div>

            <div class="text-group">
                <label for="password-repeat">Repeat Password</label>
                <div class="pass">
                    <input id="password-repeat" name="password-repeat" class="box" type="password" placeholder="Repeat Password"  >
                    <span id="password-repeat-toggle" class="show-password" onclick="togglePasswordVisibility('password-repeat', 'password-repeat-toggle')">📚</span>
                </div>
            </div>
        </div>
    </div>
</div>


            </div>

        
            <div class="button-container">
            <button type="button" class="button" id="prevBtn" disabled>Previous</button>
            <button type="button" class="button" id="nextBtn">Next</button>
            <button type="submit" class="button"  id="submitBtn" style="display:none;">Submit</button>
            <button type="reset"  class="button" id="resetBtn">Reset</button>

                <div id="error-message" class="error"></div>
            </div>
            <p>Do you have an account? <a href="log_in.php" class="but">Log In</a></p>
        </form>
    </main>
</body>
<script src="js/script.js"></script>
<script>
    document.getElementById("registration-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const requiredFields = {
            "Fname": "Firstname",
            "Sname": "Surname",
            "Mname": "Middle Name",
            "gender": "Gender",
            "DOB": "Birthdate",
            "municipality": "Municipality/City",
            "barangay": "Barangay",
            "province": "Province",
            "con1": "Contact No. 1",
            "mail1": "Email 1",
            "IDno": "ID Number",
            "U_type": "User Type",
            "college": "College",
            "course": "Course",
            "yrLVL": "Year and Section",
            "username": "Username",
            "password": "Password",
            "password-repeat": "Repeat Password"
        };

        let missingFields = [];
        Object.keys(requiredFields).forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input && !input.value.trim()) {
                missingFields.push(requiredFields[field]);
            }
        });

        if (missingFields.length > 0) {
            Swal.fire({
                title: 'Submission Error',
                text: `Please fill in the following fields: ${missingFields.join(", ")}`,
                icon: 'warning',
                confirmButtonText: 'Okay'
            });
        } else {
            Swal.fire({
                title: 'Success',
                text: 'All fields are filled! Submitting...',
                icon: 'success',
                confirmButtonText: 'Okay'
            }).then(() => {
                this.submit();
            });
        }
    });
</script>
</html>