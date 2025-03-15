<?php

// Include necessary controllers for login and OTP functionalities
require('../controllers/login_controller.php');
require_once('../controllers/otp_controller.php');

// Start the session to manage session variables
session_start();

// Check if the form has been submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data: email and password
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    // Create a new User object to validate the user
    $user = new User();
    // Validate the user's credentials by calling the validateUser method
    $result = $user->validateUser($email, $password);

    // Output the result for debugging (remove in production)
    var_dump($result);

    // Check if validation is successful
    if ($result) {
        
        // Attempt to send an OTP to the user's email
        if (sendOTPController($email)) {
            // If the user is an admin (user_id == 2), set admin session variables
            if ($result['user_id'] == 2) {
                // Admin session setup (commented out as per instructions)
                // $_SESSION['admin'] = true;
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['admin_name'] = $result['full_name'];
                $_SESSION['session_valid'] = true;
                $_SESSION['email'] = $email;
                // Redirect the user to OTP verification page
                header("Location: ../user_view/otp.php");
                exit();
            } else {
                // Regular user session setup
                // $_SESSION['admin'] = false; (commented out)
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['session_valid'] = true;
                $_SESSION['email'] = $email;
                // Redirect the user to OTP verification page
                header("Location: ../user_view/otp.php");
                exit();
            }
        
        } else {
            // If OTP sending fails, show an error and redirect to login page
            $error = "OTP sending failed. Please try again.";
            header("Location: ../view/login.php");
            exit();
        }
        
    } else {
        // If login validation fails, show an error and redirect to login page
        $error = "Login failed. Please try again.";
        header("Location: ../view/login.php");
        exit();
    }
}
?>
