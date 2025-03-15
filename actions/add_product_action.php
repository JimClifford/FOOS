<?php
// Include the product controller to handle product-related operations
include ('../controllers/product_controller.php');
// Include the image function to handle image uploads
require_once('../functions/image_function.php');



// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product details from the form input
    $cat = $_POST['category'];  // Product category
    $title = $_POST['title'];  // Product title
    $price = $_POST['price'];  // Product price
    $description = $_POST['description'];  // Product description
    $keywords = $_POST['keywords'];  // Product keywords
    $stock = $_POST['stock'];  // Product stock quantity

    // Call function to handle image upload and get the image path
    $imagePath = uploadImage($_FILES["image"]);

    // Check if the image upload was successful
    if ($imagePath !== false) {
        // Attempt to add the product to the database with the provided details
        $newPro = addProductController($cat, $title, $price, $description, $keywords, $imagePath, $stock);

        // Check if the product was successfully added
        if ($newPro !== false) {
            // Redirect to the product page with a success message
            header("Location:../view/product.php?msg=product_uploaded");
            exit();
        } else {
            // Redirect to the product page with a failure message
            header("Location:../view/product.php?msg=product_upload_failed");
            exit();
        }
    } else {
        // If image upload fails, redirect with an error message
        header("Location:../view/product.php?msg=image_upload_failed");
        exit();
    }
}
?>
