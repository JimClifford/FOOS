<?php

require ('../vendor/autoload.php'); // This automatically includes all the required files
require_once("../functions/cart_functions.php"); // Include the cart functions file for cart operations

// Import PHPMailer classes into the global namespace for email functionality
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmailToUser($email,$customer_id) {
    // Create an instance of the OTP class for generating the OTP
    $mail = new PHPMailer(true); // Create a PHPMailer instance
    

    
   

            // SMTP server configuration for sending email
            $mail->isSMTP();                                 
            $mail->Host = 'smtp.gmail.com';                  
            $mail->SMTPAuth = true;                          
            $mail->Username = 'jim200118@gmail.com';        
            $mail->Password = 'wdmq chpf hahi dthf';         
            $mail->SMTPSecure = 'tls';                       
            $mail->Port = 587;                               
            
            // Sender and recipient settings
            $mail->setFrom('jim200118@gmail.com', ' FOOS'); // Set the sender's email
            $mail->addAddress($email);                               // Add the recipient's email
        
            // Set the subject and body content of the email
            $mail->Subject = 'FOOS - INVOICE FOR PAID ORDER'; 
            $mail->isHTML(true);     //set to html format
            $mail->Body    = generateCartInvoiceMessage($customer_id); // Email body
        
            // Send the email
            $mail->send();  // Attempt to send the email
            
            // Return true if the email was sent successfully
            return true;

        
}

?>