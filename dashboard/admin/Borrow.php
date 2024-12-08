<?php
include '../config.php'; // Include the configuration file for database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrow</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
    <!-- Main Content Area with Sidebar and BrowseBook Section -->
    <main class="flex flex-grow">
        <!-- Sidebar Section -->
        <?php include 'include/sidebar.php'; ?>
        <!-- BrowseBook Content Section -->
        <div class="flex-grow ">
        <!-- Header at the Top -->
        <?php include 'include/header.php'; ?>


      <!-- BorrowBook Content -->
      <h1 class="text-3xl font-semibold mb-4 text-center">Borrow a Book</h1>
      <div class="container mx-auto px-4 py-6">

        <form action="include/BorrowConnect.php" method="POST">
          <div class="flex space-x-4 mb-4">
            <!-- User Information Section -->
            <div class="user-container flex flex-col space-y-2 w-1/2">
              <label for="IDno" class="font-semibold">User ID:</label>
              <div class="flex flex-col space-y-2">
                <input autocomplete="off" type="text" id="IDno" name="IDno"
                  class="form-control shadow border rounded w-full py-2 px-3 text-gray-700 sticky top-0 bg-white z-10 focus:outline-none focus:shadow-outline"
                  required oninput="searchUser()">
                <div id="userSearchResult" class="bookSearchResults mt-2 max-h-64 overflow-y-auto"></div>
              </div>
            </div>

            <!-- Book Section -->
            <div class="books-container overflow-y-scroll h-96 flex flex-col space-y-4 w-1/2" id="bookContainer">
              <div class="form-group flex flex-col space-y-2" id="bookGroup_0">
                <label for="bookID_0" class="font-semibold">Book ID:</label>
                <div class="flex flex-col space-y-2">
                  <input autocomplete="off" type="text" id="bookID_0" name="bookID[]"
                    class="form-control shadow border rounded w-full py-2 px-3 text-gray-700 sticky top-0 bg-white z-10 focus:outline-none focus:shadow-outline"
                    required oninput="searchBook(0)">
                  <div id="bookSearchResult_0" class="bookSearchResults mt-2 max-h-64 overflow-y-auto"></div>
                </div>
              </div>
            </div>

          </div>

          <!-- Buttons Section -->
          <div class="flex sticky bottom-0 items-center justify-center space-x-4 py-4 shadow-md">
            <!-- Add Another Book Button -->
            <button type="button"
              class="bg-gray-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
              onclick="addBook()">
              Add Another Book
            </button>

            <!-- Approve Borrowing Button -->
            <button type="submit"
              class="bg-blue-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
              Approve Borrowing
            </button>
          </div>

        </form>

        </div>
      <!-- Footer at the Bottom -->
         <footer class="bg-blue-600 text-white mt-auto">
            <?php include 'include/footer.php'; ?>
        </footer>
    </main>
</body>


  <!-- Custom CSS for Scrollable Search Results -->
  <script>
    // Declare and initialize bookCount to keep track of the number of books
    let bookCount = 1;

    // Search for user based on user ID
    function searchUser() {
      const IDno = document.getElementById('IDno').value;
      if (IDno.length > 2) {
        fetch(`SearchUser.php?IDno=${IDno}`)
          .then(response => response.text())
          .then(data => {
            document.getElementById('userSearchResult').innerHTML = data;
            const results = document.getElementById('userSearchResult').getElementsByClassName('search-item');
            Array.from(results).forEach(item => {
              item.addEventListener('click', () => {
                const selectedID = item.getAttribute('data-id');
                const selectedName = item.textContent;
                selectUser(selectedID, selectedName);
              });
            });
          })
          .catch(error => console.error('Error:', error));
      } else {
        document.getElementById('userSearchResult').innerHTML = "";
      }
    }

    // Search for books by ID
    function searchBook(index) {
      const bookID = document.getElementById(`bookID_${index}`).value;
      if (bookID.length > 2) {
        fetch(`include/SearchBook.php?bookID=${bookID}`)
          .then(response => response.text())
          .then(data => {
            document.getElementById(`bookSearchResult_${index}`).innerHTML = data;
          })
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
      newBookInput.classList.add('form-group', 'flex', 'flex-col', 'space-y-2');
      newBookInput.setAttribute('id', `bookGroup_${newBookIndex}`);

      newBookInput.innerHTML = `
                <label for="bookID_${newBookIndex}" class="font-semibold">Book ID:</label>
                <div class="flex flex-col space-y-2">
                    <input type="text" id="bookID_${newBookIndex}" name="bookID[]"         
                    class="form-control shadow border rounded w-full py-2 px-3 text-gray-700 sticky top-0 bg-white z-10 focus:outline-none focus:shadow-outline"
                        required oninput="searchBook(${newBookIndex})">
                    <div id="bookSearchResult_${newBookIndex}" class="bookSearchResults mt-2"></div>
                </div>
                <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-2 hover:bg-red-700 focus:outline-none" onclick="removeBook(${newBookIndex})">Remove Book</button>
            `;
      container.appendChild(newBookInput);
    }

    // Remove a specific book input field
    function removeBook(index) {
      const bookGroup = document.getElementById(`bookGroup_${index}`);
      if (bookGroup) bookGroup.remove();
    }


    // Set user ID in the input field after selecting a result
    function selectUser(IDno, name) {
      document.getElementById('IDno').value = IDno;
      // We no longer clear the results when selecting a user
    }

    // Set book ID in the input field after selecting a result
    function selectBook(bookID, title, author, callNumber, publisher, publicationYear, status) {
      const inputField = document.getElementById(`bookID_${index}`);
      inputField.value = bookID; // Use the relevant parameter
      // Optionally use other details, like updating the UI with additional info
    }
  </script>
<script>// Search for user based on user ID
  function searchUser() {
    const IDno = document.getElementById('IDno').value;
    if (IDno.length > 0) {
      fetch(`include/SearchUser.php?IDno=${IDno}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById('userSearchResult').innerHTML = data;
          const results = document.getElementById('userSearchResult').getElementsByClassName('search-item');
          Array.from(results).forEach(item => {
            item.addEventListener('click', () => {
              const selectedID = item.getAttribute('data-id');
              const selectedName = item.textContent;
              selectUser(selectedID, selectedName);
            });
          });
        })
        .catch(error => console.error('Error:', error));
    } else {
      document.getElementById('userSearchResult').innerHTML = "";
    }
  }

  // Search for books based on book ID
  function searchBook(index) {
    const bookID = document.getElementById(`bookID_${index}`).value;
    if (bookID.length > 0) {
      fetch(`include/SearchBook.php?bookID=${bookID}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById(`bookSearchResult_${index}`).innerHTML = data;
          const results = document.getElementById(`bookSearchResult_${index}`).getElementsByClassName('search-item');
          document.getElementById(`bookSearchResult_${index}`).addEventListener('click', (event) => {
            const target = event.target.closest('.search-item');
            if (target) {
              const selectedBookID = target.getAttribute('data-id');
              const selectedTitle = target.textContent;
              selectBook(selectedBookID, selectedTitle, index);
            }
          });

        })
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
    newBookInput.classList.add('form-group', 'flex', 'flex-col', 'space-y-2');
    newBookInput.setAttribute('id', `bookGroup_${newBookIndex}`);

    newBookInput.innerHTML = `
        <label for="bookID_${newBookIndex}" class="font-semibold">Book ID:</label>
        <div class="flex flex-col space-y-2">
            <input type="text" id="bookID_${newBookIndex}" name="bookID[]" 
             class="form-control shadow border rounded w-full py-2 px-3 text-gray-700 sticky top-0 bg-white z-10 focus:outline-none focus:shadow-outline"
 required oninput="searchBook(${newBookIndex})">
            <div id="bookSearchResult_${newBookIndex}" class="bookSearchResults mt-2"></div>
        </div>
        <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-2 hover:bg-red-700 focus:outline-none focus:shadow-outline" onclick="removeBook(${newBookIndex})">Remove Book</button>
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

  // Set user ID in the input field after selecting a result
  function selectUser(IDno, name) {
    document.getElementById('IDno').value = IDno;
    // We no longer clear the results when selecting a user
  }

  // Set book ID in the input field after selecting a result
  function selectBook(bookID, title, index) {
    const inputField = document.getElementById(`bookID_${index}`);
    inputField.value = bookID;
    // We no longer clear the results when selecting a book
  }
</script>

</body>
</html>