const courses = {
  cit: {
    advancedEducation: [
      "Doctor of Ind Tech (DIT) - Level I",
      "Master of Ind Tech (MIT) - Level I",
    ],
    baccalaureate: [
      "BS in Ind Tech (BIT) - Level III",
      "BS in Auto Tech (BSAT) - Level III",
      "BS in Hotel & Rest Tech (BSHRT) - Level II",
      "BS in Elec Tech (BSELT) - Level III",
      "BS in Elec Eng (BSELX) - Level III",
      "BS in Fashion Design & Merch (BSFDM) - Level II",
    ],
    majors: [
      "Arch Drafting",
      "Auto Tech",
      "Const Tech",
      "Elec Tech",
      "Elec Eng Tech",
      "Fashion & Apparel Tech",
      "Furn & Cabinet Making Tech",
      "Mech Tech",
      "Refrig & Air Cond Tech",
      "Food Tech",
      "Welding & Fab Tech",
    ],
    eveningVocational: [
      "Arch Drafting",
      "Auto Mechanics",
      "Machine Shop Tech",
      "Welding & Fab",
      "HVACR Tech",
      "Apparel Tech",
      "Culinary Arts",
      "Ind Elec",
      "Cosmetology",
    ],
    etcCourses: [
      "Auto Servicing",
      "Ind Elec",
      "Dom Refrig & Air Cond",
      "Comm Refrig & Air Cond",
      "Dressmaking",
      "Lathe Machine Op",
      "Comm Cooking",
      "Consumer Elec Tech",
      "Plate Welding (SMAW)",
    ],
    additionalPrograms: [
      "BS in Entrep",
      "BS in Hosp Management",
      "BS in Tourism Management",
    ],
    hospitalityMajors: ["Culinary Arts", "Cruiseship"],
  },
  coe: {
    advancedEducation: [
      "Doctor of Ed",
      "MA in Ed",
      "MS in Home Econ",
      "MS in TVET Ed",
      "Master of Tech & Liv Ed",
    ],
    postBaccalaureate: ["Diploma in Teaching"],
    baccalaureate: ["BEEd ", "BSEd ", "BTVTEd", "BS in Ind Ed"],
  },
  cas: {
    advancedEducation: ["MS in Comp Sci", "MA in Math"],
    baccalaureate: [
      "BS in English",
      "BS in Human Services",
      "BS in Bio)",
      "BS in Comm Dev",
      "BS in Comp Sci",
      "BS in Info Systems",
      "BS in Info Tech",
      "BS in Math",
    ],
  },
  cea: {
    baccalaureate: [
      "BS in Architecture",
      "BS in Civil Eng",
      "BS in Elec Eng",
      "BS in Mech Eng",
      "BS in Elec Eng (ECE)",
    ],
  },
};

function updateCourses() {
  const collegeSelect = document.getElementById("college");
  const courseSelect = document.getElementById("course");
  const selectedCollege = collegeSelect.value;

  // Clear existing course options
  courseSelect.innerHTML =
    '<option value="" selected disabled>Select Course</option>';

  // Check if a college is selected and exists in the courses object
  if (selectedCollege && courses[selectedCollege]) {
    const courseList = courses[selectedCollege].baccalaureate || []; // Default to 'baccalaureate' courses

    // Populate the course dropdown with the options from the selected college
    courseList.forEach((course) => {
      const option = document.createElement("option");
      option.value = course;
      option.textContent = course;
      courseSelect.appendChild(option);
    });
  }
}

// Call this function when the college dropdown changes
document.getElementById("college").addEventListener("change", updateCourses);

//radio button of deiable text box not chossen
document.addEventListener("DOMContentLoaded", function () {
  const customRadio = document.getElementById("custom");
  const outCampusRadio = document.getElementById("outCampus");
  const textBox = document.getElementById("user_id");

  function toggleTextBox() {
    textBox.disabled = !customRadio.checked;
  }
  // Add event listeners for radio buttons
  customRadio.addEventListener("change", toggleTextBox);
  outCampusRadio.addEventListener("change", toggleTextBox);
  // Initialize the disabled state based on the default checked state
  toggleTextBox();
});

//repaet password

// Form validation on submit
document
  .getElementById("registration-form")
  .addEventListener("submit", function (event) {
    const password = document.getElementById("password").value;
    const passwordRepeat = document.getElementById("password-repeat").value;
    const errorMessage = document.getElementById("error-message");

    if (password !== passwordRepeat) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Passwords do not match.",
      });
      event.preventDefault(); // Prevent form submission
    } else {
      errorMessage.textContent = ""; // Clear error message
    }
  });

//password visible
function togglePasswordVisibility(passwordId, iconId) {
  const passwordField = document.getElementById(passwordId);
  const icon = document.getElementById(iconId);

  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.textContent = "📖"; // Open book (showing password)
  } else {
    passwordField.type = "password";
    icon.textContent = "📚"; // Closed book (hiding password)
  }
}

//login
// Function to get the query string parameters
function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

// Function to display error messages
function displayErrorMessage() {
  const error = getQueryParam("error");
  let message = "";

  switch (error) {
    case "wrongpassword":
      message = "Incorrect password. Please try again.";
      break;
    case "wrongusername":
      message = "Username does not exist. Please try again.";
      break;
    default:
      message = "";
  }

  if (message) {
    const overlay = document.createElement("div");
    overlay.className = "overlay";
    document.body.appendChild(overlay);

    const popup = document.createElement("div");
    popup.className = "popup-message";
    popup.innerHTML = `<p>${message}</p>`;
    document.body.appendChild(popup);

    // Display the overlay and pop-up
    overlay.style.display = "block";
    popup.style.display = "block";

    // Close the pop-up when clicking outside of it
    overlay.addEventListener("click", function (event) {
      if (event.target === overlay) {
        overlay.style.display = "none";
        popup.style.display = "none";
      }
    });

    // Hide the pop-up after 5 seconds
    setTimeout(() => {
      overlay.style.display = "none";
      popup.style.display = "none";
    }, 5000);
  }
}

// Call the function to display error message when the page loads
window.onload = displayErrorMessage;

//idno problem

function toggleIdInput(isManual) {
  const manualIdContainer = document.getElementById("manual-id-container");
  if (isManual) {
    manualIdContainer.style.display = "block"; // Show the manual ID input
  } else {
    manualIdContainer.style.display = "none"; // Hide the manual ID input
  }
}

let currentStep = 1;

function showStep(step) {
  document.querySelectorAll(".form-step").forEach((element) => {
    element.style.display = "none";
  });
  document.getElementById(`step-${step}`).style.display = "block";

  const registerBtn = document.getElementById("registerBtn");
  const nextBtn = document.querySelector('button[type="button"]');

  if (step === 3) {
    nextBtn.style.display = "none";
    registerBtn.style.display = "block";
  } else {
    nextBtn.style.display = "block";
    registerBtn.style.display = "none";
  }
}

function nextStep() {
  if (currentStep < 3) {
    currentStep++;
    showStep(currentStep);
  } else {
    register();
  }
}
