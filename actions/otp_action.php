<?php
// Include the OTP controller for generating and validating OTP
require('../controllers/otp_controller.php');
session_start();



// Check if the user is logged in (user_id should be set in the session)
if (!isset($_SESSION['user_id'])) {
    // If session is not valid or expired, redirect to login page with an error message
    $error = "Your Session has is invalid or expired.";
    header("Location: ../view/login.php?error=" . urlencode($error));
    exit();
}

// Check if the request is to regenerate OTP (AJAX request triggered for generating a new OTP)
if (isset($_POST['action']) && $_POST['action'] == 'regenerate_otp') {
    
    // Call the function to regenerate and send OTP to the user's email
    if (sendOTPController($_SESSION['email'])) {
        // If OTP is successfully generated and sent, return success response in JSON format
        echo json_encode(['status' => 'success', 'message' => 'A New OTP has been sent to your email.']);
    } else {
        // If there was an issue generating the OTP, return error response
        echo json_encode(['status' => 'error', 'message' => 'There was an issue generating the OTP.']);
    }
    exit();
}

// Check if the form is submitted for OTP validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve OTP entered by the user and their user ID from the session
    $userOtpInput = $_POST['otp'];
    $user_id = $_SESSION['user_id'];
    
    // Validate the OTP using the OTP controller function
    if (validateOTPController($user_id, $userOtpInput)) {
        // If OTP is valid, redirect based on user role (admin or regular user)
        if ($user_id == 2) {
            // If user is admin, set session and redirect to admin page
            $_SESSION['admin'] = true;
            header("Location: ../view/admin.php");
            exit();
        } else {
            // If regular user, set session and redirect to home page
            $_SESSION['admin'] = false;
            header("Location: ../user_view/home.php");
            exit();
        }
    } else {
        // If OTP validation fails, redirect back to OTP page with an error message
        $error = "OTP invalid or expired. Generate a new otp with the button.";
        header("Location: ../user_view/otp.php?error=" . urlencode($error));
        exit();
    }
}
?>
