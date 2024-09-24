<header class="bars">
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <button class="menu-toggle" id="menu-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </nav>

    <!-- Overlay Menu for Mobile View -->
    <div class="overlay-menu" id="overlay-menu">
        <button class="close-button" id="close-button">&times;</button>
        <ul class="nav-links">
            <li><button class="nav-button" onclick="location.href='index.php'">Home</button></li>
            <li><button class="nav-button" onclick="location.href='about.php'">About</button></li>
            <li><button class="nav-button" onclick="location.href='services.php'">Services</button></li>
            <li><button class="nav-button" onclick="location.href='contact.php'">Contact</button></li>
        </ul>
    </div>
</header>
