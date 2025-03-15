<?php
// Include the Product class for managing product-related actions
require_once("../classes/product.php");

// Controller function to add a new product to the database
function addProductController($cat, $title, $price, $description, $keywords, $imagePath, $stock) {
    // Create a new instance of the Product class
    $newp =  new Product();

    // Call the addProduct method and return the result
    return $newp->addProduct($cat, $title, $price, $description, $keywords, $imagePath, $stock);
}

// Controller function to delete a product based on its brand name
function deleteProductController($brandName) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the deleteProduct method and return the result
    return $newp->deleteProduct($brandName);
}

// Controller function to search for products based on search terms
function searchProductController($searchTerms) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the searchProducts method and return the results
    return $newp->searchProducts($searchTerms);
}

// Controller function to retrieve all products
function getAllProductsController() {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getAllProducts method and return the results
    return $newp->getAllProducts();
}

// Controller function to get the product title based on its ID
function getProductTitleController($id) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getProductTitle method and return the result
    return $newp->getProductTitle($id);
}

// Controller function to get the product price based on its ID
function getProductPriceController($id) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getProductPrice method and return the result
    return $newp->getProductPrice($id);
}

// Controller function to get the total count of products in the database
function getTotalProductsCountController() {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getTotalProductsCount method and return the result
    return $newp->getTotalProductsCount();
}

// Controller function to get all products that are low on stock
function getLowStockProductsController() {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getLowStockProducts method and return the results
    return $newp->getLowStockProducts();
}

// Controller function to update the stock of a specific product
function updateProductStockController($pid, $stock) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the updateProductStock method and return the result
    return $newp->updateProductStock($pid, $stock);
}

// Controller function to retrieve product details based on its ID
function getProductByIdController($id) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getProductById method and return the result
    return $newp->getProductById($id);
}

// Controller function to retrieve the product image based on its ID
function getProductImageController($id) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the getProductImage method and return the result
    return $newp->getProductImage($id);
}

// Controller function to filter products based on their category
function filterProductsController($categ) {
    // Create a new instance of the Product class
    $newp = new Product();

    // Call the filterProducts method and return the result
    return $newp->filterProducts($categ);

  
    $products = [];

    if ($newP->num_rows > 0) {
        while ($row = $newP->fetch_assoc()) {
            $products[] = [
                'product_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'price' => $row['price'],
                'img' => $row['img'],
            ];
        }
    }

    return $products;
    
}
?>
