<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Basic styling for the page to ensure proper height and layout */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            .min-h-screen {
        min-height: 100vh;
    }

    /* Footer background color */
    .bg-footer {
        background-color: #4a5568;
    }

    .hover\:bg-footer:hover {
        background-color: #2d3748;
    }

    /* Styling for the logo */
    .logo {
        width: 150px;
    }

    /* Top bar style for navigation */
    .top-bar {
        background-color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-bar a {
        color: #2d3748;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .top-bar a:hover {
        color: #4a5568;
    }

    .logo-container {
        margin-left: auto;
        margin-right: auto;
    }

    /* Styling for headings */
    h2 {
        color: #4a5568;
    }

    /* Footer link color */
    .text-footer {
        color: #4a5568;
    }

    .text-footer:hover {
        color: #2d3748;
    }

    /* Styling for error messages */
    .error {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Adds spacing between form and footer */
    .form-container {
        margin-bottom: 2rem;
    }
</style>
</head>
<body class="bg-gray-100">
    <!-- Main Container for the Page -->
<div class="min-h-screen flex flex-col">
    <!-- Top Bar with About Us link -->
    <div class="top-bar flex justify-between items-center px-4">
        <a href="../user_view/about.php" class="hover:text-gray-300">About Us</a>
        <div class="logo-container">
            <img src="../images/foos.png" alt="FOOS Logo" class="logo">
        </div>
    </div>

    <!-- Main Content Section -->
    <main class="flex-grow container mx-auto px-4">
    
        <!-- Registration Form Section -->
        <section class="max-w-md mx-auto mt-12 bg-white shadow-md rounded-lg p-8 form-container">
        
            <!-- Form Heading -->
            <h2 class="text-2xl font-bold text-center mb-6">Create Your Account</h2>
            
            <!-- Form begins here -->
            <form method="post" action="../actions/add_user_action.php" id="registrationForm" accept-charset="UTF-8">
                <!-- Full Name Field -->
                <div class="mb-4">
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Full Name -->
                    <div class="error" id="fullName-error"></div>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Email -->
                    <div class="error" id="email-error"></div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Password -->
                    <div class="error" id="password-error"></div>
                </div>

                <!-- Country Field -->
                <div class="mb-4">
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <input type="text" id="country" name="country" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Country -->
                    <div class="error" id="country-error"></div>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="city" name="city" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Country -->
                    <div class="error" id="city-error"></div>
                </div>

                <!-- Contact Number Field -->
                <div class="mb-4">
                    <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" id="contactNumber" name="contactNumber" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Error message for Contact Number -->
                    <div class="error" id="contactNumber-error"></div>
                </div>

                <!-- Terms and Conditions Checkbox -->
                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="termsAndConditions" name="termsAndConditions" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="termsAndConditions" class="ml-2 text-sm font-medium text-gray-700">
                            I have read and agree to the <a href="../user_view/Terms&Conditions.php" class="text-blue-600 hover:underline">Terms and Conditions</a>
                        </label>
                    </div>
                    <!-- Error message for Terms and Conditions checkbox -->
                    <div class="error" id="termsAndConditions-error"></div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between mb-4">
                    <input type="submit" value="Register" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                </div>
                
                <!-- Link to Login Page -->
                <p class="text-center text-sm text-footer">
                    <a href="login.php" class="text-footer hover:text-footer">Already have an account? Log in</a>
                </p>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-footer text-white py-8 mt-auto">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Copyright Notice -->
            <p>&copy; 2023 FOOS. All rights reserved.</p>
            <!-- Social Media Links -->
            <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</div>

<!-- Link to JavaScript file for form validation -->
<script src="../js/register.js"></script>

<script>
    // Function to get URL parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Check if 'register' parameter is in the URL
    const registerStatus = getQueryParam('register');

    // Handle different registration statuses
    if (registerStatus) {
        if (registerStatus === 'failed') {
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: 'There was an error registering. Please try again.',
            });
        } else if (registerStatus === 'email_duplicate') {
            Swal.fire({
                icon: 'warning',
                title: 'Email Already Registered',
                text: 'This email is already registered. Please use another email.',
            });
        }

        // Remove the 'register' parameter from the URL after displaying the alert
        const url = new URL(window.location.href);
        url.searchParams.delete('register');
        window.history.replaceState({}, document.title, url.toString());
    }
    // Add event listener to the registration form submission
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        // Get the terms and conditions checkbox
        var termsAndConditionsCheckbox = document.getElementById('termsAndConditions');

        // Check if the terms and conditions checkbox is checked
        if (!termsAndConditionsCheckbox.checked) {
            // Display an error message
            document.getElementById('termsAndConditions-error').textContent = 'Please read and agree to the Terms and Conditions.';
            event.preventDefault(); // Prevent form submission
        } else {
            // Clear the error message
            document.getElementById('termsAndConditions-error').textContent = '';
        }
    });
</script>
</body>
</html>