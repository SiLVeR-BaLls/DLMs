

<body>
    <p><strong>Welcome, <?php echo $_SESSION['admin']['username']; ?>!</strong></p>
    <a href="../ID_card.php?id=<?php echo $_SESSION['admin']['IDno']; ?>" class="button">ID</a>
    <a href="include/edit_user.php?id=<?php echo $_SESSION['admin']['IDno']; ?>" class="button" style="margin-left: 5px;">Edit Profile</a> <!-- Edit Profile Button -->

    <h2>Users Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Name</th>
            <th>Extension Name</th>
            <th>Gender</th>
            <th>Photo</th> <!-- Added Photo Column -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($usersInfoResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['Fname']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['Mname']; ?></td>
                <td><?php echo $row['Ename']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td>
                    <?php if (!empty($row['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="User Photo" style="width: 50px; height: 50px;">
                    <?php else: ?>
                        No Photo
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    
    <h2>Contact Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>Email 1</th>
            <th>Email 2</th>
            <th>Contact 1</th>
            <th>Contact 2</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($contactResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['email1']; ?></td>
                <td><?php echo $row['email2']; ?></td>
                <td><?php echo $row['con1']; ?></td>
                <td><?php echo $row['con2']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Address Information</h2>
    <table>
        <tr>
            <th>IDno</th>
            <th>Municipality</th>
            <th>City</th>
            <th>Barangay</th>
            <th>Province</th>
            <th>Date of Birth</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($addressResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['municipality']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['barangay']; ?></td>
                <td><?php echo $row['province']; ?></td>
                <td><?php echo $row['DOB']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Admins Information</h2>
    <table>
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
        <?php while ($row = mysqli_fetch_assoc($adminsInfoResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['GRAD_YR']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['GRAD_LVL']; ?></td>
                <td><?php echo $row['yrLVL']; ?></td>
                <td><?php echo $row['A_LVL']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
