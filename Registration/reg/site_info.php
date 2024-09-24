<div class="form-step" id="step-2" style="display:none;">
    <p class="top"><b class="tile">Site Information</b></p>

    <div class="group-1">

        <div class="group-box">
            <p class="tile">Account Information</p>

            <label>
                <input type="radio" name="id-type" value="manual" onclick="toggleIdInput(true)" checked> Manual ID
            </label>
            <label>
                <input type="radio" name="id-type" value="default" onclick="toggleIdInput(false)"> Default ID
            </label>
            
            <div id="manual-id-container" class="form-group" style="display: block;">
                <label for="IDno">ID No.</label>
                <input type="text" id="IDno" name="IDno" class="box" placeholder="Enter ID (if Manual)">
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

            <div class="text-group">
                <label for="A_LVL">Access Level</label>
                <select class="box" id="A_LVL" name="A_LVL" required>
                    <option value="" disabled selected>Select Academic Level</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                </select>
            </div>

            <div class="text-group">
                <label for="status">Status</label>
                <select class="box" name="status" id="status" required>
                    <option value="" selected disabled>Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="restricted">Restricted</option>
                </select>
            </div>
        </div>

        <div class="group-box">
        <p class="tile">Account Information</p>

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
                    <!-- Options will be dynamically added -->
                </select>
            </div>

            <div class="text-group">
                <label for="yrLVL">Year</label>
                <select class="box"  id="yrLVL" name="yrLVL" required>
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
                <select class="box"  id="section" name="section" required>
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
