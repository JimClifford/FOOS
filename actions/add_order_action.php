<?php
// Include necessary files for order handling, cart operations, and utility functions
require('../controllers/order_controller.php');
require('../controllers/cart_controller.php');
require('../functions/cart_functions.php'); 
require('../functions/sendInvoiceDetails.php');

// Start the session to manage user data
session_start();


// Retrieve all items from the user's cart and calculate the grand total
$cartItems = getCartItemsByCustomerIdViewC($_SESSION['user_id']);
$grandTotal = calculateGrandTotal($_SESSION['user_id']);


// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Gather the necessary data to process the order
    $customer_id = $_SESSION['user_id'];  // Get the user ID from session
    $invoice = rand(100000, 999999);  // Generate a random invoice number
    $order_date = date('Y-m-d');  // Set the current date as the order date
    $status = 'paid';  // Order status is set to 'paid' upon submission
    $order_amount = $grandTotal;  // Set the order amount as the calculated grand total

    // Attempt to add the order to the database
    $addorder = addOrder($customer_id, $invoice, $order_date, $status, $order_amount);

    // Check if the order was successfully added
    if ($addorder !== false) {
        // Loop through the cart items and add each item to the order details
        foreach($cartItems as $product){
            $product_id = $product['p_id'];  // Get the product ID
            $quantity = $product['qty'];  // Get the product quantity
            // Add order details for each item in the cart
            $orderDetails = addOrderDetails($addorder, $product_id, $quantity);
            
            // If adding order details fails, show an error and exit
            if (!$orderDetails){
                echo "Error adding order details";
                exit;
            }

            
        }

        // Send invoice details to the customer's email
        sendEmailToUser($_SESSION['email'], $_SESSION['user_id']);
        // Clear the cart once the order details are added
        clearCartController($customer_id);
        // Redirect to the order success page after successful order creation
        header('Location: ../user_view/order_success.php?order_id='.$addorder);


    } else {
        // If order creation fails, show an error message
        echo "There was an error adding the order";
    }
}
?>
