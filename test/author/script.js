// for co_authotr
document.getElementById('addCoAuthor').addEventListener('click', function() {
    const coAuthorsContainer = document.getElementById('coAuthorsContainer');
    const newCoAuthor = document.createElement('div');
    newCoAuthor.classList.add('form-co-author');
    newCoAuthor.innerHTML = `
        <div class="form-book">
            <label for="Co_Name[]">Name</label>
            <input type="text" id="Co_Name" name="Co_Name[]" placeholder="Enter co-author's name" required>
        </div>
        <div class="form-book">
            <label for="Co_Date[]">Date</label>
            <input type="date" id="Co_Date" name="Co_Date[]" required>
        </div>
        <div class="form-book">
            <label for="Co_Role[]">Role</label>
            <input type="text" id="Co_Role" name="Co_Role[]" placeholder="Enter co-author's role" required>
        </div>
        <button type="button" class="removeCoAuthor">Remove</button>
    `;
    coAuthorsContainer.appendChild(newCoAuthor);
});

document.getElementById('coAuthorsContainer').addEventListener('click', function(e) {
    if (e.target.classList.contains('removeCoAuthor')) {
        e.target.parentElement.remove();
    }
});
