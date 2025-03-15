<?php

// Include the cart controller to handle cart-related operations
require_once('../controllers/cart_controller.php');

// Set the content type to JSON for the response
header('Content-Type: application/json'); 



// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Sanitize the product and customer IDs from the GET request
    $p_id = htmlspecialchars($_GET['p_id']);  // Product ID
    $c_id = htmlspecialchars($_GET['c_id']);  // Customer ID
    
    // Check if there is a quantity parameter for updating the cart
    if (isset($_GET['qty'])) {
        // Get and sanitize the quantity from the GET request
        $qty = htmlspecialchars($_GET['qty']);

        // Call the function to update the cart with the new quantity
        if (updateCartController($p_id, $c_id, $qty) == true) { // Ensure function returns a boolean
            // Return a success message if the cart update is successful
            echo json_encode(['message' => 'Cart updated successfully.']);
        } else {
            // Return an error message if the cart update fails
            echo json_encode(['message' => 'Failed to update item.']);
        }
    } else {
        // If no quantity is provided, attempt to delete the item from the cart
        if (deleteFromCartController($p_id, $c_id) == true) { // Ensure function returns a boolean
            // Return a success message if the item is deleted successfully
            echo json_encode(['message' => 'Item deleted successfully.']);
        } else {
            // Return an error message if the item deletion fails
            echo json_encode(['message' => 'Failed to delete item.']);
        }
    }
} else {
    // Return an error message if the request method is not GET
    echo json_encode(['message' => 'Invalid request.']);
}

?>
