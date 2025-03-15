<?php
// Include the category_class.php to access the Category class and its methods
include("../classes/category_class.php");

// Controller function to fetch all categories
function getAllCategorysController() {
    // Create a new Category object
    $newBrand = new Category();

    // Call the getAllCategory method of the Category class and return the result
    return $newBrand->getAllCategory();
}
?>
