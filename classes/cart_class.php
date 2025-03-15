<?php

// Include the database connection class
require_once("../settings/db_class.php");

// Cart class extends db_connection to handle cart operations
class cart extends db_connection {

    // Function to add a product to the cart
    public function addToCart($p_id, $ip_addr, $c_id, $qty) {
        // Establish a new DB connection
        $ndb = new db_connection();
   
        // Sanitize inputs to prevent SQL injection
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $p_id);
        $ip_addr = mysqli_real_escape_string($ndb->db_conn(), $ip_addr);
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $qty);

        // Check if the product is already in the cart
        $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND c_id = '$c_id'";
        $result = $this->db_fetch_one($sql);

        if ($result) {
            // If product exists, update quantity
            $newQty = $result['qty'] + $qty;
            $sql = "UPDATE cart SET qty = $newQty WHERE p_id = '$p_id' AND c_id = '$c_id'";
            return $this->db_query($sql);
        } else {
            // If product does not exist, insert into the cart
            $sql = "INSERT INTO cart (p_id, ip_addr, c_id, qty) VALUES ('$p_id', '$ip_addr', '$c_id', '$qty')";
            return $this->db_query($sql);
        }
    }

    // Function to delete a product from the cart
    function deleteFromCart($p_id, $c_id) {
        // Establish a new DB connection
        $ndb = new db_connection();
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $p_id);
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);

        // SQL query to delete the product from the cart
        $sql = "DELETE FROM cart WHERE p_id = '$p_id' AND c_id = '$c_id'";
        return $this->db_query($sql);
    }

    // Function to retrieve all items in the cart
    public function getCartItems($c_id) {
        $ndb = new db_connection();

        // Sanitize the customer ID
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);
        
        // SQL query to get cart items for a specific customer
        $sql = "SELECT * FROM cart WHERE c_id = '$c_id'";

        // Return all cart items for the customer
        return $this->db_fetch_all($sql);
    }

    // Function to update the quantity of a product in the cart
    public function updateCart($p_id, $c_id, $qty) {
        $ndb = new db_connection();
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $p_id);
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $qty);

        // SQL query to update the quantity of the product in the cart
        $sql = "UPDATE cart SET qty = '$qty' WHERE p_id = '$p_id' AND c_id = '$c_id'";
        return $this->db_query($sql);
    }

    // Function to calculate the total price of the cart
    public function getCartTotal($c_id) {
        $ndb = new db_connection();
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);

        // SQL query to calculate the total price for the cart
        $sql = "SELECT SUM(p.price * c.qty) as total FROM products p, cart c WHERE p.product_id = c.p_id AND c.c_id = '$c_id'";
        
        // Return the calculated total
        $result = $this->db_fetch_one($sql);
        return $result['total'];
    }

    // Function to count the number of items in the cart
    public function getCartCount($c_id) {
        $ndb = new db_connection();
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);

        // SQL query to count the number of items in the cart
        $sql = "SELECT COUNT(*) as count FROM cart WHERE c_id = '$c_id'";
        
        // Return the count of items in the cart
        $result = $this->db_fetch_one($sql);
        return $result['count'];
    }

    // Function to clear all items in the cart
    public function clearCart($c_id) {
        $ndb = new db_connection();
        $c_id = mysqli_real_escape_string($ndb->db_conn(), $c_id);

        // SQL query to delete all items in the cart
        $sql = "DELETE FROM cart WHERE c_id = '$c_id'";
        return $this->db_query($sql);
    }
}
?>
