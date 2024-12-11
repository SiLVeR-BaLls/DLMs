<!-- Sticky Sidebar -->
<aside class="bg-blue-600 text-white sticky top-0 z-1000 flex flex-col w-1/6 max-h-screen">
    <div class="p-4 font-bold text-lg border-b border-blue-600">
        Admin Panel
    </div>
    <nav class="flex-grow">
        <ul class="space-y-1 py-4">
            <!-- Individual links -->
            <li>
                <a href="index.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Browse</a>
            </li>
            <li>
                <a href="QRscan/index.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'QRscan/') !== false) ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Attendance</a>
            </li>
            <!-- <li><a href="../../chat_app/index.php" class="block py-2 px-4 hover:bg-blue-700">Message</a></li> -->
            <!-- Manage Books Dropdown -->
            <li class="relative group">
                <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-blue-700">
                    Manage Books ▼
                </button>
                <ul class="hidden group-hover:block bg-blue-500 ml-4 mt-1 space-y-1">
                    <li><a href="Borrow.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Borrow.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Borrow</a></li>
                    <li><a href="BorrowDisplay.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'BorrowDisplay.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Borrowed</a></li>
                    <li><a href="Catalog.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Catalog.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Catalog</a></li>
                    <li><a href="ReturnBook.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'ReturnBook.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Return</a></li>
                    <li><a href="Report.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Report.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Report</a></li>
                </ul>
            </li>

            <!-- Manage Users Dropdown -->
            <li class="relative group">
                <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-blue-700">
                    Manage Users ▼
                </button>
                <ul class="hidden group-hover:block bg-blue-500 ml-4 mt-1 space-y-1">
                    <li><a href="BrowseUser.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'BrowseUser.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Browse Users</a></li>
                    <li><a href="pending.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'pending.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Pending User</a></li>
                    <li><a href="Assign.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Assign.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Assign User</a></li>
                </ul>
            </li>

            <!-- Dashboard Dropdown -->
            <li class="relative group">
                <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-blue-700">
                    Dashboard ▼
                </button>
                <ul class="hidden group-hover:block bg-blue-500 ml-4 mt-1 space-y-1">
                    <li><a href="admin.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Profile</a></li>
                    <li><a href="Myborrow.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Myborrow.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">My Borrow</a></li>
                    <li><a href="Myreturn.php" class="block py-2 px-4 <?php echo (basename($_SERVER['PHP_SELF']) == 'Myreturn.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">My Returned</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Logout Button (now placed outside of the dropdowns) -->
    <div class="py-4 px-4">
        <a href="#" id="logoutBtn" class="block py-2 px-4 bg-blue-500 text-white text-center <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'bg-blue-700' : ''; ?> hover:bg-blue-700">Logout</a>
    </div>
</aside>

<!-- Modal for confirmation -->
<div id="myModal" class="hidden fixed z-20 inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <h2 class="text-xl font-semibold mb-2">Confirm Log Out?</h2>
        <p class="mb-4">Are you sure you want to leave the page?</p>
        <div class="flex justify-around">
            <button id="confirmBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Confirm</button>
            <button id="cancelBtn" class="bg-blue-300 px-4 py-2 rounded hover:bg-blue-500">Cancel</button>
        </div>
    </div>
</div>

<!-- JavaScript for modal and toggles -->
<script>
    // Modal functionality
    const modal = document.getElementById("myModal");
    const logoutBtn = document.getElementById("logoutBtn");
    const confirmBtn = document.getElementById("confirmBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    // Show the modal when clicking the logout button
    logoutBtn.addEventListener("click", function(event) {
        event.preventDefault();
        modal.classList.remove("hidden");
    });

    // Confirm logout
    confirmBtn.addEventListener("click", function() {
        modal.classList.add("hidden");
        window.location.href = "../logout.php"; // Redirect to logout page
    });

    // Cancel logout and close modal
    cancelBtn.addEventListener("click", function() {
        modal.classList.add("hidden");
    });

    // Close the modal if clicking outside the modal content
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.classList.add("hidden");
        }
    });
</script>
