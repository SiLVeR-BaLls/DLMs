<body>
    <div class="content">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <button onclick="showSection('title-section')" selected>Brief Title</button>
            <button onclick="showSection('series/note')">Series/Note</button>
            <button onclick="showSection('subject')">Subject</button>
            <button onclick="showSection('resources')">Resources</button>
            <button onclick="showSection('added-entrie')">Added Entries</button>
        </div>

        <form action="include/AddConnect.php" method="post">
            <!-- Main Container Section -->
            <div class="main-container">
                <!-- Title Info Section -->
                <div class="main-content" id="title-section">
                    <h1>Title Info</h1>
                    <div class="form-book">
                        <label for="B_title">Title</label>
                        <input type="text" id="B_title" name="B_title" required>
                    </div>
                    <div class="form-book">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" id="subtitle" name="subtitle">
                    </div>
                    <div class="form-book">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author">
                    </div>
                    <div class="form-book">
                        <label for="edition">Edition</label>
                        <input type="text" id="edition" name="edition">
                    </div>

                    <h1>Standard Numbers</h1>
                    <div class="number">
                        <div class="input-group form-book">
                            <label for="LCCN">LCCN</label>
                            <input type="text" id="LCCN" name="LCCN">
                        </div>
                        <div class="input-group form-book">
                            <label for="ISBN">ISBN</label>
                            <input type="text" id="ISBN" name="ISBN">
                        </div>
                        <div class="input-group form-book">
                            <label for="ISSN">ISSN</label>
                            <input type="text" id="ISSN" name="ISSN">
                        </div>
                    </div>

                    <div class="form-book">
                        <label for="MT">Material Type</label>
                        <select name="MT" id="MT">
                            <option value="book">Book</option>
                            <option value="computer_file">Computer File</option>
                            <option value="ebook">Electronic Book (E-Book)</option>
                            <option value="artifact">Artifact</option>
                        </select>
                    </div>

                    <div class="form-book">
                        <label for="ST">SubType</label>
                        <select name="ST" id="ST">
                            <option value="not_assigned">No SubType Assigned</option>
                            <option value="Braille">Braille</option>
                            <option value="Hardcover">Hardcover</option>
                            <option value="LargePrint">Large Print</option>
                        </select>
                    </div>

                    <h1>Publication Information</h1>
                    <div class="form-book">
                        <label for="place">Place</label>
                        <input type="text" id="place" name="place">
                    </div>
                    <div class="form-book">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher">
                    </div>
                    <div class="form-book">
                        <label for="Pdate">Date</label>
                        <input type="date" id="Pdate" name="Pdate">
                    </div>
                    <div class="form-book">
                        <label for="copyright">Copyright</label>
                        <input type="text" id="copyright" name="copyright">
                    </div>

                    <h1>Physical Description</h1>
                    <div class="form-book">
                        <label for="extent">Extent</label>
                        <input type="text" id="extent" name="extent">
                    </div>
                    <div class="form-book">
                        <label for="size">Size</label>
                        <input type="text" id="size" name="size">
                    </div>
                    <div class="form-book">
                        <label for="Odetail">Other Details</label>
                        <input type="text" id="Odetail" name="Odetail">
                    </div>
                </div>

                <!-- Series Info Section -->
                <div class="main-content" id="series/note">
                    <h1>Series Info</h1>
                    <div class="form-book">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title">
                    </div>
                    <div class="form-book">
                        <label for="volume">Volume</label>
                        <input type="text" id="volume" name="volume">
                    </div>
                    <div class="form-book">
                        <label for="IL">Interest Level</label>
                        <select id="IL" name="IL">
                            <option value="">Select Interest Level</option>
                        </select>
                    </div>
                    <div class="form-book">
                        <label for="lexille">Lexile</label>
                        <select id="lexille" name="lexille">
                            <option value="">No Code</option>
                        </select>
                    </div>
                    <div class="form-book">
                        <label for="F_and_P">Fountas and Pinnell</label>
                        <select id="F_and_P" name="F_and_P">
                            <option value="">Any Level</option>
                        </select>
                    </div>

                    <button type="button" onclick="openCommentModal()">Add Comment</button>
                    <div id="commentsDisplay"></div>

                    <!-- Comment Modal -->
                    <div id="commentModal" class="modal" style="display:none;">
                        <div class="modal-content">
                            <span class="close" onclick="closeCommentModal()">&times;</span>
                            <h2>Add Comment</h2>
                            <textarea id="commentInput" rows="4" placeholder="Enter your comments here..."></textarea>
                            <input type="hidden" name="comments" id="commentsInput">
                            <div class="modal-actions">
                                <button type="button" onclick="submitComment()">Submit</button>
                                <button type="button" onclick="closeCommentModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject Section -->
                <div class="main-content" id="subject">
                    <h1>Subject</h1>
                    <div class="form-book">
                        <select class="headsubject" name="Sub_Head" id="Sub_Head">
                            <option value="Tropical Heading">Tropical Heading</option>
                            <option value="Personal Heading">Personal Heading</option>
                            <option value="Geographic Heading">Geographic Heading</option>
                            <option value="Local Heading">Local Heading</option>
                        </select>
                        <input type="text" name="Sub_Head_input" id="Sub_Head_input">
                    </div>
                    <div class="form-book">
                        <select class="headsubject" name="Sub_Body_1" id="Sub_Body_1">
                            <option value="General">General</option>
                            <option value="Geographic">Geographic</option>
                            <option value="Chronological">Chronological</option>
                            <option value="Form">Form</option>
                        </select>
                        <input type="text" name="Sub_input_1" id="Sub_input_1">
                    </div>
                    <div class="form-book">
                        <select class="headsubject" name="Sub_Body_2" id="Sub_Body_2">
                            <option value="General">General</option>
                            <option value="Geographic">Geographic</option>
                            <option value="Chronological">Chronological</option>
                            <option value="Form">Form</option>
                        </select>
                        <input type="text" name="Sub_input_2" id="Sub_input_2">
                    </div>
                    <div class="form-book">
                        <select class="headsubject" name="Sub_Body_3" id="Sub_Body_3">
                            <option value="General">General</option>
                            <option value="Geographic">Geographic</option>
                            <option value="Chronological">Chronological</option>
                            <option value="Form">Form</option>
                        </select>
                        <input type="text" name="Sub_input_3" id="Sub_input_3">
                    </div>
                </div>

                <!-- Resources Section -->
                <div class="main-content" id="resources">
                    <h1>Link</h1>
                    <div class="form-book">
                        <label for="url">URL</label>
                        <input type="url" id="url" name="url">
                    </div>
                    <div class="form-book">
                        <label for="Description">Description</label>
                        <input type="text" id="Description" name="Description">
                    </div>
                </div>

                <!-- Added Entries Section -->
                <div class="main-content" id="added-entrie">
                    <h1>Alternate Title</h1>
                    <div class="form-book">
                        <label for="UTitle">Uniform Title</label>
                        <input type="text" id="UTitle" name="UTitle">
                    </div>
                    <div class="form-book">
                        <label for="VForm">Varying Form</label>
                        <input type="text" id="VForm" name="VForm">
                    </div>
                    <div class="form-book">
                        <label for="SUTitle">Series Uniform Title</label>
                        <input type="text" id="SUTitle" name="SUTitle">
                    </div>

                    <h1>Co-Authors, Illustrator, Editor, etc.</h1>
                    <button type="button" onclick="openCoAuthorModal()">Add Co-Author</button>
                    <div id="coAuthorsDisplay"></div>

                    <!-- Co-Author Modal -->
                    <div id="coAuthorModal" class="modal" style="display:none;">
                        <div class="modal-content">
                            <span class="close" onclick="closeCoAuthorModal()">&times;</span>
                            <h2>Add Co-Author</h2>
                            <div class="form-book">
                                <label for="Co_Name">Name</label>
                                <input type="text" id="Co_Name" name="Co_Name" placeholder="Enter co-author's name">
                            </div>
                            <div class="form-book">
                                <label for="Co_Date">Date</label>
                                <input type="date" id="Co_Date" name="Co_Date">
                            </div>
                            <div class="form-book">
                                <label for="Co_Role">Role</label>
                                <input type="text" id="Co_Role" name="Co_Role" placeholder="Enter co-author's role">
                            </div>
                            <input type="hidden" name="coAuthors" id="coAuthorsInput">
                            <div class="modal-actions">
                                <button type="button" onclick="submitCoAuthor()">Submit</button>
                                <button type="button" onclick="closeCoAuthorModal()">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Co-Author Modal -->
                    <div id="editCoAuthorModal" class="modal" style="display:none;">
                        <div class="modal-content">
                            <span class="close" onclick="closeEditCoAuthorModal()">&times;</span>
                            <h2>Edit Co-Author</h2>
                            <div class="form-book">
                                <label for="editCo_Name">Name</label>
                                <input type="text" id="editCo_Name" name="Co_name">
                            </div>
                            <div class="form-book">
                                <label for="editCo_Date">Date</label>
                                <input type="date" id="editCo_Date" name="Co_Date">
                            </div>
                            <div class="form-book">
                                <label for="editCo_Role">Role</label>
                                <input type="text" id="editCo_Role" name="Co_Rate">
                            </div>
                            <div class="modal-actions">
                                <button type="button" onclick="saveEditedCoAuthor()">Save</button>
                                <button type="button" onclick="closeEditCoAuthorModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Action Buttons -->
                <div class="action-buttons">
                    <button type="submit">Add</button>
                    <button type="button" class="reset" onclick="resetCommonForm()">Reset</button>
                </div>
            </div>
        </form>
    </div>

</body>
