// Variables to store field values
const infoForm = document.getElementById("info-form");
const usernameField = document.getElementById("username");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("password_confirm");

// Set an error message for any fields with invalid info
const setError = (element, message) => {
    const showError = element.parentElement.querySelector('.error');
    showError.textContent = message;
}

// This will clear an error for the field if needed
const clearError = (element) => {
    const showError = element.parentElement.querySelector('.error');
    showError.textContent = '';
}

// Add an event listener for the form submission
infoForm.addEventListener("submit", (e) => {
    // Boolean flag to determine if any errors exist
    let existErrors = false;

    // Rules for username field: display error message and set bool flag 'true', else, clear the error
    if (usernameField.value.trim() === '') {
        setError(usernameField, "Username is required");
        existErrors = true;
    } else {
        clearError(usernameField);
    }

    // Rules for email field: same as username field
    if (emailField.value.trim() === '') {
        setError(emailField, "Email address is required");
        existErrors = true;
    } else {
        clearError(emailField);
    }

    // Rules for password field: display error message if password is blank OR if it doesn't contain 1 letter 1 number
    // OR if password is less than 8 characters
    // Regex needed for 1 letter, 1 number password requirements
    const passRegex = /^(?=.*[a-zA-Z])(?=.*[0-9]).+/;

    if (passwordField.value.trim() === '') {
        setError(passwordField, "Password is required");
        existErrors = true;
    } else if (!passRegex.test(passwordField.value)) {
        setError(passwordField, "Password must contain at least 1 letter and 1 number");
        existErrors = true;
    } else if (passwordField.value.length < 8) {
        setError(passwordField, "Password must be at least 8 character long");
        existErrors = true;
    } else {
        clearError(passwordField);
    }

    // Rules for password confirmation field: field must not be blank and must match passwordField value
    if (confirmPasswordField.value.trim() === '') {
        setError(confirmPasswordField, "Please confirm your password");
        existErrors = true;
    } else if (confirmPasswordField.value !== passwordField.value) {
        setError(confirmPasswordField, "Passwords do not match");
        existErrors = true;
    } else {
        clearError(confirmPasswordField);
    }

    // If any errors exist, prevent the form submission entirely
    if (existErrors === true) {
        e.preventDefault();
    }
})