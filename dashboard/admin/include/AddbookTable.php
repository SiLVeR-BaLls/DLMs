<body>
    <div class="content">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <button onclick="showSection('title-section')" selected>Brief Title</button>
            <button onclick="showSection('series/note')">Series/Note</button>
            <button onclick="showSection('subject')">Subject</button>
            <button onclick="showSection('resources')">Resources</button>
            <button onclick="showSection('added-entrie')">Added Entries</button>
            <button onclick="showSection('RDA-type')">RDA type</button>
        </div>

        <!-- Main Container Section -->
        <div class="main-container">
            <!-- Main Content Section -->
            <div class="main-content" id="title-section">
                <h1>Title info</h1>
                <form id="common-form">
                    <label for="B_title">Title</label>
                    <input type="text" id="B_title" name="B_title">

                    <label for="subtitle">Subtitle</label>
                    <input type="text" id="subtitle" name="subtitle">

                    <label for="author">Author</label>
                    <input type="text" id="author" name="author">

                    <label for="edition">Edition</label>
                    <input type="text" id="edition" name="edition">

                    <h1>Standard Numbers</h1>
                    <div class="number">
                        <div class="input-group">
                            <label for="LCCN">LCCN</label>
                            <input type="text" id="LCCN" name="LCCN">
                        </div>
                        <div class="input-group">
                            <label for="ISBN">ISBN</label>
                            <input type="text" id="ISBN" name="ISBN">
                        </div>
                        <div class="input-group">
                            <label for="ISSN">ISSN</label>
                            <input type="text" id="ISSN" name="ISSN">
                        </div>
                    </div>

                    <label for="MT">Material Type</label>
                    <select name="MT" id="MT">
                        <option value="book">Book</option>
                        <option value="computer_file">Computer File</option>
                        <option value="ebook">Electronic Book (E-Book)</option>
                        <option value="artifact">Artifact</option>
                    </select>

                    <label for="ST">SubType</label>
                    <select name="ST" id="ST">
                        <option value="not_assigned">No SubType Assigned</option>
                        <option value="Braille">Braille</option>
                        <option value="Hardcover">Hardcover</option>
                        <option value="LargePrint">Large Print</option>
                    </select>

                    <h1>Publication Information</h1>
                    <label for="place">Place</label>
                    <input type="text" id="place" name="place">

                    <label for="publisher">Publisher</label>
                    <input type="text" id="publisher" name="publisher">

                    <label for="Pdate">Date</label>
                    <input type="date" id="Pdate" name="Pdate">

                    <label for="copyright">Copyright</label>
                    <input type="text" id="copyright" name="copyright">

                    <h1>Physical Description</h1>
                    <div>
                        <label for="extent">Extent</label>
                        <input type="text" id="extent" name="extent">
                    </div>
                    <div>
                        <label for="Odetail">Other Details</label>
                        <input type="text" id="Odetail" name="Odetail">
                    </div>
                    <div>
                        <label for="size">Size</label>
                        <input type="text" id="size" name="size">
                    </div>
                </form>
            </div>

            <div class="main-content" id="series/note">
                <h1>Series Info</h1>
                <form id="common-form">
                    <div>
                        <label for="extent">Title</label>
                        <input type="text" id="extent" name="extent">
                    </div>
                    <div>
                        <label for="volume">Volume</label>
                        <input type="text" id="volume" name="volume">
                    </div>
                    <div>
                        <label for="I_LVL">Interest Level</label>
                        <input type="text" id="I_LVL" name="I_LVL">
                    </div>
                    <div>
                        <label for="lexille">Lexile</label>
                        <select id="lexille" name="lexille">
                            <option value="">No Code</option>
                        </select>
                    </div>
                    <div>
                        <label for="F_and_P">Fountas and Pinnell</label>
                        <select id="F_and_P" name="F_and_P">
                            <option value="">Any Level</option>
                        </select>
                    </div>

                    <button type="button" onclick="openCommentModal()">Add Comment</button>
                    <div id="commentsDisplay"></div>

                    <!-- Comment Modal -->
                    <div id="commentModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeCommentModal()">&times;</span>
                            <h2>Add Comment</h2>
                            <textarea id="commentInput" rows="4" placeholder="Enter your comments here..."></textarea>
                            <div class="modal-actions">
                                <button type="button" onclick="submitComment()">Submit</button>
                                <button type="button" onclick="closeCommentModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="main-content" id="subject">
                <h1>Subject</h1>
            </div>

            <div class="main-content" id="resources">
                <h1>Link</h1>
                <form id="common-form">
                    <div>
                        <label for="url">URL</label>
                        <input type="url" id="url" name="url">
                    </div>
                    <div>
                        <label for="Description">Description</label>
                        <input type="text" id="Description" name="Description">
                    </div>
                </form>
            </div>

            <div class="main-content" id="added-entrie">
                <h1>Alternate Title</h1>
                <form id="common-form">
                    <label for="UTitle">Uniform Title</label>
                    <input  type="text" id="UTitle" name="UTitle">


                    <label for="VForm">Varying Form</label>
                    <input  type="text" id="VForm" name="VForm">


                    <label for="SUTitle">Series Uniform Title</label>
                    <input type="text" id="SUTitle" name="SUTitle">

                </form>
                <h1>Co-Authors, Illorstrator, Editor,  etc.</h1>
                <form id="common-form">
                    <label for="CName">Name</label>
                    <input type="text" id="CName" name="CName">


                    <label for="CDate">Date</label>
                    <input type="date" id="CDate" name="CDate">


                    <label for="CRole">Role</label>
                    <input type="text" id="CRole" name="CRole">

                </form>
            </div>

            <div class="main-content" id="RDA-type">
                <h1>RDA</h1>
            </div>
            <!-- Common Action Buttons -->
            <div class="action-buttons">
                <button type="button" onclick="saveForm()">Save</button>
                <button type="button" class="reset" onclick="resetCommonForm()">Reset</button>
            </div>
        </div>
    </div>
</body>
