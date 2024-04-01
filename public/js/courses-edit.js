let editMode = false;
let originalTexts = {}; // Object to store original texts

function toggleEditMode() {
  editMode = !editMode;
  document.getElementById("editModeToggle").textContent = `Edit Mode: ${
    editMode ? "On" : "Off"
  }`;
  document.getElementById("saveAll").style.display = editMode
    ? "inline-block"
    : "none";
  document.getElementById("cancelEdit").style.display = editMode
    ? "inline-block"
    : "none";

  const editableElements = document.querySelectorAll(".editable");
  editableElements.forEach((element) => {
    const courseID = element.closest(".course__row").id.split("-")[1];
    if (editMode) {
      // Store the original text when entering edit mode
      originalTexts[courseID] = element.innerText;
    }
    element.contentEditable = editMode;
    element.classList.toggle("is-editing", editMode);
  });
}

function saveAllChanges() {
  const courses = [];
  const editableElements = document.querySelectorAll(".editable");
  editableElements.forEach((element) => {
    const courseID = element.closest(".course__row").id.split("-")[1];
    const courseName = element.innerText;
    courses.push({ courseID, courseName }); // Collect all courses' updated info
  });

  // AJAX call to save the changes
  fetch("?action=update_courses", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ courses }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Success:", data.message);

      // Exit edit mode
      toggleEditMode();
    })
    .catch((error) => {
      console.error("Error:", error);
    });

  // Clear stored original texts after attempting to save
  originalTexts = {};
}

function cancelEditMode() {
  const editableElements = document.querySelectorAll(".editable");
  editableElements.forEach((element) => {
    const courseID = element.closest(".course__row").id.split("-")[1];
    // Revert each element to its original text
    element.innerText = originalTexts[courseID];
    element.contentEditable = false;
    element.classList.remove("is-editing");
  });

  // Clear stored original texts after canceling
  originalTexts = {};

  // Update button visibility and edit mode status
  document.getElementById("editModeToggle").textContent = "Edit Mode: Off";
  document.getElementById("saveAll").style.display = "none";
  document.getElementById("cancelEdit").style.display = "none";
  editMode = false;
}
