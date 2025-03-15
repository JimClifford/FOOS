<?php

// Include the necessary controller for handling order-related operations
require_once('../controllers/order_controller.php');

// Set the response header to JSON, indicating the output will be in JSON format
header('Content-Type: application/json'); 


// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve the order ID and status from the GET request and sanitize the input
    $order_id = htmlspecialchars($_GET['order_id']);
    $status = htmlspecialchars($_GET['status']);

    // Check if both order ID and status are provided in the request
    if (isset($order_id) && isset($status)) {
        // Call the function to update the order status in the database
        if (updateOrderStatusController($order_id, $status) == true) { 
            // If the update is successful, return a success message in JSON format
            echo json_encode(['message' => 'Order status updated successfully.']);
        } else {
            // If the update fails, return a failure message in JSON format
            echo json_encode(['message' => 'Failed to update order status.']);
        }
    } else {
        // If required data is missing, return an error message indicating invalid input
        echo json_encode(['message' => 'Invalid input data.']);
    }
} else {
    // If the request method is not GET, return an error message indicating invalid method
    echo json_encode(['message' => 'Invalid request method.']);
}

?>
