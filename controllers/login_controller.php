<?php
// Include the User class to access its methods for user-related functionality
require('../classes/user.php');

// Controller function to validate user login
function loginController($email, $password) {
    // Create an instance of the User class to interact with user-related methods
    $newUser = new User();

    // Call the validateUser method to check the user's credentials and return the result
    return $newUser->validateUser($email, $password);
}

// Controller function to get the user ID based on their email
function getUserIdByEmailController($email) {
    // Create an instance of the User class to access the method
    $newUser = new User();

    // Call the getUserIdByEmail method and return the result
    return $newUser->getUserIdByEmail($email);
}
?>
