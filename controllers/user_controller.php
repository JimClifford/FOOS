<?php
// Include the User class for managing user-related actions
require_once("../classes/user.php");

// Controller function to fetch user details for checkout by user ID
function getUserDetailsForCheckoutController($id) {
    // Create a new instance of the User class
    $new_user = new User();

    // Call the getUserDetailsForCheckout method and return the result
    return $new_user->getUserDetailsForCheckout($id);
}

// Controller function to get the user ID based on email
function getUserIdByEmailController($email) {
    // Create a new instance of the User class
    $new_user = new User();

    // Call the getUserIdByEmail method and return the result
    return $new_user->getUserIdByEmail($email);
}
?>
