<?php
// Includes controllers for managing products and orders.
require_once('../controllers/product_controller.php');
require_once('../controllers/order_controller.php');

// Start a session to track the user's state
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit(); // Prevents further code execution after redirect
}

// Retrieve necessary data to display in the dashboard
$totalProducts = getTotalProductsCountController();
$totalOrders = getTotalOrdersCount();
$totalRevenue = getTotalOrderRevenueController();
$recentOrders = getRecentOrders(); 
$lowStockProducts = getLowStockProductsController();
$revenueForPast7Days = getRevenueForPast7DaysController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS for layout and styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Chart.js for creating charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styling for category filter buttons to match layout */
        .header-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            display: inline-block;
            text-align: center;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Hover effect for category filter buttons */
        .header-buttons button:hover {
            background-color: #ddd;
        }

        /* Active button state */
        .header-buttons button.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar with navigation links -->
        <div class="w-64" style="background-color: #2d3748;">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-100">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="admin.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="products_home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_products.php' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-box mr-3"></i>
                    Products
                </a>
                <a href="view_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_orders.php' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Orders
                </a>
                <a href="../user_view/home.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                    <i class="fas fa-user-alt mr-3"></i>
                    Switch to Customer View
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Bar with user details and logout button -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-xl font-semibold">Dashboard</h2>
                    <div class="flex items-center">
                        <span class="mr-4"><?php echo $_SESSION['admin_name']; ?></span>
                        <a href="../actions/log_out_action.php" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards displaying total products, orders, and revenue -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                                <i class="fas fa-shopping-bag text-blue-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-gray-500 text-sm">Total Products</h4>
                                <h3 class="text-2xl font-bold"><?php echo $totalProducts['count']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                                <i class="fas fa-chart-line text-green-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-gray-500 text-sm">Total Orders</h4>
                                <h3 class="text-2xl font-bold"><?php echo $totalOrders['total_orders']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                                <i class="fas fa-dollar-sign text-yellow-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-gray-500 text-sm">Total Revenue</h4>
                                <h3 class="text-2xl font-bold">$<?php echo $totalRevenue['total_revenue']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart and Recent Orders Table -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Revenue Chart -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Monthly Revenue</h3>
                        <canvas id="revenueChart" height="200"></canvas>
                    </div>

                    <!-- Recent Orders Table -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left bg-gray-50">
                                        <th class="p-3">Order ID</th>
                                        <th class="p-3">Customer ID</th>
                                        <th class="p-3">Customer Name</th>
                                        <th class="p-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $order) { ?>
                                        <tr class="border-t">
                                            <td class="p-3"><?php echo $order['order_id']; ?></td>
                                            <td class="p-3"><?php echo $order['customer_id']; ?></td>
                                            <td class="p-3"><?php $name = getOrderCustomerName($order['customer_id']); echo $name; ?></td>
                                            <td class="p-3">
                                                <span id="status-<?php echo $order['order_id']; ?>" class="px-2 py-1 text-xs rounded-full">
                                                    <?php echo $order['status']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Products Table -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-4">Low Stock Alert</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Current Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lowStockProducts as $product) { ?>
                                    <tr class="border-t">
                                        <td class="p-3"><?php echo $product['title']; ?></td>
                                        <td class="p-3"><?php echo $product['stock_amount']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Chart.js Script to render the revenue chart -->
    <script>
    const revenueData = <?php echo json_encode($revenueForPast7Days); ?>;

    // Extract labels (dates) and data (revenue values) from the PHP array
    const labels = revenueData.map(item => item.order_day); // Extracts the date from each entry
    const data = revenueData.map(item => parseFloat(item.daily_revenue)); // Extracts and converts revenue to numbers

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: labels, // Dates for the past 7 days
            datasets: [{
                label: 'Revenue ($)',
                data: data, // Revenue data for the past 7 days
                borderColor: '#34D399', // Line color
                backgroundColor: 'rgba(52, 211, 153, 0.2)', // Line fill color
                fill: true, // Fill below the line
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>