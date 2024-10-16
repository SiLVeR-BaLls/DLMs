<style>

.modal {
  border-radius: 20px; /* Rounded corners */
  display: flex; /* Use flexbox for layout */
  flex-direction: column; /* Arrange children vertically */
  align-items: center; /* Center items horizontally */
  justify-content: center; /* Center items vertically */
  padding: 0px; /* Padding inside the modal */
  position: fixed; /* Fixed positioning to stay in view */
  top: 50%; /* Center vertically */
  left: 50%; /* Center horizontally */
  transform: translate(-50%, -50%); /* Adjust position to center */
  z-index: 1000; /* Ensure modal appears above other content */
  display: none; /* Hidden by default */
}
.modal-content {
 
       background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 20rem; /* Max width */
            border-radius: 8px; /* Rounded corners */
        }


}
.card-heading {
  font-size: 20px;
  font-weight: 700;
  color: rgb(27, 27, 27);
}
.card-description {
    margin:20px;
  font-weight: 100;
  color: rgb(102, 102, 102);
}
.card-button-wrapper {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}
.card-button {
  width: 50%;
  height: 35px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  font-weight: 600;
}
.primary {
  background-color: rgb(255, 114, 109);
  color: white;
}
.primary:hover {
  background-color: rgb(255, 73, 66);
}
.secondary {
  background-color: #ddd;
}
.secondary:hover {
  background-color: rgb(197, 197, 197);
}
</style>

<nav class="navbar">
    <div class="navbar-brand">
        <h1>Admin Panel</h1>
    </div>
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <ul class="navbar-nav" id="nav-links">
        <li><a href="index.php" class="link">Browse</a></li>
        <li><a href="QRscan/index.php" class="link">Attendance</a></li>
        <li><a href="AddBook.php" class="link">Catalog</a></li>
        <li><a href="BrowseUser.php" class="link">Browse Users</a></li>
        <li><a href="pending.php" class="link">Pending User</a></li>
        <li><a href="admin.php" class="link">Profile</a></li>
        <li><a href="../logout.php" class="link" id="logoutBtn">Logout</a></li>
    </ul>
</nav>

<!-- The Modal for confirmation -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="card-content">
            <p class="card-heading">Confirm Log Out?</p>
            <p class="card-description">Are you sure to Leave page</p>
        </div>

        <div class="card-button-wrapper">
            <button id="confirmBtn" class="card-button primary">confirm</button>
            <button  id="cancelBtn" class="card-button secondary">Cancel</button>
        </div>
    </div>
</div>


<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the logout button
    var logoutBtn = document.getElementById("logoutBtn");

    // Get the confirm and cancel buttons
    var confirmBtn = document.getElementById("confirmBtn");
    var cancelBtn = document.getElementById("cancelBtn");

    // When the user clicks the logout button, open the modal 
    logoutBtn.onclick = function(event) {
        event.preventDefault(); // Prevent default action (navigation)
        modal.style.display = "block"; // Show modal
    }

    // When the user clicks the confirm button
    confirmBtn.onclick = function() {
        modal.style.display = "none"; // Hide modal
        // Redirect to logout page (or perform logout action)
        window.location.href = "../logout.php";
    }

    // When the user clicks the cancel button, close the modal
    cancelBtn.onclick = function() {
        modal.style.display = "none"; // Hide modal
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Hide modal
        }
    }

    // Toggle mobile menu
    const mobileMenu = document.getElementById("mobile-menu");
    const navLinks = document.getElementById("nav-links");

    mobileMenu.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
</script>
