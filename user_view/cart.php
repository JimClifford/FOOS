<?php 
// Include necessary functions and controllers for cart functionality
require('../functions/cart_functions.php'); 
require_once('../functions/header.php'); 
require_once('../controllers/cart_controller.php');

// Start session to track the user
session_start();

// Check if the user is logged in, else redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit(); // Prevent further code execution if not logged in
}

// Fetch cart items HTML and grand total
$cartItemsHtml = cartItems($_SESSION['user_id']);
$total = calculateTotal($_SESSION['user_id']);
$grandTotal = calculateGrandTotal($_SESSION['user_id']);

$vat = 0.15 * $grandTotal;

// Check if the cart is empty
$isCartEmpty = empty(getCartItemsByCustomerIdController($_SESSION['user_id']));
$_SESSION['cart_for_invoice'] = $grandTotal;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Ensure full page height and no unwanted margins */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Flexbox settings for main content */
        .main-content {
            flex-grow: 1;
        }

        /* Custom footer background */
        .bg-footer {
            background-color: #2d3748;
        }

        .hover\:bg-footer:hover {
            background-color: #4a5568;
        }

        footer {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Styling for continue shopping button */
        .continue-shopping {
            background-color: #2d3748;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .continue-shopping:hover {
            background-color: #4a5568;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col h-screen">

    <div class="flex flex-col flex-grow">
        <!-- Header Section -->
        <?php echo generateHeaderForNotHome(); ?>

        <!-- Main Content Section -->
        <main class="main-content container mx-auto px-4 mt-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Shopping Cart</h1>
                <!-- Button to continue shopping -->
                <a href="home.php" class="continue-shopping flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                </a>
            </div>
            
            <!-- Display Cart Items in Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-4 text-gray-600 font-bold">Product</th>
                            <th class="p-4 text-gray-600 font-bold">Price</th>
                            <th class="p-4 text-gray-600 font-bold">Quantity</th>
                            <th class="p-4 text-gray-600 font-bold">Total</th>
                            <th class="p-4 text-gray-600 font-bold">Remove</th>
                        </tr>
                    </thead>
                    <!-- Output Cart Items -->
                    <?php echo $cartItemsHtml; ?>
                </table>
            </div>

            <!-- Total , VAT, Grand Total and Checkout Button -->
            <div class="mt-6 flex justify-between items-center">
                <span class="text-lg font-bold">Total: GHS <span class="text-blue-500"><?php echo number_format($total, 2); ?></span></span>

                <span class="text-lg font-bold">VAT(15% of Total Amount):  GHS <span class="text-blue-500"><?php echo number_format($vat, 2); ?></span></span>

                <span class="text-lg font-bold">Grand Total: GHS <span class="text-blue-500"><?php echo number_format($grandTotal, 2); ?></span></span>
                <!-- Display checkout button only if cart is not empty -->
                <?php if (!$isCartEmpty): ?>
                    <a href="checkout.php" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-credit-card mr-2"></i>Proceed To Checkout
                    </a>
                <?php endif; ?>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-footer text-white">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <p>&copy; FOOS 2024. All rights reserved.</p>
                <div class="flex space-x-4">
                    <!-- Social Media Icons -->
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
    </div>

</body>

<!-- Cart Update and Delete Functions -->
<script>
// Update cart item quantity
function updateCart(productId, cId) {
    var qty = document.getElementById('qty_' + productId).value;

    // Check if quantity is valid
    if (qty < 1) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Quantity',
            text: 'Quantity must be at least 1.'
        });
        return;
    }

    // Send request to update cart
    fetch(`../actions/cart_actions.php?p_id=${encodeURIComponent(productId)}&c_id=${encodeURIComponent(cId)}&qty=${encodeURIComponent(qty)}`)
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Cart updated successfully.') {
                Swal.fire({
                    icon: 'success',
                    title: 'Cart Updated!',
                    text: 'Cart updated successfully.'
                }).then(() => {
                    location.reload(); // Reload page after successful update
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: ' + data.message
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                text: 'There was a problem with the update: ' + error.message
            });
        });
}

// Confirm and delete item from cart
function confirmDelete(productId, cId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this item from your cart.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../actions/cart_actions.php?p_id=' + productId + '&c_id=' + cId)
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    if (data.message === 'Item deleted successfully.') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item Deleted!',
                            text: 'The item was deleted successfully.'
                        }).then(() => {
                            location.reload(); // Reload page after successful deletion
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: ' + data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was a problem with the deletion: ' + error.message
                    }).then(() => {
                        location.reload(); // Reload in case of error
                    });
                });
        } else {
            console.log('User canceled the deletion.');
        }
    });
}
</script>
</html>
