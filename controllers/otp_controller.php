<?php
// Include the OTP class for OTP-related functionality
require('../classes/otp.php');
// Include the Composer autoload file for automatic class loading
require ('../vendor/autoload.php'); // This automatically includes all the required files

// Import PHPMailer classes into the global namespace for email functionality
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Controller function to validate OTP (One-Time Password) entered by the user
function validateOTPController($userId, $otp) {
    // Create an instance of the OTP class
    $newOtp = new OTP();
    
    // Call validateOTP function to check OTP validity against the user ID and OTP
    $command = $newOtp->validateOTP($userId, $otp);
    
    // Check if the OTP is valid and return true, otherwise return false
    if ($command == "valid") {
        return true;
    } else {
        return false;
    } 
}

// Controller function to send OTP to the user’s email
function sendOTPController($email) {
    // Create an instance of the OTP class for generating the OTP
    $mail = new PHPMailer(true); // Create a PHPMailer instance
    $ot = new Otp(); // Create an OTP class instance
    $otp = $ot->generateOTP($email); // Generate OTP based on the user's email

    // Check if OTP is generated successfully
    if ($otp != false) {
        try {
            // SMTP server configuration for sending email
            $mail->isSMTP();                                 // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                  // Set the SMTP server to Gmail
            $mail->SMTPAuth = true;                          // Enable SMTP authentication
            $mail->Username = 'jim200118@gmail.com';         // SMTP username
            $mail->Password = 'wdmq chpf hahi dthf';         // SMTP password (use environment variables for security)
            $mail->SMTPSecure = 'tls';                       // Enable TLS encryption
            $mail->Port = 587;                               // Set the SMTP port to 587
            
            // Sender and recipient settings
            $mail->setFrom('jim200118@gmail.com', ' FOOS'); // Set the sender's email
            $mail->addAddress($email);                               // Add the recipient's email
        
            // Set the subject and body content of the email
            $mail->Subject = 'Welcome to FOOS';        // Email subject
            $mail->Body    = "Hello,\n\nYour 6-digit verification code for Multi-Factor Authentication is: " . $otp . "\n\n This Code is only valid for 2 minutes. \n\n\nRegards,\n FOOS - Home of Sustainable Fashion "; // Email body
        
            // Send the email
            $mail->send();  // Attempt to send the email
            
            // Return true if the email was sent successfully
            return true;

        } catch (Exception $e) {
            // Catch any errors that occur during email sending and return false
            return false;
        }
    }

    // Return false if OTP generation failed
    return false;
}
?>
