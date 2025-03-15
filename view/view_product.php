<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in (i.e., 'user_id' is set in the session)
// If not, redirect to the login page to prevent unauthorized access
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php"); // Redirect to login
    exit(); // Exit the script to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding and responsive meta tags for proper page rendering -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Include Tailwind CSS for styling the page -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Section -->
        <div class="w-64" style="background-color: #2d3748;">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-100">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <!-- Sidebar links for navigation (Dashboard, Products, Orders, etc.) -->
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="products_home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 bg-gray-700 text-white">
                    <i class="fas fa-box mr-3"></i> Products
                </a>
                <a href="view_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-shopping-cart mr-3"></i> Orders
                </a>
                <a href="../user_view/home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-user-alt mr-3"></i> Switch to Customer View
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Bar Section -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-xl font-semibold">Products Management - View Products</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['admin_name']; ?></span> <!-- Display admin's name -->
                        <!-- Logout link -->
                        <a href="../actions/log_out_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
                <div class="flex items-center justify-between px-4 pb-4">
                    <!-- Back button to go back to the previous page -->
                    <div class="flex items-center">
                        <a href="products_home.php" class="text-blue-500 hover:text-blue-700 flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                    <div class="flex-1 max-w-2xl ml-6">
                        
                    </div>
                </div>
            </header>

            <!-- Product List Section -->
            <main class="p-6">
                <h3 class="text-2xl font-semibold mb-4">Product List</h3>
                <div id="productsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                        // Include the product display function to fetch and display all products
                        require('../actions/display_product_action.php');
                        displayAllProducts();
                    ?>
                </div>
            </main>
        </div>
    </div>

    <!-- SweetAlert to handle product editing confirmation -->
    <script>
    // Function to confirm and navigate to the edit product page
    function editProduct(productId) {
        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to edit this product?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, edit it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true // Optional: makes the cancel button appear first
        }).then((result) => {
            if (result.isConfirmed) {
                // Navigate to the edit product page if the user confirms
                window.location.href = 'edit_product.php?product_id=' + productId;
            }
        });
    }
</script>
</body>
</html>
