<?php
// Include the User class for managing user-related actions
require('../classes/user.php');

// Controller function to register a new user
function registerController($name, $email, $password, $country, $city, $contactNumber) {
    // Create a new instance of the User class
    $newUser = new User();

    // Call the addUser method from the User class and return the result
    return $newUser->addUser($name, $email, $password, $country, $city, $contactNumber);
}
?>
