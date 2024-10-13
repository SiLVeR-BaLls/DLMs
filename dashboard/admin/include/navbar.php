
<nav class="navbar">
    <div class="navar-brand">
        <h1>Admin Panel</h1>
    </div>
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
        <ul class="navbar-nav" id="nav-links">
        <li><a href="index.php" class="link">Browse</a></li>
        <li><a href="QRscan/index.php"class="link">Attendance</a></li>
        <li><a href="AddBook.php"class="link">Catalog</a></li>
        
            <li><a href="BrowseUser.php"class="link">Browse Users</a></li>
            <li class="dropdown">
                <a href="#" id="profile" onclick="toggleDropdown(event)"class="link">Setting ▼</a>
                <ul class="dropdown-menu" id="dropdown-menu">
                    <li><a href="admin.php">Profile</a></li>
                    <li><a href="?logout=true">Logout</a></li>
                </ul>
            </li>
        </ul>
</nav>

