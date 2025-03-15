<?php
// Include the registration controller to handle user registration logic
require('../controllers/register_controller.php');

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data submitted by the user
    $name = $_POST['fullName'];  // User's full name
    $email = $_POST['email'];  // User's email address
    $password = $_POST['password'];  // User's chosen password
    $country = $_POST['country'];  // User's country of residence
    $city = $_POST['city'];  // User's city
    $contactNumber = $_POST['contactNumber'];  // User's contact number

    try {
        // Call the register controller function to attempt user registration
        $newUser = registerController($name, $email, $password, $country, $city, $contactNumber);

        // Check if the registration was successful
        if ($newUser !== false) {
            // Redirect to the login page upon successful registration
            header("Location: ../view/login.php?register=success");
            exit();
        } else {
            // If registration fails for any other reason
            
            header("Location: ../view/register.php?register=failed");
            exit();
        }
    } catch (Exception $e) {
        // Catch any exceptions (e.g., duplicate email error)
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            header("Location: ../view/register.php?register=email_duplicate");
            exit();
        } 
        
    }
}
?>
