<!-- Borrow.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Borrowing</title>
</head>
<body>
    <?php include 'include/header.php'; include 'include/navbar.php'; ?>
    <h1>Borrow</h1>

    <center>
        <form action="include/BorrowConnect.php" method="POST">
            <div class="form-group">
                <label for="IDno">User ID:</label>
                <input type="text" id="IDno" name="IDno" required oninput="searchUser()">
                <div id="userSearchResult" class="search-result"></div>
            </div>

            <div class="form-group">
                <label for="bookID">Book ID:</label>
                <input type="text" id="bookID" name="bookID" required oninput="searchBook()">
                <div id="bookSearchResult" class="search-result"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Approve Borrowing</button>
        </form>
    </center>

    <script>
        // JavaScript functions to handle search
        function searchUser() {
            const IDno = document.getElementById('IDno').value;
            if (IDno.length > 2) { // Start search after 2 characters
                fetch(`UserSearch.php?IDno=${IDno}`)
                    .then(response => response.text())
                    .then(data => document.getElementById('userSearchResult').innerHTML = data);
            } else {
                document.getElementById('userSearchResult').innerHTML = "";
            }
        }

        function searchBook() {
            const bookID = document.getElementById('bookID').value;
            if (bookID.length > 2) { // Start search after 2 characters
                fetch(`BookSearch.php?bookID=${bookID}`)
                    .then(response => response.text())
                    .then(data => document.getElementById('bookSearchResult').innerHTML = data);
            } else {
                document.getElementById('bookSearchResult').innerHTML = "";
            }
        }
    </script>
</body>
</html>
