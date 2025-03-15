document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();  // Prevent form submission if validation fails
        }
    });

    function validateForm() {
        let isValid = true;

        // Email validation - more sophisticated check
        const email = document.getElementById('email');
        
        // Sophisticated email regex to check valid format
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (email.value.trim() === '') {
            showError(email, 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid email address.');
            isValid = false;
        } else {
            // Check if the domain of the email has a valid structure
            const domain = email.value.split('@')[1];
            if (domain) {
                // Check if the domain has a TLD (like .com, .org, etc.)
                const domainParts = domain.split('.');
                if (domainParts.length < 2 || domainParts[domainParts.length - 1].length < 2) {
                    showError(email, 'Please enter a valid email address with a proper domain.');
                    isValid = false;
                }
            } else {
                showError(email, 'Invalid domain.');
                isValid = false;
            }
            removeError(email);
        }

        // Password validation
        const password = document.getElementById('password');
        if (password.value.trim() === '') {
            showError(password, 'Password is required');
            isValid = false;
        } else if (password.value.length < 8) {
            showError(password, 'Password must be at least 8 characters long');
            isValid = false;
        } else {
            removeError(password);
        }

        return isValid;
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        let errorElement = formGroup.querySelector('.error');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'error text-red-500 text-sm mt-1';
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
