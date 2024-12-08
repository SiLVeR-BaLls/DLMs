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
              <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname" required>
            </div>
            <div class="text-group">
              <label for="Sname">Surname</label>
              <input id="Sname" name="Sname" class="box" type="text" placeholder="Surname"required>
            </div>
            <div class="text-group">
              <label for="Mname">Middle Name</label>
              <input id="Mname" name="Mname" class="box" type="text" placeholder="Middle Name"required>
            </div>
          </div>

          <div class="group-1">
            <div class="group-box">
              <p class="tile">Basic Information</p>
              <div class="text-group">
                <label for="gender">Gender</label>
                <select class="box" name="gender" id="gender">
                  <option value="" disabled selected>Select Gender</option>
                  <option value="m">Male</option>
                  <option value="f">Female</option>
                  <option value="o">Other</option>
                </select>
              </div>
              <div class="text-group">
                <label for="DOB">Birthdate</label>
                <input id="DOB" name="DOB" class="box" type="date" required>
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
                <input id="municipality" name="municipality" class="box" type="text"
                  placeholder="Enter Municipality/City">
              </div>

              <div class="text-group">
                <label for="barangay">Barangay</label>
                <input id="barangay" name="barangay" class="box" type="text" placeholder="Enter Barangay">
              </div>
              <div class="text-group">
                <label for="province">Province</label>
                <input id="province" name="province" class="box" type="text" placeholder="Enter Province">
              </div>
            </div>

            <!-- Contact Information Section -->
            <div class="group-box">
              <p class="tile">Contact</p>
              <div class="text-group">
                <label for="con1">Contact No. 1</label>
                <input id="con1" name="con1" class="box" type="text" placeholder="09*********" pattern="^\d{11}$"
                  title="Please enter a valid 11-digit number">
              </div>

              <div class="text-group">
                <label for="email1">Email 1</label>
                <input id="email1" name="email1" class="box" type="email" placeholder="sample@gmail.com">
              </div>

            </div>
          </div>
        </div>


  <!-- siteinfo -->
<div class="form-step">
  <p class="top"><b class="tile">Site Information</b></p>

  <div class="group-1">
    <div class="group-box">
      <p class="tile">Account Information</p>
      <div class="text-group">
        <label for="IDno">ID Number:</label>
        <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)" required>
      </div>

      <div class="text-group">
        <label for="U_type">User Type</label>
        <select class="box" name="U_type" id="U_type" onchange="toggleUserType()">
          <option value="student" selected>Student</option>
          <option value="faculty">Faculty</option>
        </select>
      </div>
    </div>

    <!-- Group container for Program, Course, Year & Section, and Personnel Type -->
    <div class="group-box" id="user-info" style="display: flex; flex-direction: column;">
      <p class="tile">User Information</p>

      <!-- Program (College) -->
      <div class="text-group" style="display: flex;">
        <label for="college" style="flex: 1;">Program</label>
        <select class="box" id="college" name="college" required >
          <option value="" selected disabled>Select College</option>
          <option value="cas">College of Arts and Sciences</option>
          <option value="cea">College of Engineering and Architecture</option>
          <option value="coe">College of Education</option>
          <option value="cit">College of Industrial Technology</option>
        </select>
      </div>

      <!-- Course (only visible for students) -->
      <div class="text-group" id="course-group" style="display: flex;">
        <label for="course" style="flex: 1;">Course</label>
        <select class="box" id="course" name="course" >
          <option value="" selected disabled>Select Course</option>
          <option value="course1">Course 1</option>
          <option value="course2">Course 2</option>
          <option value="course3">Course 3</option>
        </select>
      </div>

      <!-- Year and Section (only visible for students) -->
      <div class="text-group" id="yrLVL-group" style="display: flex;">
        <label for="yrLVL" style="flex: 1;">Year and Section</label>
        <select class="box" id="yrLVL" name="yrLVL" >
          <option value="" selected disabled>Select Year and Section</option>
          <?php for ($year = 1; $year <= 5; $year++): ?>
            <?php foreach (['A', 'B', 'C', 'D'] as $section): ?>
              <option value="<?php echo $year . ' ' . $section; ?>" <?php echo (isset($user['yrLVL']) &&
                $user['yrLVL'] == "$year $section") ? 'selected' : ''; ?>>
                <?php echo $year . ' ' . $section; ?>
              </option>
            <?php endforeach; ?>
          <?php endfor; ?>
        </select>
      </div>

      <!-- Personnel Type (only visible for faculty) -->
      <div class="text-group" id="personnel-group" style="display: flex; display: none;">
        <label for="personnel_type" style="flex: 1;">Personnel Type</label>
        <select class="box" id="personnel_type" name="personnel_type" >
          <option value="" selected disabled>Select Personnel Type</option>
          <option value="Teaching Personnel">Teaching Personnel</option>
          <option value="Non-Teaching Personnel">Non-Teaching Personnel</option>
        </select>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript function to toggle between student and faculty info -->
<script>
  function toggleUserType() {
    const userType = document.getElementById("U_type").value;
    const courseGroup = document.getElementById("course-group");
    const yrLVLGroup = document.getElementById("yrLVL-group");
    const personnelGroup = document.getElementById("personnel-group");

    if (userType === "faculty") {
      // For faculty: Hide Course and Year & Section, and show Personnel Type
      courseGroup.style.display = "none";
      yrLVLGroup.style.display = "none";
      personnelGroup.style.display = "flex";  // Show Personnel Type
    } else {
      // For student: Show Course and Year & Section, and hide Personnel Type
      courseGroup.style.display = "flex";
      yrLVLGroup.style.display = "flex";
      personnelGroup.style.display = "none";  // Hide Personnel Type
    }
  }

  // Call the toggle function on page load to ensure the correct form is displayed
  window.onload = function () {
    toggleUserType();
  };
</script>


<!-- pass mail -->
        <div class="form-step">
          <p class="top"><b>User Information</b></p>

          <div class="group-1">
            <div class="group-box">
              <p class="title">Account Information</p>

              <div class="text-group">
                <label for="username">Username</label>
                <input id="username" name="username" class="box" type="text" placeholder="Enter Username">
              </div>

              <div class="text-group">
                <label for="password">Password</label>
                <div class="pass">
                  <input id="password" name="password" class="box" type="password" placeholder="Enter Password">
                  <span id="password-toggle" class="show-password"
                    onclick="togglePasswordVisibility('password', 'password-toggle')">📚</span>
                </div>
                <small id="password-message"></small>
              </div>

              <div class="text-group">
                <label for="password-repeat">Repeat Password</label>
                <div class="pass">
                  <input id="password-repeat" name="password-repeat" class="box" type="password"
                    placeholder="Repeat Password">
                  <span id="password-repeat-toggle" class="show-password"
                    onclick="togglePasswordVisibility('password-repeat', 'password-repeat-toggle')">📚</span>
                </div>
                <small id="password-repeat-message"></small>
              </div>


            </div>
          </div>
        </div>


      </div>

        <div id="error-message" class="error"></div>

      <div class="button-container">
        <button type="button" class="button" id="prevBtn" disabled>Previous</button>
        <button type="button" class="button" id="nextBtn">Next</button>
        <button type="submit" class="button" id="submitBtn" style="display:none;">Submit</button>
      </div>
      <p>Do you have an account? <a href="log_in.php" class="but">Log In</a></p>
    </form>
  </main>
</body>
<script src="js/script.js"></script>
<script>
  document.getElementById("registration-form").addEventListener("submit", function (event) {
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
      "email1": "Email 1",
      "IDno": "ID Number",
      "U_type": "User Type",
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


<!-- Add the following CSS for validation feedback -->
<style>
  .valid {
    background-color: #d4edda;
    /* Green background for valid */
    border-color: #28a745;
    /* Green border for valid */
  }

  .invalid {
    background-color: #f8d7da;
    /* Red background for invalid */
    border-color: #dc3545;
    /* Red border for invalid */
  }

  small {
    display: block;
    font-size: 12px;
    margin-top: 5px;
  }

  .error-message {
    color: #dc3545;
    font-size: 14px;
    margin-top: 10px;
    /* Red for error message */
  }

  .success-message {
    color: #28a745;
    /* Green for success message */
  }

</style>

<!-- Add the following JavaScript for validation and feedback -->
<script>
  // Function to validate password
  function validatePassword() {
    const password = document.getElementById('password').value;
    const passwordMessage = document.getElementById('password-message');
    const passwordRepeat = document.getElementById('password-repeat').value;
    const passwordField = document.getElementById('password');
    const passwordRepeatField = document.getElementById('password-repeat');

    // Updated regex to include special characters like '-', '_', and others
    const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>_\-])[A-Za-z\d!@#$%^&*(),.?":{}|<>_\-]{8,}$/;

    if (passwordRegex.test(password)) {
      passwordField.classList.remove('invalid');
      passwordField.classList.add('valid');
      passwordMessage.textContent = "Password requirement complete";
      passwordMessage.classList.remove('error-message');
      passwordMessage.classList.add('success-message');
    } else {
      passwordField.classList.remove('valid');
      passwordField.classList.add('invalid');
      passwordMessage.textContent = "Password does not meet recommended format";
      passwordMessage.classList.remove('success-message');
      passwordMessage.classList.add('error-message');
    }

    // Validate password confirmation
    if (password !== passwordRepeat) {
      passwordRepeatField.classList.add('invalid');
      document.getElementById('password-repeat-message').textContent = "Passwords do not match";
      document.getElementById('password-repeat-message').classList.add('error-message');
    } else {
      passwordRepeatField.classList.remove('invalid');
      document.getElementById('password-repeat-message').textContent = "";
    }
  }

  // Add event listeners to both password fields for real-time validation
  document.getElementById('password').addEventListener('input', validatePassword);
  document.getElementById('password-repeat').addEventListener('input', validatePassword);
</script>

<!-- Add the following JavaScript to handle validation -->
<script>
  // Validate contact number (11 digits)
  document.getElementById('con1').addEventListener('input', function () {
    const contact = this.value;
    const isValid = /^\d{11}$/.test(contact);  // Check if it's 11 digits
    this.classList.toggle('valid', isValid);  // Apply 'valid' class
    this.classList.toggle('invalid', !isValid);  // Apply 'invalid' class
  });

  // Validate email format
  document.getElementById('email1').addEventListener('input', function () {
    const email = this.value;
    const isValid = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
    this.classList.toggle('valid', isValid);  // Apply 'valid' class
    this.classList.toggle('invalid', !isValid);  // Apply 'invalid' class
  });
</script>

</html>