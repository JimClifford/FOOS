<?php
// Include the product controller to handle product-related operations
require('../controllers/product_controller.php'); 

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the category from the POST data
    $category = $_POST['category'];

    // Initialize $cat to a default value (3: for unspecified category)
    $cat = 3;

    // Check the selected category and set $cat accordingly
    if ($category == 'male') {
        $cat = 1;  // Category 1 for male products
    }
    else if ($category == 'female') {
        $cat = 2;  // Category 2 for female products
    }

    // Call the controller to fetch products filtered by the selected category
    $products = filterProductsController($cat);

    // Return the filtered products as a JSON response
    echo json_encode($products);
}
?>
