<?php
// Include the product controller to handle product-related actions
require('../controllers/product_controller.php');


// Check if the request method is POST, indicating that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product ID and stock quantity from the POST data
    $product_id = $_POST['product_id'];
    $stock = $_POST['stock'];

    // Attempt to update the product stock using the controller function
    if (updateProductStockController($product_id, $stock)) {
        // If the stock update is successful, redirect to the edit product page with a success parameter
        header('Location: ../view/edit_product.php?success=true');
    } else {
        // If the stock update fails, display an alert and go back to the previous page
        echo "<script>alert('Failed to update stock. Please try again.'); window.history.back();</script>";
    }
}
?>
