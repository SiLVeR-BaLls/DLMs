function toggleDropdown(event) {
    event.stopPropagation(); // Prevent the click from bubbling up
    const dropdownMenu = document.getElementById("dropdown-menu");
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
}

// Toggle mobile menu
document.getElementById("mobile-menu").addEventListener("click", function() {
    const navLinks = document.getElementById("nav-links");
    navLinks.classList.toggle("active");
});

// Close dropdown if clicked outside
window.onclick = function(event) {
    const dropdownMenu = document.getElementById("dropdown-menu");
    if (dropdownMenu.style.display === "block" && !event.target.matches('#profile')) {
        dropdownMenu.style.display = "none";
    }
}
