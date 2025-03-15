<?php
// Include the product controller to fetch product data
require('../controllers/product_controller.php');

// Define a function to display all products
function displayAllProducts() {
    // Assuming $products is the array containing the product data
    // Fetch all products from the database via the controller
    $products = getAllProductsController(); // Replace with actual database fetch logic

    // Loop through each product and display its details
    foreach ($products as $product) {
        // Output the product information in HTML structure
        echo '
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="' . $product['img'] . '" alt="' . $product['title'] . '" class="w-full h-64 object-cover">  <!-- Product image -->
                <div class="p-4">
                    <h4 class="text-lg font-semibold text-gray-800">' . $product['title'] . '</h4>  <!-- Product title -->
                    <p class="text-gray-600 mt-2">Price: GHS' . $product['price'] . '</p>  <!-- Product price -->
                    <div class="mt-4">
                        <!-- Button to edit product stock, passing product_id to a function -->
                        <button 
                            onclick="editProduct(' . $product['product_id'] . ')" 
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200"
                        >
                            <i class="fas fa-edit mr-2"></i> Edit Stock  <!-- Edit icon -->
                        </button>
                    </div>
                </div>
            </div>
        ';
    }
}
?>
