document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    
    form.addEventListener('submit', function (event) {
        const isValid = validateForm(); // Perform validation checks
        if (!isValid) {
            event.preventDefault(); // Block form submission if validation fails
        }
    });

    function validateForm() {
        let isValid = true;

        // Full Name validation
        const fullName = document.getElementById('fullName');
        if (fullName.value.trim() === '') {
            showError(fullName, 'Full name is required');
            isValid = false;
        } else {
            removeError(fullName);
        }

        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // General email validation regex

        if (!emailRegex.test(email.value.trim())) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        } else {
            removeError(email);
        }

        // Password validation
        const password = document.getElementById('password');
        if (password.value.length < 8) {
            showError(password, 'Password must be at least 8 characters long');
            isValid = false;
        } else {
            removeError(password);
        }

        // Country validation
        const country = document.getElementById('country');
        if (country.value.trim() === '') {
            showError(country, 'Country is required');
            isValid = false;
        } else {
            removeError(country);
        }

        // Contact Number validation
        const contactNumber = document.getElementById('contactNumber');
        const phoneRegex = /^\+[1-9]\d{1,14}$/; // E.164 phone number format
        if (!phoneRegex.test(contactNumber.value.trim())) {
            showError(contactNumber, 'Please enter a valid phone number in E.164 format');
            isValid = false;
        } else {
            removeError(contactNumber);
        }

        return isValid; // Returns true only if all fields are valid
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        let errorElement = formGroup.querySelector('.error');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'error';
            formGroup.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
    }

    function removeError(input) {
        const formGroup = input.parentElement;
        const errorElement = formGroup.querySelector('.error');
        if (errorElement) {
            formGroup.removeChild(errorElement);
        }
    }
});
