<p><strong>Welcome, <?php echo htmlspecialchars($_SESSION['admin']['username']); ?>!</strong></p>
<a href="../ID_card.php?id=<?php echo htmlspecialchars($_SESSION['admin']['IDno']); ?>" class="button">ID</a>
<a href="include/edit_user.php?id=<?php echo htmlspecialchars($_SESSION['admin']['IDno']); ?>" class="button" style="margin-left: 5px;">Edit Profile</a>

<h2>Users Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>IDno</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Name</th>
            <th>Extension Name</th>
            <th>Gender</th>
            <th>Photo</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($usersInfoResult)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                <td><?php echo htmlspecialchars($row['Fname']); ?></td>
                <td><?php echo htmlspecialchars($row['Sname']); ?></td>
                <td><?php echo htmlspecialchars($row['Mname']); ?></td>
                <td><?php echo htmlspecialchars($row['Ename']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td>
                    <?php if (!empty($row['photo'])): ?>
                        <img src="include/uploads/<?php echo htmlspecialchars($row['photo']); ?>"
                            alt="User Photo"
                            style="width: 50px; height: 50px; object-fit: cover;"
                            onerror="this.onerror=null; this.src='uploads/default.jpg';"> <!-- Ensure default.jpg is correctly referenced -->
                    <?php else: ?>
                        <span>No Photo</span>
                    <?php endif; ?>
                </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2>Contact Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>IDno</th>
            <th>Email 1</th>
            <th>Email 2</th>
            <th>Contact 1</th>
            <th>Contact 2</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($contactResult)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                <td><?php echo htmlspecialchars($row['email1']); ?></td>
                <td><?php echo htmlspecialchars($row['email2']); ?></td>
                <td><?php echo htmlspecialchars($row['con1']); ?></td>
                <td><?php echo htmlspecialchars($row['con2']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2>Address Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>IDno</th>
            <th>Municipality</th>
            <th>City</th>
            <th>Barangay</th>
            <th>Province</th>
            <th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($addressResult)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                <td><?php echo htmlspecialchars($row['municipality']); ?></td>
                <td><?php echo htmlspecialchars($row['city']); ?></td>
                <td><?php echo htmlspecialchars($row['barangay']); ?></td>
                <td><?php echo htmlspecialchars($row['province']); ?></td>
                <td><?php echo htmlspecialchars($row['DOB']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2>Admins Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>IDno</th>
            <th>College</th>
            <th>Course</th>
            <th>Graduation Year</th>
            <th>Section</th>
            <th>Graduation Level</th>
            <th>Year Level</th>
            <th>A Level</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($adminsInfoResult)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['IDno']); ?></td>
                <td><?php echo htmlspecialchars($row['college']); ?></td>
                <td><?php echo htmlspecialchars($row['course']); ?></td>
                <td><?php echo htmlspecialchars($row['GRAD_YR']); ?></td>
                <td><?php echo htmlspecialchars($row['section']); ?></td>
                <td><?php echo htmlspecialchars($row['GRAD_LVL']); ?></td>
                <td><?php echo htmlspecialchars($row['yrLVL']); ?></td>
                <td><?php echo htmlspecialchars($row['A_LVL']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
