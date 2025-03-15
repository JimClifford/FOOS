<?php
// Connect to the database using the db_connection class
require("../settings/db_class.php");


class Category extends db_connection
{
    // Function to fetch all categories from the database
    public function getAllCategory() {
        // Establish a new database connection
        $ndb = new db_connection();

        // SQL query to select all categories from the 'category' table
        $sql = "SELECT * FROM `category`";

        // Execute the query and return the result as an array of categories
        return $ndb->db_fetch_all($sql);
    }
}
?>
