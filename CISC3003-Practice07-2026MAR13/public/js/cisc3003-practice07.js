
/* CISC3003 Practice 07 - Art Store Form Validation */

// Wait for the page to fully load before setting up event listeners
window.addEventListener("load", function () {

    // 1. Add focus and blur event listeners to all "hilightable" elements
    var hilightables = document.querySelectorAll(".hilightable");

    for (var i = 0; i < hilightables.length; i++) {
        // When the element receives focus, add the "highlight" class
        hilightables[i].addEventListener("focus", function () {
            this.classList.add("highlight");
        });

        // When the element loses focus, remove the "highlight" class
        hilightables[i].addEventListener("blur", function () {
            this.classList.remove("highlight");
        });
    }

    // 2. Add submit event handler for the form
    var form = document.getElementById("mainForm");

    form.addEventListener("submit", function (event) {
        var requiredFields = document.querySelectorAll(".required");
        var hasError = false;

        for (var j = 0; j < requiredFields.length; j++) {
            // Check if the required field is empty
            if (requiredFields[j].value.trim() === "") {
                // Add error class to the empty field
                requiredFields[j].classList.add("error");
                hasError = true;
            } else {
                // Remove error class if the field has content
                requiredFields[j].classList.remove("error");
            }
        }

        // If there are errors, prevent form submission
        if (hasError) {
            event.preventDefault();
        }
    });

    // 3. Add input event handler for required fields to remove error class when content is changed
    var requiredFields = document.querySelectorAll(".required");

    for (var k = 0; k < requiredFields.length; k++) {
        requiredFields[k].addEventListener("input", function () {
            if (this.value.trim() !== "") {
                this.classList.remove("error");
            }
        });
    }

});