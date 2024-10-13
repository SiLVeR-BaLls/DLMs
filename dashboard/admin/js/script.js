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

        function showSection(sectionId) {
            var sections = document.querySelectorAll('.main-content');
            sections.forEach(function (section) {
                section.classList.remove('active');
            });

            var section = document.getElementById(sectionId);
            section.classList.add('active');
        }

        function resetCommonForm() {
            var form = document.querySelectorAll('.main-content.active form');
            form.forEach(function (f) {
                f.reset();
            });
        }

        window.onload = function() {
            showSection('title-section'); // Ensure the 'Brief Title' section is shown by default after page load
        };

function openCommentModal() {
    var modal = document.getElementById('commentModal');
    modal.style.display = 'block';
}

// Close Modal
function closeCommentModal() {
    var modal = document.getElementById('commentModal');
    modal.style.display = 'none';
}

// Submit Comment
function submitComment() {
    var comment = document.getElementById('commentInput').value;
    if (comment.trim() === "") {
        alert("Please enter a comment before submitting.");
        return;
    }

    var commentsDisplay = document.getElementById("commentsDisplay");

    // Create comment container
    var commentDiv = document.createElement("div");
    commentDiv.className = "comment";

    // Create comment text
    var newComment = document.createElement("span");
    newComment.className = "comment-text";
    newComment.textContent = comment;

    // Create remove button
    var removeBtn = document.createElement("span");
    removeBtn.className = "remove-btn";
    removeBtn.textContent = "Delete";
    removeBtn.onclick = function() {
        commentsDisplay.removeChild(commentDiv);
    };

    // Append the comment text and remove button to the comment container
    commentDiv.appendChild(newComment);
    commentDiv.appendChild(removeBtn);

    // Append the comment container to the comments display area
    commentsDisplay.appendChild(commentDiv);

    // Clear the textarea and close the modal
    document.getElementById('commentInput').value = "";
    closeCommentModal();
}

// Close modal if clicked outside of content
window.onclick = function(event) {
    var modal = document.getElementById('commentModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};