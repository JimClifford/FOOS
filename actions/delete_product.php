<?php
// Set the content type to JSON for the response
header('Content-Type: application/json'); 
// Include the product controller to handle product-related operations
require('../controllers/product_controller.php');
// Start output buffering to capture any unexpected output
ob_start();

// Your existing code here

// Add this at the end of the script to check for unexpected output
$output = ob_get_clean();  // Get the content of the output buffer
// If unexpected output is detected, return it as an error message in JSON format
if (trim($output) !== '') {
    echo json_encode(['error' => 'Unexpected output detected: ' . $output]);
    exit;
}

// Check if a product ID is provided in the URL query string
if (isset($_GET['id'])) {
    // Validate the provided ID to ensure it's an integer
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    // Attempt to delete the product with the provided ID
    if (deleteProductController($id) == true) {
        // Return a success message if the product was deleted successfully
        echo json_encode(['message' => 'Product deleted successfully.']);
    } else {
        // Return an error message if the product deletion failed
        echo json_encode(['message' => 'Failed to delete Product.']);
    }
} else {
    // Return an error message if no product ID is provided
    echo json_encode(['message' => 'No Product ID provided.']);
}
?>
