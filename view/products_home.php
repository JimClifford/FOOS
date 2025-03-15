<?php
// Start a session to check if the user is logged in
session_start();

// Check if the session variable for user_id is set, meaning the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../view/login.php");
    exit(); // Ensure no further code is executed
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar for navigation links -->
        <div class="w-64" style="background-color: #2d3748;">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-100">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <!-- Dashboard link -->
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <!-- Active Products page link (highlighted) -->
                <a href="products_home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 bg-gray-700 text-white">
                    <i class="fas fa-box mr-3"></i> Products
                </a>
                <!-- Orders page link -->
                <a href="view_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-shopping-cart mr-3"></i> Orders
                </a>
                <!-- Switch to customer view -->
                <a href="../user_view/home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-user-alt mr-3"></i> Switch to Customer View
                </a>
            </nav>
        </div>

        <!-- Main Content Section -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top bar with page title and user info -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-xl font-semibold">Products Management</h2>
                    
                    <div class="flex items-center">
                        <!-- Display logged-in admin's name from session -->
                        <span class="mr-4"><?php echo $_SESSION['admin_name']; ?></span>
                        <!-- Logout link -->
                        <a href="../actions/log_out_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>

                <!-- Go back button -->
                <div class="flex items-center justify-start px-4 pb-4">
                    <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Go Back
                    </a>
                </div>
            </header>

            <!-- Main Products Management Content -->
            <main class="p-6">
                <!-- Grid to layout the cards for actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Add Product Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-300">
                        <div class="text-center">
                            <!-- Add icon for the card -->
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-plus text-green-500 text-2xl"></i>
                            </div>
                            <!-- Title and description for the add product action -->
                            <h3 class="text-xl font-semibold mb-2">Add New Product</h3>
                            <p class="text-gray-600 mb-4">Add new items to your inventory</p>
                            <!-- Button to navigate to the product addition page -->
                            <a href="product.php" class="inline-flex items-center justify-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                                <i class="fas fa-plus mr-2"></i> Add Product
                            </a>
                        </div>
                    </div>

                    <!-- View Products Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-300">
                        <div class="text-center">
                            <!-- View icon for the card -->
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-list text-blue-500 text-2xl"></i>
                            </div>
                            <!-- Title and description for viewing products -->
                            <h3 class="text-xl font-semibold mb-2">View All Products</h3>
                            <p class="text-gray-600 mb-4">Manage your existing inventory</p>
                            <!-- Button to navigate to the page where products are listed -->
                            <a href="view_product.php" class="inline-flex items-center justify-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-300">
                                <i class="fas fa-eye mr-2"></i> View Products
                            </a>
                        </div>
                    </div>

                    <!-- Placeholder for any future cards -->
                </div>
            </main>
        </div>
    </div>
</body>
</html>
