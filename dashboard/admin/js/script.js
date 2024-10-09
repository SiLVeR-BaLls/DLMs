function toggleDropdown(event) {
    event.preventDefault(); // Prevent default anchor behavior
    const dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
}

function toggleMobileMenu() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
}

// Close dropdown when clicking outside
window.onclick = function(event) {
    const dropdownMenu = document.getElementById('dropdown-menu');
    if (!event.target.matches('#profile')) {
        dropdownMenu.style.display = 'none';
    }
}