<?php
// Import the category controller to fetch all categories for the form
require('../controllers/category_controller.php');

// Start a session to manage user authentication
session_start();

// Check if the user is logged in (user ID should be set in session)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../view/login.php");
    exit(); // Ensure no further code is executed
}

// Fetch all categories from the database
$categories = getAllCategorysController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    
    <!-- Include Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // JavaScript to handle messages that may appear in the URL (e.g., success or error messages)
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('msg'); // Get the 'msg' parameter from the URL
        
        if (message) {
            let alertConfig;
            
            // Map the 'msg' parameter to a SweetAlert configuration
            switch (message) {
                case 'product_uploaded':
                    alertConfig = {
                        icon: 'success',
                        title: 'Success',
                        text: 'Product uploaded successfully!',
                        confirmButtonText: 'OK'
                    };
                    break;
                case 'product_upload_failed':
                    alertConfig = {
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to upload product. Please try again.',
                        confirmButtonText: 'Retry'
                    };
                    break;
                case 'image_upload_failed':
                    alertConfig = {
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Image upload failed. Ensure the file format and size are correct.',
                        confirmButtonText: 'Got it'
                    };
                    break;
                default:
                    alertConfig = {
                        icon: 'info',
                        title: 'Notice',
                        text: 'An unknown error occurred. Please try again.',
                        confirmButtonText: 'OK'
                    };
            }

            // Display the SweetAlert dialog
            Swal.fire(alertConfig);

            // Remove the 'msg' parameter from the URL to clean up the address bar
            urlParams.delete('msg');
            const newUrl = window.location.pathname + '?' + urlParams.toString();
            window.history.replaceState(null, '', newUrl.endsWith('?') ? newUrl.slice(0, -1) : newUrl);
        }
    };
</script>
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <!-- Navigation links for admin panel -->
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="products_home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-box mr-3"></i>
                    Products
                </a>
                <a href="view_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Orders
                </a>

                <!-- Switch to customer view -->
                <a href="../user_view/home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-user-alt mr-3"></i>
                    Switch to Customer View
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

            <!-- Back Button and View All Products link -->
            <div class="flex justify-between items-center mb-6">
                <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>

                <!-- View all products button -->
                <a href="view_product.php" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    View All Products
                </a>
            </div>

            <!-- Product Form to Add a New Product -->
            <form action="../actions/add_product_action.php" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
                
                <!-- Category Dropdown -->
                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-semibold mb-2">Category:</label>
                    <select name="category" class="form-select block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                        <!-- Loop through categories and display each one as an option -->
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['category_id']); ?>">
                                <?php echo htmlspecialchars($category['category']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Price Input -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Description Input -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                    <textarea id="description" name="description" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" rows="3" required></textarea>
                </div>

                <!-- Keywords Input -->
                <div class="mb-4">
                    <label for="keywords" class="block text-gray-700 font-semibold mb-2">Keywords:</label>
                    <input type="text" id="keywords" name="keywords" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Stock Input -->
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock Amount:</label>
                    <input type="number" id="stock" name="stock" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Product Image Upload -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Product Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control block w-full border border-gray-300 rounded-lg p-2 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center gap-4 mt-6">
                    <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
