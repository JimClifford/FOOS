<?php
// Include the product controller for handling product-related operations
require('../controllers/product_controller.php');


// Check if the request method is POST (indicating a search query submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the search query from the POST data, defaulting to an empty string if not set
    $query = $_POST['query'] ?? '';

    // Fetch products based on the search query using the controller function
    $products = searchProductController($query);

    // Return the fetched products as a JSON response
    echo json_encode($products);
}
?>
