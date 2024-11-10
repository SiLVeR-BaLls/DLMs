<!-- borrow.php -->

<?php
include '../config.php'; // Include the configuration file for database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Borrowing</title>

</head>
<style>
    /* Center the form and apply basic styles */
    .borrowing {
        margin: 0;
        padding: 0px;
        display: flex;
        justify-content: space-around;
        background-color: #f8f9fa;
        padding: 0 10%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        align-items: baseline;
    }

    /* Container for the User Information Section */
    .user-container {
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    ;
    }

    /* Container for the Books Section */
    .books-container {
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    /* Container for Buttons */
    .btn-container {
        display: flex;
        justify-content: flex-end;
        right: 0;
        margin-top: 20px;
    }

    /* Styling for the form group (inputs and labels) */
    .form-group {
        font-weight: bold;
        margin: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;

    }

    /* Label styling */
    .group-box {
        font-weight: bold;
        margin: 10px;
        padding:10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
    }
    }

    /* Styling for input fields */
    .form-control {
        width: 10vw;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Styling for the user search result container */
    .search-result {
        top: 40px;
        max-width: 10rem;
        background-color: white;
        border: 1px solid #ced4da;
        max-height: 150px;
        overflow-y: scroll;
    }

    /* Styling for buttons */
    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Specific styles for secondary and primary buttons */
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Styling for the book-specific search result container */
    #bookSearchResult_0 {
        padding: 10px;
        top: 40px;
        width: 100%;
        background-color: white;
        border: 1px solid #ced4da;
        max-height: 150px;
        display: flex;
        overflow-y: auto;
    }

    #userSearchResult {
        top: 40px;
        width: 100%;
        background-color: white;
        border: 1px solid #ced4da;
        max-height: 150px;
        display: flex;
        overflow-y: auto;
    }
</style>

<body>
    <?php include 'include/header.php'; include 'include/navbar.php'; ?>
    <div class="container mt-5">
        <h1>Borrow a Book</h1>
        <center>
            <form action="include/BorrowConnect.php" method="POST">

                <!-- Books Section Container -->
                <div class="borrowing">
                    <div class="books-container" id="bookContainer">
                        <div class="form-group">
                            <div class="group-box">
                                <label for="bookID_0">Book ID:</label>
                                <input type="text" id="bookID_0" name="bookID[]" class="form-control" required
                                    oninput="searchBook(0)">
                                <div id="bookSearchResult_0" class="search-result"></div>
                            </div>
                        </div>
                    </div>
                
                    <!-- User Information Container -->
                    <div class="user-container">
                        <div class="form-group">
                            <div class="group-box">
                                <label for="IDno">User ID:</label>
                                <input type="text" id="IDno" name="IDno" class="form-control" required
                                    oninput="searchUser()">
                                <div id="userSearchResult" class="search-result"></div>
                            </div>
                        </div>
                        <div class="btn-container">
                            <button type="button" class="btn btn-secondary" onclick="addBook()">Add Another Book</button>
                            <button type="submit" class="btn btn-primary">Approve Borrowing</button>
                        </div>
                    </div>


                </div>
                <!-- Button Container -->

            </form>
        </center>


    </div>

    <script>
        let bookCount = 1; // Start with 1 book input field

        // Search for user based on user ID
        function searchUser() {
            const IDno = document.getElementById('IDno').value;
            if (IDno.length > 2) { // Start search after 3 characters
                fetch(`UserSearch.php?IDno=${IDno}`)
                    .then(response => response.text())
                    .then(data => document.getElementById('userSearchResult').innerHTML = data)
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('userSearchResult').innerHTML = "";
            }
        }

        // Search for books based on book ID
        function searchBook(index) {
            const bookID = document.getElementById(`bookID_${index}`).value;
            if (bookID.length > 2) { // Start search after 3 characters
                fetch(`BookSearch.php?bookID=${bookID}`)
                    .then(response => response.text())
                    .then(data => document.getElementById(`bookSearchResult_${index}`).innerHTML = data)
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById(`bookSearchResult_${index}`).innerHTML = "";
            }
        }

        // Add a new book input field
        function addBook() {
            const container = document.getElementById('bookContainer');
            const newBookIndex = bookCount++;

            const newBookInput = document.createElement('div');
            newBookInput.classList.add('form-group');
            newBookInput.setAttribute('id', `bookGroup_${newBookIndex}`); // Unique ID for each book field

            newBookInput.innerHTML = `
                <div class="group-box">
                    <label for="bookID_${newBookIndex}">Book ID:</label>
                    <input type="text" id="bookID_${newBookIndex}" name="bookID[]" class="form-control" required oninput="searchBook(${newBookIndex})">
                    <div id="bookSearchResult_${newBookIndex}" class="search-result"></div>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeBook(${newBookIndex})">Remove Book</button>

                </div>
            
                `;
            container.appendChild(newBookInput);
        }

        // Remove a specific book input field
        function removeBook(index) {
        const bookGroup = document.getElementById(`bookGroup_${index}`);
        if (bookGroup) {
            bookGroup.remove();
        }
    }


    </script>
</body>

</html>