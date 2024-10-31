
<style>
    body {
        font-family: Arial, sans-serif;        padding: 0;
        background-color: #f4f4f4; /* Light gray background */
    }

    strong {
        font-size: 24px;
    }

    p{
        margin-bottom:20px;
    }
    
    .button {
        padding: 10px 15px;
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    h2 {
        margin-top: 30px;
        font-size: 22px;
        color: #333; /* Darker color for headings */
    }

    table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* Merge borders */
        margin-bottom: 30px; /* Space between tables */
        background-color: white; /* White background for tables */
    }

    th, td {
        padding: 12px; /* Padding for cells */
        text-align: left; /* Left align text */
        border-bottom: 1px solid #dddddd; /* Light gray border */
    }

    th {
        background-color: #007bff; /* Bootstrap primary color */
        color: white; /* White text for header */
    }

    tr:hover {
        background-color: #f1f1f1; /* Light gray on row hover */
    }

    img {
        height: 50px; /* Fixed height for images */
        object-fit: cover; /* Maintain aspect ratio */
        border-radius: 50%; /* Circular images */
    }

</style>

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
                        <img src="../../pic/User//<?php echo htmlspecialchars($row['photo']); ?>"
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
