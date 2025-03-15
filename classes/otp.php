<?php
require_once('../settings/db_class.php');


class OTP {
    
    private $expiryTime = 120;  // OTP expiry time in seconds (2 minutes)
    // Property to hold the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new db_connection();
    }


    // Generate a random OTP
    public function generateOTP($email) {
        // Generate a random 6-digit number
        $otp = rand(100000, 999999);
        
        // Get the current timestamp and calculate OTP expiry time (2 minutes later)
        $currentTime = date('Y-m-d H:i:s'); // Current timestamp in 'Y-m-d H:i:s' format
        $expiryTime = date('Y-m-d H:i:s', strtotime($currentTime) + $this->expiryTime); // Expiry is 2 minutes after current time

        // Update the database with the generated OTP, current timestamp, and expiry time
        $sql = "UPDATE user 
                SET auth_pin = '$otp', last_update = '$currentTime', otp_expiry = '$expiryTime' 
                WHERE email = '$email'";

        // Execute the update query
        if ($this->db->db_query($sql)) {
            return $otp; // Return the generated OTP if the update is successful
        } else {
            return false; // Return false if the update fails
        }
    }

    

    // Validate if the OTP is still valid
    public function validateOTP($userId, $enteredOTP) {
        // Fetch the OTP details for the user
        $sql = "SELECT last_update, auth_pin, otp_expiry FROM user WHERE user_id = '$userId'";
        $result = $this->db->db_fetch_one($sql);
        
        $currentTime = time(); // Get the current Unix timestamp
        $timeDifference = $currentTime - strtotime($result['last_update']);
        // Check if the OTP matches
        if ($result['auth_pin'] == $enteredOTP) {
            // Check if OTP has expired
            if ($timeDifference <= 120) {
                
                
                // OTP is valid, mark it as used
                $updateSql = "UPDATE user SET auth_pin = NULL, otp_expiry = NULL WHERE user_id = '$userId'";
                $this->db->db_query($updateSql);
                return "valid";  // OTP is valid
            } 
            else {
                // OTP is expired
                return "expired";
            }
        }
        
        else {
            // OTP is wrong
                return "invalid"; // OTP is expired or invalid
            };
        }
        
    
    }


    
?>
