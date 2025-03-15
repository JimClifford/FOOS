<?php
// Include the cart controller to handle the cart functionality
require('../controllers/cart_controller.php');

// Start the session to track user data
session_start();

// Check if the request method is POST to process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product ID, IP address, and user ID from the form and session
    $p_id = $_POST['p_id'];  // Product ID
    $ip_addr = $_POST['ip_addr'];  // User's IP address
    $c_id = $_SESSION['user_id'];  // User ID from session
    $qty = 1;  // Default quantity set to 1

    // Call function to add the product to the cart
    $newCart = addToCartController($p_id, $ip_addr, $c_id, $qty);

    // Check if the product was successfully added to the cart
    if ($newCart !== false) {
        // If successful, redirect to the home page
        header("Location: ../user_view/home.php?cart_add=success");
        exit();
    } else {
        // If adding to cart fails, set an error message and redirect to home page
        
        header("Location: ../user_view/home.php?cart_add=failed");
    }
}
?>
