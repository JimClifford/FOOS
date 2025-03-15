<?php
// Include necessary files for database connection and product functionality
require_once('../settings/db_class.php');
require_once('../classes/product.php');

class order extends Product {

    // Function to add a new order to the orders table
    public function addOrder($customer_id, $invoice, $order_date, $status, $order_amount) {
        $ndb = new db_connection();

        // Sanitize input data to prevent SQL injection
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customer_id);
        $invoice = mysqli_real_escape_string($ndb->db_conn(), $invoice);
        $order_date = mysqli_real_escape_string($ndb->db_conn(), $order_date);
        $status = mysqli_real_escape_string($ndb->db_conn(), $status);
        $order_amount = mysqli_real_escape_string($ndb->db_conn(), $order_amount);

        // SQL query to insert the new order into the orders table
        $sql = "INSERT INTO `orders` (`customer_id`, `invoice`, `order_date`, `status`, `order_amount`) 
                VALUES ('$customer_id', '$invoice', '$order_date', '$status', '$order_amount')";

        // Execute the query and check if it was successful
        if ($ndb->db_query($sql)) {
            $inserID = $ndb->get_insert_id(); // Get the ID of the newly inserted order
            return $inserID > 0 ? $inserID : false; // Return the new order ID if successful, otherwise false
        }
        return false; // If the query failed, return false
    }

    // Function to add order details (products and quantities) for a specific order
    public function addOrderDetails($order_id, $product_id, $qty) {
        $ndb = new db_connection();

        // Sanitize the input data
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $order_id);
        $product_id = mysqli_real_escape_string($ndb->db_conn(), $product_id);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $qty);

        // SQL query to insert the order details into the order_details table
        $sql = "INSERT INTO `order_details` (`order_id`, `product_id`, `qty`) 
                VALUES ('$order_id', '$product_id', '$qty')";

        return $ndb->db_query($sql); // Execute the query and return the result
    }

    // Function to get the total number of orders in the database
    public function getTotalOrdersCount() {
        $ndb = new db_connection();
        $sql = "SELECT COUNT(*) as total_orders FROM `orders`";
        return $ndb->db_fetch_one($sql); // Fetch and return the total number of orders
    }

    // Function to retrieve all orders from the database
    public function getOrders() {
        $ndb = new db_connection();
        $sql = "SELECT * FROM `orders`";
        return $ndb->db_fetch_all($sql); // Fetch and return all orders
    }

    // Function to retrieve the most recent 5 orders
    public function getRecentOrders() {
        $ndb = new db_connection();
        $sql = "SELECT * FROM `orders` ORDER BY `order_id` DESC LIMIT 5";
        return $ndb->db_fetch_all($sql); // Fetch and return the 5 most recent orders
    }

    // Function to retrieve a specific order by order_id
    public function getOrder($order_id) {
        $ndb = new db_connection();
        $sql = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'";
        return $ndb->db_fetch_one($sql); // Fetch and return the order details by order_id
    }

    // Function to update the status of an order
    public function updateOrderStatus($order_id, $status) {
        $ndb = new db_connection();

        // Sanitize the input data
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $order_id);
        $status = mysqli_real_escape_string($ndb->db_conn(), $status);

        // SQL query to update the order status
        $sql = "UPDATE `orders` SET `status` = '$status' WHERE `order_id` = '$order_id'";

        return $ndb->db_query($sql); // Execute the query and return the result
    }

    // Function to deduct stock from the product table after an order is placed
    public function deductProductStockAmount($order_id) {
        $ndb = new db_connection();
        $sql = "SELECT * FROM `order_details` WHERE `order_id` = '$order_id'";
        $orderDetails = $ndb->db_fetch_all($sql); // Fetch the order details

        // Check if order details are available
        if (is_array($orderDetails) && count($orderDetails) > 0) {
            // Loop through each product in the order details
            foreach ($orderDetails as $row) {
                $product_id = $row['product_id'];
                $qty = $row['qty'];

                // Fetch the current stock for the product
                $sql = "SELECT `stock_amount` FROM `products` WHERE `product_id` = '$product_id'";
                $productData = $ndb->db_fetch_one($sql);
                $stock = $productData['stock_amount'];

                // Update the stock amount after the order is placed
                $newStock = $stock - $qty;
                $sql = "UPDATE `products` SET `stock_amount` = '$newStock' WHERE `product_id` = '$product_id'";
                $ndb->db_query($sql); // Execute the query to update stock
            }
        }
    }

    // Function to get the total revenue from all orders
    public function getTotalOrderRevenue() {
        $ndb = new db_connection();
        $sql = "SELECT SUM(`order_amount`) as total_revenue FROM `orders`";
        return $ndb->db_fetch_one($sql); // Fetch and return the total revenue
    }

    public function getRevenueForPast7Days() {
        $ndb = new db_connection();
        $sql = "SELECT DATE(order_date) AS order_day, SUM(order_amount) AS daily_revenue
                FROM orders
                WHERE order_date >= CURDATE() - INTERVAL 7 DAY
                GROUP BY DATE(order_date)
                ORDER BY order_day DESC"; // Orders by most recent day
        
        return $ndb->db_fetch_all($sql); // Fetch and return revenue per day for the past 7 days
    }
    
}
?>
