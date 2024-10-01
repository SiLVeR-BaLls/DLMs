<div class="form-step" id="step-1">
    <p class="top"><b>User Information</b></p>

    <div class="group1">
        <div class="text-group">
            <label for="Fname">Firstname</label>
            <input id="Fname" name="Fname" class="box" type="text" placeholder="Firstname" required>
        </div>
        <div class="text-group">
            <label for="Sname">Surname</label>
            <input id="Sname" name="Sname" class="box" type="text" placeholder="Surname" required>
        </div>
        <div class="text-group">
            <label for="Mname">Middle Name</label>
            <input id="Mname" name="Mname" class="box" type="text" placeholder="Middle Name" required>
        </div>
        <div class="text-group">
            <label for="Ename">Extension</label>
            <select  class="box" name="Ename" id="Ename" required>
                <option value="" disabled selected>Select Extension</option>
                <option value="n/a">N/A</option>
                <option value="jr">JR</option>
                <option value="sr">SR</option>
                <option value="iii">III</option>
                <option value="iv">IV</option>
                <option value="v">V</option>
            </select>
        </div>
    </div>

  <div class="group-1">
    <div class="group-box">
        <p class="tile">Basic Information</p>
        <div class="text-group">
            <label for="gender">Gender</label>
            <select class="box"  name="gender" id="gender" required>
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
            <label for="GRAD_LVL" >Grade Level</label>
            <select class="box" name="GRAD_LVL" id="GRAD_LVL" required>
                <option value="1">Primary</option>
                <option value="2">Secondary</option>
                <option value="3">Junior High School</option>
                <option value="4">Senior High School</option>
                <option value="5">Freshman</option>
                <option value="6">Sophomore</option>
                <option value="7">Junior</option>
                <option value="8">Senior</option>
                <option value="9">Graduated</option>
            </select>
        </div>
        <div class="text-group">
            <label for="GRAD_YR">Graduation Year</label>
            <input id="GRAD_YR" name="GRAD_YR" class="box" type="text" placeholder="Expected Graduation Year">
        </div>
    </div>
    <!-- Address Section -->

    <div class="group-box">
        <p class="tile">Address</p>
        <div class="text-group">
            <label for="municipality">Municipality</label>
            <input id="municipality" name="municipality" class="box" type="text" placeholder="Enter Municipality" required>
        </div>
        <div class="text-group">
            <label for="city">City</label>
            <input id="city" name="city" class="box" type="text" placeholder="Enter City" required>
        </div>
        <div class="text-group">
            <label for="barangay">Barangay</label>
            <input id="barangay" name="barangay" class="box" type="text" placeholder="Enter Barangay" required>
        </div>
        <div class="text-group">
            <label for="province">Province</label>
            <input id="province" name="province" class="box" type="text" placeholder="Enter Province" required>
        </div>
    </div>
    <!-- Contact Information Section -->

    <div class="group-box">
        <p class="tile">Contact</p>
        <div class="text-group">
            <label for="con1">Contact No. 1</label>
            <input id="con1" name="con1" class="box" type="text" placeholder="09*********" required>
        </div>
        <div class="text-group">
            <label for="con2">Contact No. 2</label>
            <input id="con2" name="con2" class="box" type="text" placeholder="09*********">
        </div>
        <div class="text-group">
            <label for="mail1">Email 1</label>
            <input id="mail1" name="mail1" class="box" type="email" placeholder="sample@gmail.com" required>
        </div>
        <div class="text-group">
            <label for="mail2">Email 2</label>
            <input id="mail2" name="mail2" class="box" type="email" placeholder="sample@gmail.com">
        </div>
    </div>
</div>
</div>
