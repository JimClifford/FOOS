<?php
require('../functions/header.php');  // Include header for the page
session_start();  // Start the session to check if the user is logged in

// Check if the user is logged in (session variable is set)
if (!isset($_SESSION['user_id'])) {
    // If the session is not set, redirect to the login page
    header("Location: ../view/login.php");
    exit();  // Make sure no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Link to Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Link to Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1;  /* Makes the footer stay at the bottom of the page */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .bg-footer {
            background-color: #2d3748; /* Footer background color */
        }
        .hover\:bg-footer:hover {
            background-color: #4a5568; /* Footer hover effect */
        }
        .hover-button {
            animation: pulse 1.5s infinite;  /* Animates the button for a subtle hover effect */
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1); /* Normal size */
            }
            50% {
                transform: scale(1.05); /* Slight zoom effect */
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <?php echo generateHeaderForNotHome();  // Display header without home navigation ?>

        <!-- Main Content Section -->
        <main class="container mx-auto px-4 mt-6">
            <div class="flex items-center justify-center mb-4">
                <h1 class="text-2xl font-bold text-center">Order Successful</h1>  <!-- Heading for the success message -->
            </div>
            
            <section class="bg-white shadow-md rounded-lg p-6 text-center">
                <div class="mb-4">
                    <img src="../images/check.png" alt="Success" class="w-20 mx-auto">  <!-- Success icon -->
                </div>
                <h2 class="text-xl font-bold text-green-600">Your Order Has Been Successfully Placed! Check Your email for detials on your order</h2> <!-- Confirmation message -->
                <p class="text-gray-700 mt-2">Thank you for shopping with us. Your order will be processed shortly.</p>  <!-- Order confirmation -->

                <!-- Button to continue shopping -->
                <div class="mt-6">
                    <a href="home.php" class="hover-button bg-footer hover:bg-footer text-white font-bold py-2 px-6 rounded-lg">
                        Continue Shopping  <!-- Button text -->
                    </a>
                </div>
            </section>
        </main>

        <!-- Footer Section -->
        <footer class="bg-footer text-white py-8">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <p>&copy;2024 FOOS. All rights reserved.</p>  <!-- Copyright message -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>  <!-- Facebook icon -->
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>  <!-- Twitter icon -->
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>  <!-- Instagram icon -->
                </div>
            </div>
        </footer>
    </div>
</body>


<!-- jQuery inclusion for any potential future AJAX calls or other dynamic content needs -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</html>
