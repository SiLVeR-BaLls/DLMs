<div class="form-step">
    <p class="top"><b class="tile">Site Information</b></p>

    <div class="group-1">

        <div class="group-box">
            <p class="tile">Account Information</p>

            <label>
                <input type="radio" name="id-type" value="manual" onclick="toggleIdInput(true)" checked> Campus ID
            </label>
            <label>
                <input type="radio" name="id-type" value="default" onclick="toggleIdInput(false)"> Legal ID
            </label>
            
            <div id="manual-id-container" class="form-group" style="display: block;">
                <label for="IDno">ID Number:</label> <!-- Added label text -->
                <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)" required>
            </div>

            <div class="text-group">
                <label for="U_type">User Type</label>
                <select class="box" name="U_type" id="U_type" required>
                    <option value="" selected disabled>Select User Type</option>
                    <option value="student">Student</option>
                    <option value="professor">Professor</option>
                    <option value="staff">Staff</option>
                    <option value="visitor">Visitor</option>
                </select>
            </div>

          
        </div>

        <div class="group-box">
            <p class="tile">Student Information</p>

            <div class="text-group">
                <label for="college">College</label>
                <select class="box" id="college" name="college" required>
                    <option value="" selected disabled>Select College</option>
                    <option value="cas">College of Arts and Sciences</option>
                    <option value="cea">College of Engineering and Architecture</option>
                    <option value="coe">College of Education</option>
                    <option value="cit">College of Industrial Technology</option>
                </select>
            </div>

            <div class="text-group">
                <label for="course">Course</label>
                <select class="box" id="course" name="course" required>
                    <option value="" selected disabled>Select Course</option>
                    <option value="course1">Course 1</option> <!-- Placeholder options -->
                    <option value="course2">Course 2</option>
                    <option value="course3">Course 3</option>
                </select>
            </div>

            <div class="text-group">
                <label for="yrLVL">Year Level</label>
                <select class="box" id="yrLVL" name="yrLVL" required>
                    <option value="" selected disabled>Select Year Level</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="text-group">
                <label for="section">Section</label>
                <select class="box" id="section" name="section" required>
                    <option value="" selected disabled>Select Section</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            </div>
        </div>
    </div>
</div>
