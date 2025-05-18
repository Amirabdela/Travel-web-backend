document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".form-book");

  form.addEventListener("submit", (event) => {
    let valid = true;

    const showError = (field, message) => {
      valid = false;
      const errorContainer = document.getElementById(`${field}-error`);
      if (errorContainer) {
        errorContainer.textContent = message;
      } else {
        alert(message); // Fallback if error container is not found
      }
      console.error(`Validation failed for ${field}: ${message}`);
    };

    const clearError = (field) => {
      const errorContainer = document.getElementById(`${field}-error`);
      if (errorContainer) {
        errorContainer.textContent = "";
      }
    };

    // Validate Name
    const nameField = document.getElementById("name");
    clearError("name");
    if (nameField.value.trim().length < 2) {
      showError("name", "Name must be at least 2 characters long.");
    }

    // Validate Email
    const emailField = document.getElementById("email");
    const email = emailField.value.trim();
    clearError("email");
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      showError("email", "Please enter a valid email address.");
    }

    // Validate Phone Number
    const phoneField = document.getElementById("phone");
    const phoneValue = phoneField.value.trim();
    const sanitizedPhone = phoneValue.replace(/[^0-9]/g, "");
    clearError("phone");
    const phoneRegex = /^[0-9]{10,15}$/;
    if (!phoneRegex.test(sanitizedPhone)) {
      showError("phone", "Phone number must be a valid number and consist of 10 to 15 digits.");
    }

    // Validate Destination
    const destinationField = document.getElementById("destination");
    clearError("destination");
    if (!destinationField.value) {
      showError("destination", "Please select a destination.");
    }

    // Validate Dates
    const startDateField = document.getElementById("start-date");
    const endDateField = document.getElementById("end-date");
    const startDate = new Date(startDateField.value);
    const endDate = new Date(endDateField.value);
    clearError("dates");
    if (isNaN(startDate) || isNaN(endDate)) {
      showError("dates", "Please enter valid start and end dates.");
    } else if (startDate >= endDate) {
      showError("dates", "End date must be after the start date.");
    }

    // Validate Guests
    const guestsField = document.getElementById("guests");
    const guests = parseInt(guestsField.value, 10);
    clearError("guests");
    if (isNaN(guests) || guests < 1 || guests > 20) {
      showError("guests", "Number of guests must be between 1 and 20.");
    }

    if (!valid) {
      event.preventDefault(); // Stop form submission if validation fails
      console.error("Form validation failed.");
    } else {
      console.log("Form validation passed.");
    }
  });
});