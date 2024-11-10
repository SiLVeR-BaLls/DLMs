<style>
    /* General page styling */
    body {
        background-color: #f8f8f8; /* Slightly lighter gray background */
        color: #333;
        font-family: Arial, sans-serif;
    }

    /* Welcome message styling */
    p {
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        font-weight: bold;
    }

    /* Button styling */
    .button {
        padding: 0.5rem 1rem;
        color: #fff;
        background-color: #333;
        border: 2px solid #333;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .button:hover {
        background-color: #555;
        color: #fff;
    }

    /* Header styling */
    h2 {
        color: #333;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        border-bottom: 2px solid #333;
        padding-bottom: 0.5rem;
    }

    /* Table styling */
    .table {
        margin: 10px; /* Add margin around the table */
    }

    .table-bordered {
        border: 2px solid #333; /* 2px black border for tables */
        margin-bottom: 1.5rem;
        background-color: #fff;
        border-spacing: 0; /* Ensures borders don't overlap */
        width: calc(100% - 20px); /* Adjust width to account for margin */
    }

    .table-bordered th {
        background-color: #333;
        color: #ffffff;
        border: 2px solid #333;
        text-align: center;
        padding: 0.75rem;
        font-weight: bold;
    }

    .table-bordered td,
    .table-bordered th {
        border: 2px solid #333; /* 2px border around cells */
        text-align: center;
        padding: 0.75rem;
        vertical-align: middle;
    }

    .table tbody tr {
        background-color: #f2f2f2; /* Light gray background for rows */
    }

    .table tbody tr:nth-child(even) {
        background-color: #e9e9e9; /* Slightly darker shade for alternating rows */
    }

    /* Styling for user photos */
    table .photo img {
        border: 2px solid #333;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
        transition: transform 0.3s;
    }

    table .photo img:hover {
        transform: scale(1.1);
    }


</style>
<p><strong>Welcome,
        <?php echo htmlspecialchars($_SESSION['student']['username']); ?>!
    </strong></p>
<a href="../ID_card.php?id=<?php echo htmlspecialchars($_SESSION['student']['IDno']); ?>" class="button">ID</a>
<a href="include/edit_user.php?id=<?php echo htmlspecialchars($_SESSION['student']['IDno']); ?>" class="button"
    style="margin-left: 5px;">Edit Profile</a>






<h2>Users Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>

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
            
            <td>
                <?php echo htmlspecialchars($row['Fname']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['Sname']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['Mname']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['Ename']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['gender']); ?>
            </td>
            <td>
                <?php if (!empty($row['photo'])): ?>
                <img src="../../pic/User//<?php echo htmlspecialchars($row['photo']); ?>" alt="User Photo"
                    style="width: 50px; height: 50px; object-fit: cover;"
                    onerror="this.onerror=null; this.src='uploads/default.jpg';">
                <!-- Ensure default.jpg is correctly referenced -->
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
           
            <th>Email 1</th>
            <th>Email 2</th>
            <th>Contact 1</th>
            <th>Contact 2</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($contactResult)): ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($row['email1']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['email2']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['con1']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['con2']); ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2>Address Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
           
            <th>Municipality</th>
            <th>Barangay</th>
            <th>Province</th>
            <th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($addressResult)): ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($row['municipality']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['barangay']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['province']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['DOB']); ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h2>students Information</h2>
<table class="table table-bordered">
    <thead>
        <tr>
           
            <th>College</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>A Level</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($studentsInfoResult)): ?>
        <tr>
            <td>
                <?php echo htmlspecialchars($row['college']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['course']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['yrLVL']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['A_LVL']); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($row['status']); ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>