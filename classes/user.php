<?php
// Include the db_connection class
require_once('../settings/db_class.php');

class User {
    // Method to add a new user to the database
    public function addUser($name, $email, $password, $country, $city, $contactNumber) {
        // Create a new database connection
        $db = new db_connection();

        // Escape user inputs to prevent SQL injection
        $name = mysqli_real_escape_string($db->db_conn(), $name);
        $email = mysqli_real_escape_string($db->db_conn(), $email);
        $password = mysqli_real_escape_string($db->db_conn(), $password);
        $country = mysqli_real_escape_string($db->db_conn(), $country);
        $city = mysqli_real_escape_string($db->db_conn(), $city);
        $contactNumber = mysqli_real_escape_string($db->db_conn(), $contactNumber);

        // Encrypt the password (Note: md5 is not recommended for production; use password_hash())
        $hashed_password = md5($password);

        // SQL query to insert the new user into the database
        $sql = "INSERT INTO user (full_name, email, password, country, city, contact_number) 
                VALUES ('$name', '$email', '$hashed_password', '$country', '$city', '$contactNumber')";

        // Execute the query and return the result
        return $db->db_query_escape_string($sql);
    }

    // Method to validate a user's login credentials
    public function validateUser($email, $password) {
        // Create a new database connection
        $db = new db_connection();

        // Escape user inputs to prevent SQL injection
        $email = mysqli_real_escape_string($db->db_conn(), $email);
        $password = mysqli_real_escape_string($db->db_conn(), $password);

        // Encrypt the password (md5 is used here, but consider using password_hash() for better security)
        $hashed_password = md5($password);

        // SQL query to check if the provided email and password match any records in the user table
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";

        // Fetch and return the user data if a match is found
        return $db->db_fetch_one($sql);
    }

    // Method to retrieve the user ID by email (useful for session management)
    public function getUserIdByEmail($email) {
        // Create a new database connection
        $db = new db_connection();

        // Escape email input to prevent SQL injection
        $email = mysqli_real_escape_string($db->db_conn(), $email);
    
        // SQL query to get the user ID associated with the provided email
        $sql = "SELECT user_id FROM user WHERE email = '$email'";
    
        // Fetch and return the user ID if found
        return $db->db_fetch_one($sql);
    }

    // Method to get user details for checkout process using user ID
    public function getUserDetailsForCheckOut($id) {
        // Create a new database connection
        $db = new db_connection();

        // Escape user ID input to prevent SQL injection
        $id = mysqli_real_escape_string($db->db_conn(), $id);
    
        // SQL query to get the user's full name, email, city, and contact number for checkout
        $sql = "SELECT full_name, email, city, contact_number FROM user WHERE user_id = '$id'";
    
        // Fetch and return the user details if found
        return $db->db_fetch_one($sql);
    }

    // Method to get the full name of the user by their ID
    public function getUserNameById($id) {
        // Create a new database connection
        $db = new db_connection();

        // Escape user ID input to prevent SQL injection
        $id = mysqli_real_escape_string($db->db_conn(), $id);
    
        // SQL query to retrieve the user's full name based on the user ID
        $sql = "SELECT full_name FROM user WHERE user_id = '$id'";
    
        // Fetch and return the user's full name if found
        return $db->db_fetch_one($sql);
    }
}
?>
