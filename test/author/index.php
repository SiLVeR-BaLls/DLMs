<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Author Registration</h1>
        <form id="registrationForm" action="submit.php" method="POST">
            <div class="form-group">
                <label for="authorName">Author Name:</label>
                <input type="text" id="authorName" name="author_name" required>
            </div>
            <div class="form-group">
                <label for="registrationDate">Registration Date:</label>
                <input type="date" id="registrationDate" name="registration_date" required>
            </div>
            <div id="coAuthorsContainer">
                <div class="form-co-author">
                    <div class="form-book">
                        <label for="Co_Name[]">Name</label>
                        <input type="text" id="Co_Name" name="Co_Name[]" placeholder="Enter co-author's name" required>
                    </div>
                    <div class="form-book">
                        <label for="Co_Date[]">Date</label>
                        <input type="date" id="Co_Date" name="Co_Date[]" required>
                    </div>
                    <div class="form-book">
                        <label for="Co_Role[]">Role</label>
                        <input type="text" id="Co_Role" name="Co_Role[]" placeholder="Enter co-author's role" required>
                    </div>
                </div>
            </div>
            <button type="button" id="addCoAuthor">Add Co-Author</button>
            <button type="submit">Submit</button>
        </form>
        <br>
        <button onclick="window.location.href='display.php'">View Authors</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
