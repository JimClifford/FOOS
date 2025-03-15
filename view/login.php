<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Link to Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS for page styling -->
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .min-h-screen {
            min-height: 100vh; /* Ensures full page height */
        }

        .bg-footer {
            background-color: #4a5568; /* Dark background color for footer */
        }

        .hover\:bg-footer:hover {
            background-color: #2d3748; /* Darker shade on hover for footer */
        }

        .logo {
            width: 150px; /* Logo size */
        }

        /* Style for the top bar with "About Us" link and logo */
        .top-bar {
            background-color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar a {
            color: #2d3748; /* Text color for links in the top bar */
            font-weight: 600;
            font-size: 1.1rem;
        }

        .top-bar a:hover {
            color: #4a5568; /* Text color change on hover */
        }

        .logo-container {
            margin-left: auto;
            margin-right: auto;
        }

        /* Heading style */
        h2 {
            color: #4a5568; /* Heading color */
        }

        /* Footer link color and hover effect */
        .text-footer {
            color: #4a5568;
        }

        .text-footer:hover {
            color: #2d3748; /* Darker shade on hover */
        }
        
        /* Style for error messages */
        .error {
            color: #e53e3e; /* Red color for error messages */
            font-size: 0.875rem; /* Smaller font size for error messages */
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!-- Top Bar with About Us link -->
        <div class="top-bar flex justify-between items-center px-4">
            <a href="../user_view/about.php" class="hover:text-gray-300">About Us</a> <!-- About Us link -->
            <div class="logo-container">
                <img src="../images/foos.png" alt="FOOS Logo" class="logo"> <!-- FOOS Logo -->
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 mb-16">
        
            <!-- Login Form Section -->
            <section class="max-w-md mx-auto mt-12 bg-white shadow-md rounded-lg p-8">
            
                <h2 class="text-2xl font-bold text-center mb-6">Login to Your Account</h2> <!-- Form Heading -->
                <form method="post" action="../actions/login_user_action.php" id="loginForm">
                    <!-- Email Input Field -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <!-- Error message will be injected here -->
                        <div class="error" id="email-error"></div> <!-- Error message container -->
                    </div>

                    <!-- Password Input Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <!-- Error message will be injected here -->
                        <div class="error" id="password-error"></div> <!-- Error message container -->
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between mb-4">
                        <input type="submit" value="Log In" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                    </div>

                    <!-- Links for password recovery and account creation -->
                    <p class="text-center text-sm text-footer">
                        <a href="#" id="" class="text-footer hover:text-footer">You don't have an account?</a> |
                        <a href="register.php" id="customer_register_link" class="text-footer hover:text-footer">Create an account here.</a>
                    </p>
                </form>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-footer text-white py-8 mt-auto">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <p>&copy; 2023 FOOS. All rights reserved.</p> <!-- Footer copyright text -->
                <div class="flex space-x-4">
                    <!-- Social Media Links -->
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
    </div>
    <script>
        // Function to get query parameters from URL
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Check if the "register" parameter exists and equals "success"
        const registerStatus = getQueryParam('register');
        if (registerStatus === 'success') {
            // Display SweetAlert notification
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: 'You have successfully registered. You can now log in.',
                confirmButtonText: 'OK'
            });
        }

        const url = new URL(window.location.href);
        url.searchParams.delete('register');
        window.history.replaceState({}, document.title, url.toString());
    </script>

    <!-- Link to login.js for any JavaScript functionality -->
    <script src="../js/login.js"></script>
</body>
</html>
