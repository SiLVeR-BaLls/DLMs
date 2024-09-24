document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const overlayMenu = document.getElementById('overlay-menu');
    const closeButton = document.getElementById('close-button');

    // Toggle the overlay menu
    menuToggle.addEventListener('click', function() {
        overlayMenu.classList.toggle('active');
    });

    // Close the overlay menu when close button is clicked
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            overlayMenu.classList.remove('active');
        });
    }
});
