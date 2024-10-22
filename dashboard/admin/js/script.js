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

// for co_author
let currentEditIndex = null; // Track the index of the entry being edited

function openCoAuthorModal() {
    document.getElementById('coAuthorModal').style.display = 'block';
}

function closeCoAuthorModal() {
    document.getElementById('coAuthorModal').style.display = 'none';
    resetForm();
}

function resetForm() {
    document.getElementById('Co_Name').value = '';
    document.getElementById('Co_Date').value = '';
    document.getElementById('Co_Role').value = '';
    currentEditIndex = null;
}

function submitCoAuthor() {
    const nameInput = document.getElementById('Co_Name');
    const dateInput = document.getElementById('Co_Date');
    const roleInput = document.getElementById('Co_Role');

    const nameText = nameInput.value.trim();
    const dateText = dateInput.value;
    const roleText = roleInput.value.trim();

    if (nameText) {
        const coAuthorsDisplay = document.getElementById('coAuthorsDisplay');
        const newCoAuthor = document.createElement('div');
        newCoAuthor.innerHTML = `${nameText} - ${dateText ? dateText : 'No Date'} - ${roleText ? roleText : 'No Role'} 
            <button type="button" onclick="openEditCoAuthorModal(${coAuthorsDisplay.children.length})">Edit</button>
            <button type="button" onclick="deleteCoAuthor(${coAuthorsDisplay.children.length})">Delete</button>`;
        coAuthorsDisplay.appendChild(newCoAuthor);
        
        resetForm();
        closeCoAuthorModal(); // Close the modal

        // Send to the server
        fetch('addCoAuthor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `name=${encodeURIComponent(nameText)}&date=${encodeURIComponent(dateText)}&role=${encodeURIComponent(roleText)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Handle response from the server
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Please enter a co-author's name.");
    }
}

function openEditCoAuthorModal(index) {
    const coAuthorsDisplay = document.getElementById('coAuthorsDisplay');
    const entry = coAuthorsDisplay.children[index];
    
    // Extract existing values
    const [name, date, role] = entry.innerText.split(' - ').map(text => text.trim().split(' ')[0]);
    
    document.getElementById('editCo_Name').value = name;
    document.getElementById('editCo_Date').value = date;
    document.getElementById('editCo_Role').value = role;

    currentEditIndex = index; // Set the current edit index
    document.getElementById('editCoAuthorModal').style.display = 'block'; // Open modal for editing
}

function closeEditCoAuthorModal() {
    document.getElementById('editCoAuthorModal').style.display = 'none';
}

function saveEditedCoAuthor() {
    const nameInput = document.getElementById('editCo_Name');
    const dateInput = document.getElementById('editCo_Date');
    const roleInput = document.getElementById('editCo_Role');

    const nameText = nameInput.value.trim();
    const dateText = dateInput.value;
    const roleText = roleInput.value.trim();

    if (nameText && currentEditIndex !== null) {
        const coAuthorsDisplay = document.getElementById('coAuthorsDisplay');
        const entry = coAuthorsDisplay.children[currentEditIndex];
        entry.innerHTML = `${nameText} - ${dateText ? dateText : 'No Date'} - ${roleText ? roleText : 'No Role'} 
            <button type="button" onclick="openEditCoAuthorModal(${currentEditIndex})">Edit</button>
            <button type="button" onclick="deleteCoAuthor(${currentEditIndex})">Delete</button>`;
        
        closeEditCoAuthorModal(); // Close the edit modal
    } else {
        alert("Please enter a co-author's name.");
    }
}

function deleteCoAuthor(index) {
    const coAuthorsDisplay = document.getElementById('coAuthorsDisplay');
    coAuthorsDisplay.removeChild(coAuthorsDisplay.children[index]);
}
