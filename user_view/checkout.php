<?php 
// Including necessary PHP files for header, cart functions, and user controller
require('../functions/header.php'); 
require_once('../functions/cart_functions.php');
require_once('../controllers/user_controller.php');

// Starting the session to check for logged-in user
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit(); // Ensure no further code is executed after redirection
}

// Fetching user details and grand total for checkout from session data
$userDets = getUserDetailsForCheckoutController($_SESSION['user_id']);
$grandTotal = calculateGrandTotal($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Including Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Including Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Basic styles for body and page layout */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f7fafc;
        }

        .main-content {
            flex-grow: 1;
            margin-top: 1.5rem;
        }

        /* Footer styles */
        .bg-footer {
            background-color: #2d3748;
        }

        /* Hover effect for footer links */
        .hover\:bg-footer:hover {
            background-color: #4a5568;
        }

        footer {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Button styles for the Pay button */
        .btn-primary {
            background-color: #2d3748;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for Pay button */
        .btn-primary:hover {
            background-color: #4a5568;
        }
    </style>
</head>
<body>
    <!-- Header section, dynamically generated -->
    <?php echo generateHeaderForNotHome(); ?>

    <!-- Main Content Section -->
    <main class="main-content container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>
        <section class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Checkout Information</h2>

            <!-- Checkout form -->
            <form id="paymentForm" action="../actions/add_order_action.php" method="POST">
                <!-- Full Name Input Field -->
                <div class="mb-4">
                    <label for="full-name" class="block text-gray-700 font-bold">Full Name</label>
                    <input type="text" id="full-name" value="<?php echo $userDets['full_name']; ?>" class="w-full p-2 border rounded" />
                </div>
                
                <!-- Email Address Input Field -->
                <div class="mb-4">
                    <label for="email-address" class="block text-gray-700 font-bold">Email Address</label>
                    <input type="email" id="email-address" value="<?php echo $userDets['email']; ?>" class="w-full p-2 border rounded" required />
                </div>
                
                <!-- City Input Field -->
                <div class="mb-4">
                    <label for="city" class="block text-gray-700 font-bold">City</label>
                    <input type="text" id="city" value="<?php echo $userDets['city']; ?>" class="w-full p-2 border rounded" />
                </div>
                
                <!-- Contact Number Input Field -->
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700 font-bold">Contact Number</label>
                    <input type="text" id="contact" value="<?php echo $userDets['contact_number']; ?>" class="w-full p-2 border rounded" />
                </div>
                
                <!-- Displaying the Grand Total Amount -->
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-bold">Amount</label>
                    <input type="tel" id="amount" value="<?php echo number_format($grandTotal, 2); ?>" class="w-full p-2 border rounded" readonly />
                </div>
                
                <!-- Pay Button -->
                <div class="text-right">
                    <button type="submit" onclick="payWithPaystack()" class="btn-primary flex items-center justify-center">
                        <i class="fas fa-credit-card mr-2"></i> Pay
                    </button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-footer text-white">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p>&copy; FOOS 2024. All rights reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Paystack inline script for payment processing -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- Custom JS for handling payment -->
    <script src="../js/pay.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>
