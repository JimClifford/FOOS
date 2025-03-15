<?php
// Connect to database class
require_once("../settings/db_class.php");

class Product 
{
    // Add a new product to the database
    public function addProduct($cat, $title, $price, $description, $keywords, $imagePath, $stock)
    {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize input to prevent SQL injection
        $cat = mysqli_real_escape_string($ndb->db_conn(), $cat);
        $title = mysqli_real_escape_string($ndb->db_conn(), $title);
        $price = mysqli_real_escape_string($ndb->db_conn(), $price);
        $description = mysqli_real_escape_string($ndb->db_conn(), $description);
        $keywords = mysqli_real_escape_string($ndb->db_conn(), $keywords);
        $stock = mysqli_real_escape_string($ndb->db_conn(), $stock);
        $imagePath = mysqli_real_escape_string($ndb->db_conn(), $imagePath);

        // Prepare SQL query to insert the product into the database
        $sql = "INSERT INTO `products` ( `category`, `title`, `price`, `description`, `keywords`, `img`, `stock_amount`) 
                VALUES ('$cat', '$title', '$price', '$description', '$keywords', '$imagePath', '$stock')";

        // Execute the query and return the result
        return $ndb->db_query($sql);    
    }

    // Delete a product from the database
    public function deleteProduct($id) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize input (product ID) to prevent SQL injection
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $id);
        
        // SQL query to delete the product
        $sql = "DELETE FROM `products` WHERE `product_id` = '$p_id'";

        // Execute the query and return the result
        return $ndb->db_query($sql);
    }

    // Get all products from the database
    public function getAllProducts() {
        // Initialize database connection
        $ndb = new db_connection();

        // SQL query to retrieve all products and randomise the output.
        $sql = "SELECT * FROM `products` ORDER BY RAND()";

        // Execute the query and return the result
        return $ndb->db_fetch_all($sql);
    }

    // Get the title of a product by its ID
    public function getProductTitle($id) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize input (product ID)
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $id);
        
        // SQL query to retrieve the product title
        $sql = "SELECT `title` FROM `products` WHERE `product_id` = '$p_id'";

        // Execute the query and return the result
        return $ndb->db_fetch_one($sql);
    }

    // Search for products based on search term
    public function SearchProducts($searchTerm){
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize search term to prevent SQL injection
        $searchTerm = mysqli_real_escape_string($ndb->db_conn(), $searchTerm);

        // SQL query to search products by title or keywords
        $sql = "SELECT * FROM `products` WHERE `title` LIKE '%$searchTerm%' OR `keywords` LIKE '%$searchTerm%'";

        // Execute the query and return the result
        return $ndb->db_fetch_all($sql);
    }

    // Get the price of a product by its ID
    public function getProductPrice($id) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize input (product ID)
        $p_id = mysqli_real_escape_string($ndb->db_conn(), $id);
        
        // SQL query to retrieve the product price
        $sql = "SELECT `price` FROM `products` WHERE `product_id` = '$p_id'";

        // Execute the query and return the result
        return $ndb->db_fetch_one($sql);
    }

    // Get the total count of products in the database
    public function getTotalProductsCount() {
        // Initialize database connection
        $ndb = new db_connection();

        // SQL query to count total products
        $sql = "SELECT COUNT(*) AS `count` FROM `products`";

        // Execute the query and return the result
        return $ndb->db_fetch_one($sql);
    }

    // Get products with low stock (less than 10 units)
    public function getLowStockProducts() {
        // Initialize database connection
        $ndb = new db_connection();
    
        // SQL query to find low stock products
        $sql = "SELECT * FROM `products` WHERE `stock_amount` < 10 ORDER BY `stock_amount` ASC";
    
        // Execute the query and return the result
        return $ndb->db_fetch_all($sql);
    }

    // Update the stock amount for a specific product
    public function updateProductStock($product_id, $stock) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize inputs (product ID and stock value)
        $product_id = mysqli_real_escape_string($ndb->db_conn(), $product_id);
        $stock = mysqli_real_escape_string($ndb->db_conn(), $stock);

        // SQL query to update stock amount for the product
        $sql = "UPDATE `products` SET `stock_amount` = '$stock' WHERE `product_id` = '$product_id'";

        // Execute the query and return the result
        return $ndb->db_query($sql);
    }

    // Filter products by category
    public function filterProducts($category) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize category input
        $category = mysqli_real_escape_string($ndb->db_conn(), $category);

        // Check if category is 3 (all categories)
        if ($category == 3) {
            $sql = "SELECT * FROM `products` ORDER BY RAND()";  // Retrieve all products and randomise
        } else {
            $sql = "SELECT * FROM `products` WHERE `category` = '$category' ORDER BY RAND()";  // Retrieve products by specific category and randomise the output
        }

        // Execute the query and return the result
        return $ndb->db_fetch_all($sql);
    }

    // Search low-stock products by a search term
    public function searchLowStockProducts($searchTerm) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize search term to prevent SQL injection
        $searchTerm = mysqli_real_escape_string($ndb->db_conn(), $searchTerm);

        // SQL query to search low-stock products
        $sql = "SELECT * FROM `products` WHERE (`stock_amount` < 10 OR `stock_amount` IS NULL) 
                AND (`title` LIKE '%$searchTerm%' OR `keywords` LIKE '%$searchTerm%')";

        // Execute the query and return the result
        return $ndb->db_fetch_all($sql);
    }

    // Get a product's details by its ID
    public function getProductById($id) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize product ID
        $id = mysqli_real_escape_string($ndb->db_conn(), $id);

        // SQL query to retrieve product by ID
        $sql = "SELECT * FROM `products` WHERE `product_id` = '$id'";

        // Execute the query and return the result
        return $ndb->db_fetch_one($sql);
    }

    // Get the image path of a product by its ID
    public function getProductImage($id) {
        // Initialize database connection
        $ndb = new db_connection();

        // Sanitize product ID
        $id = mysqli_real_escape_string($ndb->db_conn(), $id);

        // SQL query to retrieve product image path
        $sql = "SELECT `img` FROM `products` WHERE `product_id` = '$id'";

        // Execute the query and return the result
        return $ndb->db_fetch_one($sql);
    }
}
?>
