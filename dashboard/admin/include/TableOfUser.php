<!-- Table displaying users -->

<div class="tableofuser">
<table id="usersTable" class="table table-striped table-bordered dt-responsive">
    <thead>
        <tr>
            <th>IDno</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Section</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($usersResult)): ?>
            <tr>
                <td><?php echo $row['IDno']; ?></td>
                <td><?php echo $row['Fname']; ?></td>
                <td><?php echo $row['Sname']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td>
                    <!-- View Button triggers modal -->
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewUserModal" 
                            onclick="viewUser('<?php echo $row['IDno']; ?>', '<?php echo $row['Fname']; ?>', '<?php echo $row['Sname']; ?>', '<?php echo $row['course']; ?>', '<?php echo $row['year']; ?>', '<?php echo $row['section']; ?>')">View</button>
                    
                    <!-- Delete Button with confirmation -->
                    <a href="delete_user.php?id=<?php echo $row['IDno']; ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="userID" name="IDno">
                    <div class="form-group">
                        <label for="editFname">First Name</label>
                        <input type="text" class="form-control" id="editFname" name="Fname" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editSname">Last Name</label>
                        <input type="text" class="form-control" id="editSname" name="Sname" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editCourse">Course</label>
                        <input type="text" class="form-control" id="editCourse" name="course" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editYear">Year</label>
                        <input type="text" class="form-control" id="editYear" name="year" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editSection">Section</label>
                        <input type="text" class="form-control" id="editSection" name="section" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editUserBtn" onclick="enableEditing()">Edit</button>
                <button type="button" class="btn btn-primary" id="saveChanges" style="display: none;" onclick="saveChanges()">Save</button>
                <button type="button" class="btn btn-secondary" id="cancelEdit" style="display: none;" onclick="cancelEdit()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery, Bootstrap JS, and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.responsive.min.js"></script>

<!-- DataTables initialization -->
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    // Function to populate modal with user details
    function viewUser(id, fname, sname, course, year, section) {
        $('#userID').val(id);
        $('#editFname').val(fname);
        $('#editSname').val(sname);
        $('#editCourse').val(course);
        $('#editYear').val(year);
        $('#editSection').val(section);
    }

    function enableEditing() {
        $('#editFname, #editSname, #editCourse, #editYear, #editSection').prop('readonly', false);
        $('#editUserBtn').hide();
        $('#saveChanges, #cancelEdit').show();
    }

    function cancelEdit() {
        $('#editFname, #editSname, #editCourse, #editYear, #editSection').prop('readonly', true);
        $('#editUserBtn').show();
        $('#saveChanges, #cancelEdit').hide();
    }

    function saveChanges() {
        // Collect data from the form
        var id = $('#userID').val();
        var fname = $('#editFname').val();
        var sname = $('#editSname').val();
        var course = $('#editCourse').val();
        var year = $('#editYear').val();
        var section = $('#editSection').val();

        // Send AJAX request to save the changes
        $.ajax({
            url: 'update_user.php', // The script to update user data
            type: 'POST',
            data: {
                IDno: id,
                Fname: fname,
                Sname: sname,
                course: course,
                year: year,
                section: section
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('User details updated successfully!');
                    $('#viewUserModal').modal('hide');
                    location.reload(); // Reload to show updated data
                } else {
                    alert('Error: ' + result.message);
                }
            },
            error: function() {
                alert('An error occurred while saving the changes.');
            }
        });
    }
</script>
</div>