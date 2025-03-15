<?php
// Include the cart_class.php to access the cart functionalities
require('../classes/cart_class.php');

// Controller function to add a product to the cart
// It takes product ID, IP address, customer ID, and quantity as parameters
function addToCartController($p_id, $ip_addr, $c_id, $qty) {
    // Create a new cart object
    $newCart = new cart();
    
    // Call the addToCart method of the cart class and return the result
    return $newCart->addToCart($p_id, $ip_addr, $c_id, $qty);
}

// Controller function to fetch all cart items for a specific customer
// It takes the customer ID as a parameter
function getCartItemsByCustomerIdController($c_id) {
    // Create a new cart object
    $newCart = new cart();
    
    // Fetch the cart items associated with the customer ID and return them
    return $newCart->getCartItems($c_id);
}

// Controller function to delete a specific product from the customer's cart
// It takes the product ID and customer ID as parameters
function deleteFromCartController($p_id, $c_id) {
    // Create a new cart object
    $newCart = new cart();
    
    // Call the deleteFromCart method and return the result
    return $newCart->deleteFromCart($p_id, $c_id);
}

// Controller function to update the quantity of a product in the cart
// It takes product ID, customer ID, and new quantity as parameters
function updateCartController($p_id, $c_id, $qty) {
    // Create a new cart object
    $newCart = new cart();
    
    // Call the updateCart method to update the quantity of the product in the cart and return the result
    return $newCart->updateCart($p_id, $c_id, $qty);
}

// Controller function to fetch the cart items for a customer (for viewing)
function getCartItemsByCustomerIdViewC($c_id) {
    // Create a new cart object
    $newCart = new cart();
    
    // Fetch and return the cart items for the customer based on the customer ID
    return $newCart->getCartItems($c_id);
}

// Controller function to clear the entire cart of a customer
// It takes the customer ID as a parameter
function clearCartController($c_id) {
    // Create a new cart object
    $newCart = new cart();
    
    // Call the clearCart method to empty the cart and return the result
    return $newCart->clearCart($c_id);
}
?>
