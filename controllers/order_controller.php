<?php
// Include the order and user classes to access their methods
require_once("../classes/order_class.php");
require_once("../classes/user.php");

// Controller function to add a new order
function addOrder($customer_id, $invoice, $order_date, $status, $order_amount) {
   // Create an instance of the order class to interact with the order methods
   $new_order = new order();
   
   // Call the addOrder method in the order class and return the result
   return $new_order->addOrder($customer_id, $invoice, $order_date, $status, $order_amount);
}

// Controller function to add details to an existing order
function addOrderDetails($order_id, $product_id, $qty) {
   // Create an instance of the order class to interact with the order methods
   $new_order = new order();
   
   // Call the addOrderDetails method to add products to an order and return the result
   return $new_order->addOrderDetails($order_id, $product_id, $qty);
}

// Controller function to get the total count of orders
function getTotalOrdersCount() {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the getTotalOrdersCount method and return the result
   return $new_order->getTotalOrdersCount();
}

// Controller function to fetch recent orders
function getRecentOrders() {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the getRecentOrders method and return the result
   return $new_order->getRecentOrders();
}

// Controller function to get the customer's name based on order ID
function getOrderCustomerName($id) {
   // Create an instance of the user class to get user details
   $new_order = new user();
   
   // Call the getUserNameById method to get the customer's name based on their user ID
   $n = $new_order->getUserNameById($id);

   // Return the customer's full name
   return $n['full_name'];
}

// Controller function to get all orders
function getAllOrders() {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the getOrders method and return the result
   return $new_order->getOrders();
}

// Controller function to update the status of an order
function updateOrderStatusController($order_id, $status) {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the updateOrderStatus method to change the order status and return the result
   return $new_order->updateOrderStatus($order_id, $status);
}

// Controller function to get the total revenue from orders
function getTotalOrderRevenueController() {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the getTotalOrderRevenue method and return the result
   return $new_order->getTotalOrderRevenue();
}

function getRevenueForPast7DaysController() {
   // Create an instance of the order class
   $new_order = new order();
   
   // Call the getRevenueForPast7Days method and return the result
   return $new_order->getRevenueForPast7Days();
}

?>
 