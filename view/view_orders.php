<?php
// Including the order controller to interact with the order-related functions
require_once('../controllers/order_controller.php');

// Starting a session to check if the user is logged in
session_start();

// Checking if the user is not logged in, then redirect to login page
if (!isset($_SESSION['user_id'])) {
    // If not set, redirect to the login page
    header("Location: ../view/login.php");
    exit(); // Make sure no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar for navigation -->
        <div class="w-64" style="background-color: #2d3748;">
            <div class="p-6">
                <!-- Admin Panel Heading -->
                <h1 class="text-2xl font-bold text-gray-100">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <!-- Navigation Links -->
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="products_home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-box mr-3"></i> Products
                </a>
                <a href="view_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 bg-gray-700 text-white">
                    <i class="fas fa-shopping-cart mr-3"></i> Orders
                </a>

                <!-- Switch to Customer View -->
                <a href="../user_view/home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-user-alt mr-3"></i>
                    Switch to Customer View
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header Section -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <!-- Page Title -->
                    <h2 class="text-xl font-semibold">Orders Management</h2>
                    
                    <div class="flex items-center">
                        <!-- Admin Name and Logout Link -->
                        <span class="mr-4"><?php echo $_SESSION['admin_name']; ?></span>
                        <a href="../actions/log_out_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>

                <!-- Go Back Button (returns to the previous page) -->
                <div class="flex items-center justify-start px-4 pb-4">
                    <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Go Back
                    </a>
                </div>
            </header>

            <!-- Orders Table Section -->
            <main class="p-6">
                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Orders Table -->
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-3 px-4 text-left">Order ID</th>
                                <th class="py-3 px-4 text-left">Customer ID</th>
                                <th class="py-3 px-4 text-left">Customer Name</th>
                                <th class="py-3 px-4 text-left">Order Date</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Update Status</th>
                                <th class="py-3 px-4 text-right">Confirm Status Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetching all orders from the database
                            $orders = getAllOrders();
                            foreach ($orders as $order) {
                                echo "<tr class='border-b'>";
                                echo "<td class='py-3 px-4'>" . $order['order_id'] . "</td>";
                                echo "<td class='py-3 px-4'>" . $order['customer_id'] . "</td>";
                                echo "<td class='py-3 px-4'>" . getOrderCustomerName($order['customer_id']) . "</td>";
                                echo "<td class='py-3 px-4'>" . $order['order_date'] . "</td>";
                                echo "<td class='py-3 px-4'>" . $order['status'] . "</td>";
                                echo "<td class='py-3 px-4'>";
                                echo "<select id=status_".$order['order_id']." name='status' class='border rounded px-2 py-1' id='status_".$order['order_id']."'>";
                                echo "<option value='paid'>Paid</option>";
                                echo "<option value='delivery pending'>Delivery Pending</option>";
                                echo "<option value='delivered'>Delivered</option>";
                                echo "</select>";
                                echo "</td>";
                                echo "<td class='py-3 px-4 text-right'>";
                                // Confirm Update Button
                                echo "<button type='button' class='bg-blue-500 text-white px-4 py-2 rounded' onclick='updateOrderStatus(".$order['order_id'].")'>Confirm Update</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
    function updateOrderStatus(orderId) {
        // Get the selected status for the order
        var status = document.querySelector(`#status_${orderId}`).value;

        // Check if a valid status is selected
        if (!status) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid status',
                text: 'Please select a valid status.'
            });
            return;
        }

        // Ask for confirmation before proceeding with SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update this order status?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch request to update the order status
                fetch(`../actions/order_actions.php?order_id=${encodeURIComponent(orderId)}&status=${encodeURIComponent(status)}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Order status updated successfully.') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Order status updated successfully.'
                        });
                        location.reload(); 
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error: ' + data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was a problem with the update: ' + error.message
                    });
                });
            }
        });
    }
</script>
</body>
</html>
