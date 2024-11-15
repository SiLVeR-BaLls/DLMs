<body class="bg-gray-100 flex">

    <!-- Sticky Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-screen sticky top-0 flex flex-col">
        <div class="p-4 font-bold text-lg border-b border-gray-700">
            Admin Panel
        </div>
        <nav class="flex-grow">
            <ul class="space-y-1 py-4">
                <!-- Individual links -->
                <li><a href="index.php" class="block py-2 px-4 hover:bg-gray-700">Browse</a></li>
                <li><a href="QRscan/index.php" class="block py-2 px-4 hover:bg-gray-700">Attendance</a></li>

                <!-- Manage Books Dropdown -->
                <li class="relative group">
                    <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-gray-700">
                        Manage Books ▼
                    </button>
                    <ul class="hidden group-hover:block bg-gray-900 ml-4 mt-1 space-y-1">
                        <li><a href="Borrow.php" class="block py-2 px-4 hover:bg-gray-700">Borrow</a></li>
                        <li><a href="BorrowDisplay.php" class="block py-2 px-4 hover:bg-gray-700">Borrowed</a></li>
                        <li><a href="Catalog.php" class="block py-2 px-4 hover:bg-gray-700">Catalog</a></li>
                        <li><a href="ReturnBook.php" class="block py-2 px-4 hover:bg-gray-700">Return</a></li>
                        <li><a href="Report.php" class="block py-2 px-4 hover:bg-gray-700">Report</a></li>
                    </ul>
                </li>

                <!-- Manage Users Dropdown -->
                <li class="relative group">
                    <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-gray-700">
                        Manage Users ▼
                    </button>
                    <ul class="hidden group-hover:block bg-gray-900 ml-4 mt-1 space-y-1">
                        <li><a href="BrowseUser.php" class="block py-2 px-4 hover:bg-gray-700">Browse Users</a></li>
                        <li><a href="pending.php" class="block py-2 px-4 hover:bg-gray-700">Pending User</a></li>
                    </ul>
                </li>

                <!-- Dashboard Dropdown -->
                <li class="relative group">
                    <button class="w-full flex justify-between items-center py-2 px-4 hover:bg-gray-700">
                        Dashboard ▼
                    </button>
                    <ul class="hidden group-hover:block bg-gray-900 ml-4 mt-1 space-y-1">
                        <li><a href="admin.php" class="block py-2 px-4 hover:bg-gray-700">Profile</a></li>
                        <li><a href="Myborrow.php" class="block py-2 px-4 hover:bg-gray-700">My Borrow</a></li>
                        <li><a href="../logout.php" id="logoutBtn" class="block py-2 px-4 hover:bg-gray-700">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Modal for confirmation -->
    <div id="myModal" class="fixed inset-0 flex items-center  justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg text-center">
            <h2 class="text-xl font-semibold mb-2">Confirm Log Out?</h2>
            <p class="mb-4">Are you sure to leave the page?</p>
            <div class="flex justify-around">
                <button id="confirmBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Confirm</button>
                <button id="cancelBtn" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
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

        logoutBtn.addEventListener("click", function(event) {
            event.preventDefault();
            modal.classList.remove("hidden");
        });
        confirmBtn.addEventListener("click", function() {
            modal.classList.add("hidden");
            window.location.href = "../logout.php";
        });
        cancelBtn.addEventListener("click", function() {
            modal.classList.add("hidden");
        });
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.classList.add("hidden");
            }
        });
    </script>
</body>
