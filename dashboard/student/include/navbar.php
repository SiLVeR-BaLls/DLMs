
<nav class="navbar">
    <div class="navar-brand">
        <h1>student Panel</h1>
    </div>
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <ul class="navbar-nav" id="nav-links">
    <li><a href="index.php">Browse</a></li>
        <li><a href="#settings">Browse Users</a></li>
        <li class="dropdown">
            <a href="#" id="profile" onclick="toggleDropdown(event)">Setting ▼</a>
            <ul class="dropdown-menu" id="dropdown-menu">
                <li><a href="student.php">Profile</a></li>
                <li><a href="?logout=true">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>