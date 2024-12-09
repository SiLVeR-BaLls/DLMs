<body class="bg-gray-100">

  <div class="min-h-screen bg-gray-100">
    <!-- Navbar Section -->
    <!-- Main Form Section -->
    <nav class="bg-blue-600 sticky top-0 p-4 shadow-md z-10">
      <div class="container mx-auto flex justify-between items-center">
        <div class="text-white font-bold text-lg">
          <a href="#">Library Catalog</a>
        </div>
        <div class="space-x-4">
          <button onclick="showSection('title-section')" class="text-white hover:text-blue-300">Brief
            Title</button>
          <button onclick="showSection('series/note')" class="text-white hover:text-blue-300">Series/Note</button>
          <button onclick="showSection('subject')" class="text-white hover:text-blue-300">Subject</button>
          <button onclick="showSection('resources')" class="text-white hover:text-blue-300">Resources</button>
          <button onclick="showSection('added-entrie')" class="text-white hover:text-blue-300">Added
            Entries</button>
        </div>
      </div>
    </nav>

    <form action="include/AddConnect.php" method="post" class="py-8 px-4">
      <div class="max-w-7xl mx-auto">
        <!-- Title Info Section -->
        <div class="mb-8" id="title-section">
          <h1 class="text-3xl font-bold text-blue-600 mb-6">Title Info</h1>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="B_title" class="block text-sm font-medium text-gray-700">Title</label>
              <input type="text" id="B_title" name="B_title" required placeholder="Enter the book title"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
              <input type="text" id="subtitle" name="subtitle" placeholder="Enter subtitle if any"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
              <input type="text" id="author" name="author" placeholder="Enter author name"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="edition" class="block text-sm font-medium text-gray-700">Edition</label>
              <input type="text" id="edition" name="edition" placeholder="Edition of the book"
                class="w-full px-4 py-2 border rounded-md">
            </div>
          </div>
          <h2 class="text-xl font-semibold mt-6">Standard Numbers</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
              <label for="LCCN" class="block text-sm font-medium text-gray-700">LCCN</label>
              <input type="text" id="LCCN" name="LCCN" placeholder="Enter LCCN"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="ISBN" class="block text-sm font-medium text-gray-700">ISBN</label>
              <input type="text" id="ISBN" name="ISBN" placeholder="Enter ISBN number"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="ISSN" class="block text-sm font-medium text-gray-700">ISSN</label>
              <input type="text" id="ISSN" name="ISSN" placeholder="Enter ISSN number"
                class="w-full px-4 py-2 border rounded-md">
            </div>
          </div>
          <div class="mt-6">
            <label for="MT" class="block text-sm font-medium text-gray-700">Material Type</label>
            <select name="MT" id="MT" class="w-full px-4 py-2 border rounded-md">
              <option selected value="">Select Material Type</option>
              <option value="Book">Book</option>
              <option value="Computer File">Computer File</option>
              <option value="Electronic Book">Electronic Book (E-Book)</option>
              <option value="Equipment">Equipment</option>
              <option value="Kit">Kit</option>
              <option value="Manuscript Language Material">Manuscript Language Material</option>
              <option value="Map">Map</option>
              <option value="Mixed Material">Mixed Material</option>
              <option value="Music">Music (Printed)</option>
              <option value="Picture">Picture</option>
              <option value="Serial">Serial</option>
              <option value="Musical Sound Recording">Musical Sound Recording</option>
              <option value="NonMusical Sound Recording">NonMusical Sound Recording</option>
              <option value="Video">Video</option>
            </select>
          </div>

          <div class="mt-6">
            <label for="ST" class="block text-sm font-medium text-gray-700">SubType</label>
            <select name="ST" id="ST" class="w-full px-4 py-2 border rounded-md">
              <option value="not_assigned" selected>No SubType Assigned</option>
              <option value="Braille">Braille</option>
              <option value="Hardcover">Hardcover</option>
              <option value="LargePrint">Large Print</option>
              <option value="Paperback">Paperback</option>
              <option value="Picture Book">Picture Book</option>
              <option value="Dictionary">Dictionary</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <h2 class="text-xl font-semibold mt-6">Publication Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
              <label for="place" class="block text-sm font-medium text-gray-700">Place</label>
              <input type="text" id="place" name="place" placeholder="Place of publication"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
              <input type="text" id="publisher" name="publisher" placeholder="Publisher name"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="Pdate" class="block text-sm font-medium text-gray-700">Date</label>
              <input type="date" id="Pdate" name="Pdate" class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="copyright" class="block text-sm font-medium text-gray-700">Copyright</label>
              <input type="text" id="copyright" name="copyright" placeholder="Enter copyright details"
                class="w-full px-4 py-2 border rounded-md">
            </div>
          </div>

          <h2 class="text-xl font-semibold mt-6">Physical Description</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
              <label for="extent" class="block text-sm font-medium text-gray-700">Extent</label>
              <input type="text" id="extent" name="extent" placeholder="Number of pages or length"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
              <input type="text" id="size" name="size" placeholder="Dimensions of the book"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="Odetail" class="block text-sm font-medium text-gray-700">Other Details</label>
              <input type="text" id="Odetail" name="Odetail" placeholder="Any additional details"
                class="w-full px-4 py-2 border rounded-md">
            </div>
          </div>
        </div>

        <!-- Series Info Section -->
        <div class="mb-8" id="series/note">
          <h1 class="text-3xl font-bold text-blue-600 mb-6">Series Info</h1>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="volume" class="block text-sm font-medium text-gray-700">Volume</label>
              <input type="text" id="volume" name="volume" placeholder="Enter volume number"
                class="w-full px-4 py-2 border rounded-md">
            </div>
           
          </div>
          <button type="button" onclick="openCommentModal()" class="bg-blue-600 text-white px-4 py-2 rounded-md mt-4">
              Add Comment
          </button>
        </div>

        <!-- Subject Section -->
        <div class="mb-8" id="subject">


          <h1 class="text-2xl font-semibold text-blue-600 mb-4">Subject</h1>
          <div class="subject-item grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <!-- Subject Heading Select -->
            <div>
              <label for="Sub_Head" class="block text-sm text-gray-700">Subject Heading</label>
              <select name="Sub_Head[]"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <option value="Tropical Heading" selected>Tropical Heading</option>
                <option value="Personal Heading">Personal Heading</option>
                <option value="Geographic Heading">Geographic Heading</option>
                <option value="Local Heading">Local Heading</option>
              </select>
            </div>

            <!-- Subject Details Input -->
            <div>
              <label for="Sub_Head_input" class="block text-sm text-gray-700">Subject Heading Details</label>
              <input type="text" name="Sub_Head_input[]"
                class="w-full px-3 py-2 border border-gray-300 rounded-md mt-2 focus:ring-2 focus:ring-blue-500"
                placeholder="Enter subject heading details">
            </div>
          </div>

          <!-- Button to Add Subject -->
          <button type="button" id="addSubject" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4">Add
            Subject</button>

          <!-- Container for dynamically added subjects -->
          <div id="subjectsContainer" class="mt-4"></div>
        </div>

        <script>
                  // Handle the adding of a subject entry
                  document.getElementById('addSubject').addEventListener('click', function () {
                    // Get the values from the form fields
                    const subHead = document.querySelector('select[name="Sub_Head[]"]').value;
                    const subHeadInput = document.querySelector('input[name="Sub_Head_input[]"]').value;

                    // Validate input before adding
                    if (subHead && subHeadInput) {
                      // Create a new display element for the subject
                      const subjectsContainer = document.getElementById('subjectsContainer');
                      const newSubjectDisplay = document.createElement('div');
                      newSubjectDisplay.classList.add('subject-entry');
                      newSubjectDisplay.classList.add('mb-4');
                      newSubjectDisplay.innerHTML = `
              <div class="flex justify-between items-center">
                <div>
                  <span><strong>Heading:</strong> ${subHead} - ${subHeadInput}</span>
                </div>
                <div class="space-x-2">
                  <button type="button" class="removeSubjectBtn">
                    <i class="fas fa-trash-alt"></i> Remove
                  </button>
                </div>
              </div>
            `;
                      subjectsContainer.appendChild(newSubjectDisplay);

                      // Create hidden input fields for the new subject to submit via the form
                      const form = document.querySelector('form');

                      // Create hidden inputs for the subject data
                      const hiddenInputs = [
                        { name: 'Sub_Head[]', value: subHead },
                        { name: 'Sub_Head_input[]', value: subHeadInput }
                      ];

                      hiddenInputs.forEach(inputData => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = inputData.name;
                        input.value = inputData.value;
                        form.appendChild(input);
                      });

                      // Clear the form inputs for the next entry
                      document.querySelector('select[name="Sub_Head[]"]').value = '';
                      document.querySelector('input[name="Sub_Head_input[]"]').value = '';
                    } else {
                      alert("Please fill out all fields.");
                    }
                  });

                  // Handle the removal of a subject entry
                  document.getElementById('subjectsContainer').addEventListener('click', function (e) {
                    // Check if the clicked element is a remove button
                    if (e.target && e.target.classList.contains('removeSubjectBtn')) {
                      // Remove the subject entry from the DOM
                      const subjectEntry = e.target.closest('.subject-entry');
                      subjectEntry.remove();

                      // Optionally, remove corresponding hidden input fields here (if needed)
                      // const subHead = subjectEntry.querySelector('span').textContent;
                      // const hiddenInputs = document.querySelectorAll(`input[name='Sub_Head[]']`);
                      // hiddenInputs.forEach(input => {
                      //   if (input.value === subHead) {
                      //     input.remove();
                      //   }
                      // });
                    }
                  });

        </script>


        <!-- Resources Section -->
        <div class="mb-8" id="resources">
          <h1 class="text-3xl font-bold text-blue-600 mb-6">Resources</h1>
          <div class="grid grid-cols-1 gap-4">
            <div>
              <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
              <input type="url" id="url" name="url" placeholder="Enter the resource URL"
                class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
              <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
              <input type="text" id="Description" name="Description" placeholder="Provide a description"
                class="w-full px-4 py-2 border rounded-md">
            </div>
          </div>
        </div>

        <!-- Added Entries Section -->
        <div class="mb-8" id="added-entrie">
          <h1 class="text-3xl font-bold text-blue-600 mb-6">Alternate Title</h1>
          <div>
            <label for="UTitle" class="block text-sm font-medium text-gray-700">Uniform Title</label>
            <input type="text" id="UTitle" name="UTitle" placeholder="Enter uniform title"
              class="w-full px-4 py-2 border rounded-md">
          </div>
          <div>
            <label for="VForm" class="block text-sm font-medium text-gray-700">Varying Form</label>
            <input type="text" id="VForm" name="VForm" placeholder="Enter varying form"
              class="w-full px-4 py-2 border rounded-md">
          </div>
          <div>
            <label for="SUTitle" class="block text-sm font-medium text-gray-700">Series Uniform
              Title</label>
            <input type="text" id="SUTitle" name="SUTitle" placeholder="Enter series uniform title"
              class="w-full px-4 py-2 border rounded-md">
          </div>

          <h1 class="text-3xl font-bold text-blue-600 mb-6 mt-8">Co-Authors, Illustrator, Editor, etc.</h1>
          <div id="coAuthorsContainer">
            <h1 class="text-2xl font-semibold mb-4">Co-Authors, Illustrator, Editor, etc.</h1>

            <div class="space-y-6">
              <!-- Dynamically added co-authors will be displayed here -->
              <div id="coAuthorsList" class="space-y-4"></div>

              <!-- Co-author entry fields in a row layout -->
              <div class="flex space-x-6">
                <div class="flex-1">
                  <label for="Co_Name[]" class="block text-sm font-medium text-gray-700">Co-Author's Name</label>
                  <input type="text" name="Co_Name[]" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter co-author's name">
                </div>

                <div class="flex-1">
                  <label for="Co_Date[]" class="block text-sm font-medium text-gray-700">Co-Author's Date</label>
                  <input type="date" name="Co_Date[]" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>

                <div class="flex-1">
                  <label for="Co_Role[]" class="block text-sm font-medium text-gray-700">Co-Author's Role</label>
                  <input type="text" name="Co_Role[]" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                    placeholder="Enter co-author's role">
                </div>
              </div>

              <button type="button" id="addCoAuthor"
                class="mt-4 bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Add
                Another Co-Author</button>
            </div>
          </div>



        </div>
        <!-- Common Action Buttons -->
        <div class="flex justify-between mt-8">
          <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md ml-auto">Add</button>
        </div>
    </form>
  </div>
  <!-- navbar -->
  <script>
    function showSection(id) {
      const sections = document.querySelectorAll('.mb-8');
      sections.forEach(section => section.classList.add('hidden'));
      document.getElementById(id).classList.remove('hidden');
    }

    // Default to showing the title section initially
    document.addEventListener('DOMContentLoaded', () => {
      showSection('title-section');
    });

  </script>

  <!-- co_author -->
  <script>document.getElementById('addCoAuthor').addEventListener('click', function () {
      // Get the form fields
      const coName = document.querySelector('input[name="Co_Name[]"]').value;
      const coDate = document.querySelector('input[name="Co_Date[]"]').value;
      const coRole = document.querySelector('input[name="Co_Role[]"]').value;

      // Validate input before adding
      if (coName && coDate && coRole) {
        // Create a new co-author entry display below the form
        const coAuthorsContainer = document.getElementById('coAuthorsContainer');
        const newCoAuthorDisplay = document.createElement('div');
        newCoAuthorDisplay.classList.add('form-co-author');
        newCoAuthorDisplay.innerHTML = `
          <div>
              <span>${coName}</span>
   
              <label>-</label>
              <span>${coDate}</span>
     
              <label>-</label>
              <span>(${coRole})</span>
              <button type="button" class="removeCoAuthor  r-0">Remove</button>
              </div>
      `;
        coAuthorsContainer.appendChild(newCoAuthorDisplay);

        // Add hidden input fields for submission
        const form = document.querySelector('form'); // Assuming your form has a <form> tag
        const coNameInput = document.createElement('input');
        coNameInput.type = 'hidden';
        coNameInput.name = 'Co_Name[]';
        coNameInput.value = coName;
        form.appendChild(coNameInput);

        const coDateInput = document.createElement('input');
        coDateInput.type = 'hidden';
        coDateInput.name = 'Co_Date[]';
        coDateInput.value = coDate;
        form.appendChild(coDateInput);

        const coRoleInput = document.createElement('input');
        coRoleInput.type = 'hidden';
        coRoleInput.name = 'Co_Role[]';
        coRoleInput.value = coRole;
        form.appendChild(coRoleInput);

        // Clear input fields for the next entry
        document.querySelector('input[name="Co_Name[]"]').value = '';
        document.querySelector('input[name="Co_Date[]"]').value = '';
        document.querySelector('input[name="Co_Role[]"]').value = '';
      } else {
        alert("Please fill out all fields.");
      }
    });

    // Event listener for removing co-authors from display
    document.getElementById('coAuthorsContainer').addEventListener('click', function (e) {
      if (e.target.classList.contains('removeCoAuthor')) {
        e.target.parentElement.remove();

        // Also remove the corresponding hidden input from the form
        const coName = e.target.previousElementSibling.previousElementSibling.previousElementSibling.querySelector('span').textContent;
        const coInputs = document.querySelectorAll(`input[name='Co_Name[]']`);

        for (const input of coInputs) {
          if (input.value === coName) {
            input.remove();
            break;
          }
        }
      }
    });
  </script>
  </body>