<?php
require('../controllers/product_controller.php'); // Include the controller which handles product-related functions like fetching product by ID

session_start(); // Start a session to track user authentication
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: ../view/login.php");
    exit(); // Prevent further code execution after redirect
}

// Get the product ID from the URL query string
$product_id = $_GET['product_id'];

// Fetch the product details using the controller function
$product = getProductByIdController($product_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Stock - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Link to Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome for icons (if needed) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar Section -->
        <div class="w-64 bg-gray-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Edit Product Stock</h2>

            <!-- Edit Stock Form -->
            <form action="../actions/update_stock_action.php" method="post" class="bg-white shadow-md rounded-lg p-8">
                <!-- Hidden input to pass the product ID to the update action -->
                <input type="hidden" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

                <!-- Product Title (Read-Only) -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Product Title:</label>
                    <!-- Display the product title as read-only -->
                    <input type="text" id="title" value="<?php echo htmlspecialchars($product['title']); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>

                <!-- Stock Amount Input Field -->
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock Amount:</label>
                    <!-- Input field for stock amount with validation -->
                    <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock_amount']); ?>" class="form-control block w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    <!-- Update Button with confirmation -->
                    <button 
                            type="button" 
                            onclick="confirmUpdateStock(event)" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                            Update Stock
                    </button>
                            <!-- Cancel Button with confirmation to cancel and navigate back -->
                    <button type="button" onclick="confirmCancel()" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    // Check if the stock update was successful and display a SweetAlert notification
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        Swal.fire({
            title: 'Success!',
            text: 'Stock successfully updated! Redirecting to product list.',
            icon: 'success',
            timer: 3000, // Automatically close the alert after 3 seconds
            showConfirmButton: false
        }).then(() => {
            // Redirect to the product list page after the alert
            window.location.href = 'view_product.php';
        });
    <?php endif; ?>

    // Function to confirm cancellation and redirect to the product list
    function confirmCancel() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to cancel and return to the product list?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel',
            cancelButtonText: 'No, stay here',
            reverseButtons: true // Optional: makes the cancel button appear first
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the product listing page if the user confirms
                window.location.href = 'view_product.php';
            }
        });
    }

    function confirmUpdateStock(event) {
        event.preventDefault(); // Prevent the form from submitting immediately
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update the stock?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it',
            cancelButtonText: 'Cancel',
            reverseButtons: true // Optional: makes the cancel button appear first
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                event.target.closest('form').submit();
            }
        });
    }
</script>
</body>
</html>
