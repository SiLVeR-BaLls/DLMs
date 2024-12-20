<?php
include '../config.php';


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

      <form id="registration-form" action="php/SignConnect.php" method="post" class="container mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
  <div class="plus">

    <!-- User Information Section -->
    <div class="form-step form-step-active">
      <p class="text-xl font-bold text-center mb-4">User Information</p>

      <div class="flex  gap-4">
        <div class="text-group">
          <label for="Fname" class="block text-sm font-medium text-gray-700 w-screen">Firstname</label>
          <input id="Fname" name="Fname" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Firstname" required>
        </div>
        <div class="text-group">
          <label for="Sname" class="block text-sm font-medium text-gray-700 w-screen">Surname</label>
          <input id="Sname" name="Sname" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Surname" required>
        </div>
        <div class="text-group">
          <label for="Mname" class="block text-sm font-medium text-gray-700 w-screen">Middle Name</label>
          <input id="Mname" name="Mname" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Middle Name" required>
        </div>
      </div>

      <!-- Basic Information Section -->
      <div class="flex   gap-4 mt-4">
        <div class="group-box bg-gray-50 p-4 rounded-lg shadow">
          <p class="text-lg font-bold text-gray-800">Basic Information</p>
          <div class="text-group">
            <label for="Sex" class="block text-sm font-medium text-gray-700 w-screen">Sex</label>
            <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" name="Sex" id="Sex">
              <option value="" disabled selected>Select Sex</option>
              <option value="m">Male</option>
              <option value="f">Female</option>
              <option value="o">Other</option>
            </select>
          </div>
          <div class="text-group">
            <label for="DOB" class="block text-sm font-medium text-gray-700 w-screen">Birthdate</label>
            <input id="DOB" name="DOB" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="date" required>
          </div>
          <div class="text-group">
            <label for="Ename" class="block text-sm font-medium text-gray-700 w-screen">Extension</label>
            <input class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" name="Ename" id="Ename" placeholder="Enter Extension">
          </div>
        </div>

        <!-- Address Section -->
        <div class="group-box bg-gray-50 p-4 rounded-lg shadow">
          <p class="text-lg font-bold text-gray-800">Address</p>
          <div class="text-group">
            <label for="municipality" class="block text-sm font-medium text-gray-700 w-screen">Municipality/City</label>
            <input id="municipality" name="municipality" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Enter Municipality/City">
          </div>

          <div class="text-group">
            <label for="barangay" class="block text-sm font-medium text-gray-700 w-screen">Barangay</label>
            <input id="barangay" name="barangay" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Enter Barangay">
          </div>
          <div class="text-group">
            <label for="province" class="block text-sm font-medium text-gray-700 w-screen">Province</label>
            <input id="province" name="province" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Enter Province">
          </div>
        </div>
      </div>

      <!-- Contact Information Section -->
      <div class="group-box bg-gray-50 p-4 rounded-lg shadow mt-4">
        <p class="text-lg font-bold text-gray-800">Contact</p>
        <div class="text-group">
          <label for="contact" class="block text-sm font-medium text-gray-700 w-screen">Contact No. 1</label>
          <input id="contact" name="contact" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="09*********" pattern="^\d{11}$" title="Please enter a valid 11-digit number">
        </div>

        <div class="text-group">
          <label for="email" class="block text-sm font-medium text-gray-700 w-screen">Email 1</label>
          <input id="email" name="email" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" placeholder="sample@gmail.com">
        </div>
      </div>
    </div>

    <!-- Site Information Section -->
    <div class="form-step mt-6">
      <p class="text-xl font-bold text-center mb-4">Site Information</p>

      <div class="group-box bg-gray-50 p-4 rounded-lg shadow">
        <p class="text-lg font-bold text-gray-800">Account Information</p>
        <div class="text-group">
          <label for="IDno" class="block text-sm font-medium text-gray-700 w-screen">ID Number</label>
          <input type="text" id="IDno" name="IDno" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter ID (if Manual)" required>
        </div>

        <div class="text-group">
          <label for="U_Type" class="block text-sm font-medium text-gray-700 w-screen">User Type</label>
          <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" name="U_Type" id="U_Type" onchange="toggleUserType()">
            <option value="student" selected>Student</option>
            <option value="faculty">Faculty</option>
          </select>
        </div>
      </div>

      <!-- Group container for Program, Course, Year & Section, and Personnel Type -->
      <div class="group-box bg-gray-50 p-4 rounded-lg shadow mt-4" id="user-info">
        <p class="text-lg font-bold text-gray-800">User Information</p>

        <div class="text-group">
          <label for="college" class="block text-sm font-medium text-gray-700 w-screen">Program</label>
          <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" id="college" name="college" required>
            <option value="" selected disabled>Select College</option>
            <option value="cas">College of Arts and Sciences</option>
            <option value="cea">College of Engineering and Architecture</option>
            <option value="coe">College of Education</option>
            <option value="cit">College of Industrial Technology</option>
          </select>
        </div>

        <!-- Course (only visible for students) -->
        <div class="text-group" id="course-group" style="display: flex;">
          <label for="course" class="block text-sm font-medium text-gray-700 w-screen">Course</label>
          <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" id="course" name="course">
            <option value="" selected disabled>Select Course</option>
            <option value="course1">Course 1</option>
            <option value="course2">Course 2</option>
            <option value="course3">Course 3</option>
          </select>
        </div>

        <!-- Year and Section (only visible for students) -->
        <div class="text-group" id="yrLVL-group" style="display: flex;">
          <label for="yrLVL" class="block text-sm font-medium text-gray-700 w-screen">Year and Section</label>
          <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" id="yrLVL" name="yrLVL">
            <option value="" selected disabled>Select Year and Section</option>
            <?php for ($year = 1; $year <= 5; $year++): ?>
            <?php foreach (['A', 'B', 'C', 'D'] as $section): ?>
            <option value="<?php echo $year . ' ' . $section; ?>" <?php echo (isset($user['yrLVL']) && $user['yrLVL']=="$year $section" ) ? 'selected' : '' ; ?>>
              <?php echo $year . ' ' . $section; ?>
            </option>
            <?php endforeach; ?>
            <?php endfor; ?>
          </select>
        </div>

        <!-- Personnel Type (only visible for faculty) -->
        <div class="text-group" id="personnel-group" >
          <label for="personnel_type" class="block text-sm font-medium text-gray-700 w-screen">Personnel Type</label>
          <select class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" id="personnel_type" name="personnel_type">
            <option value="" selected disabled>Select Personnel Type</option>
            <option value="Teaching Personnel">Teaching Personnel</option>
            <option value="Non-Teaching Personnel">Non-Teaching Personnel</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Account Information Section -->
    <div class="form-step mt-6">
      <p class="text-xl font-bold text-center mb-4">Account Information</p>

      <div class="group-box bg-gray-50 p-4 rounded-lg shadow">
        <div class="text-group">
          <label for="username" class="block text-sm font-medium text-gray-700 w-screen">Username</label>
          <input id="username" name="username" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Enter Username">
        </div>

        <div class="text-group">
          <label for="password" class="block text-sm font-medium text-gray-700 w-screen">Password</label>
          <div class="pass relative">
            <input id="password" name="password" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" placeholder="Enter Password">
            <span id="password-toggle" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-xl">📚</span>
          </div>
          <small id="password-message" class="text-xs text-red-500"></small>
        </div>

        <div class="text-group">
          <label for="password-repeat" class="block text-sm font-medium text-gray-700 w-screen">Repeat Password</label>
          <div class="pass relative">
            <input id="password-repeat" name="password-repeat" class="box w-1/4 p-1.5 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" placeholder="Repeat Password">
            <span id="password-repeat-toggle" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-xl">📚</span>
          </div>
          <small id="password-repeat-message" class="text-xs text-red-500"></small>
        </div>
      </div>
    </div>

  </div>

  <div id="error-message" class="error text-red-500 text-center mt-4"></div>

  <div class="button-container mt-6 text-center">
    <button type="submit" class="button bg-green-500 p-3 rounded-lg text-white hover:bg-green-600" id="submitBtn">Submit</button>
  </div>

  <p class="text-center text-sm mt-4">Do you have an account? <a href="log_in.php" class="text-blue-500 hover:underline">Log In</a></p>
</form>

   
      <!-- Footer at the Bottom -->
      <footer class="bg-blue-600 text-white mt-auto">
        <?php include 'include/footer.php'; ?>
      </footer>
  </main>

</body>
<script src="../../Registration/js/script.js"></script>

</html>