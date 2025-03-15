<?php 

// Function to generate the header for the site (for the homepage)
function generateHeader() {
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Admin Header message if the user is an admin
    $adminHeader = '';
    if (!empty($_SESSION['admin']) && $_SESSION['admin'] === true) {
        $adminHeader = <<<HTML
        <div class="bg-red-500 text-white text-center py-2">
            <p>You are an Admin currently using the ordinary customer view. 
                <a href="../view/admin.php" class="text-blue-800 underline hover:text-blue-600">Click here to return to the admin dashboard</a>.
            </p>
        </div>
        HTML;
    }

    // Main Header structure with logo, navigation, search, and user-specific options
    $header = <<<HTML
    {$adminHeader}
    <!-- Main Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Left side: Logo -->
                <div class="w-full md:w-1/4 flex items-center">
                    <a href="../index.php" class="text-2xl font-bold text-gray-800">
                        <img src="../images/foos.png" alt="FOOS Logo" class="h-8">
                    </a>
                </div>

                <!-- Buttons for filtering products (Male, Female, No Filter) -->
                <div class="flex space-x-4 header-buttons">
                    <button onclick="filterProducts('male')" 
                            id="filterMale" 
                            class="filter-button bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded">
                        Male
                    </button>
                    <button onclick="filterProducts('female')" 
                            id="filterFemale" 
                            class="filter-button bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded">
                        Female
                    </button>
                    <button onclick="filterProducts('all')" 
                            id="filterAll" 
                            class="filter-button bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded">
                        No Filter
                    </button>
                </div>

                <!-- Center: Search bar -->
                <div class="w-full md:w-1/3">
                    <form id="searchForm" class="flex">
                        <input type="text" 
                               id="searchInput"
                               name="query" 
                               placeholder="Search products..." 
                               class="w-full px-4 py-2 border rounded-l focus:outline-none focus:border-gray-500">
                        <button type="submit" 
                                class="bg-footer hover:bg-footer text-white px-6 py-2 rounded-r">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Right side: Navigation, Login/Account, Cart -->
                <div class="w-full md:w-1/3 flex justify-end items-center space-x-4">
                    <nav class="flex space-x-4">
                        <a href="../user_view/home.php" class="text-gray-600 hover:text-gray-800">Home</a>
                        <a href="../user_view/about.php" class="text-gray-600 hover:text-gray-800">About</a>
                    </nav>
    HTML;

    // Account/Login Dropdown based on session state
    if (isset($_SESSION['user_id']) && isset($_SESSION['admin'])) {
        // User logged in: Show account dropdown and cart
        $header .= <<<HTML
                    <!-- Account Dropdown Menu -->
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-user"></i>
                            <span>Account</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden dropdown-menu">
                            <a href="#" id="logoutBtn" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>

                    <!-- Cart Button -->
                    <a href="../user_view/cart.php" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-shopping-cart mr-2"></i>View Cart
                    </a>

                    <script>
                        const accountButton = document.querySelector('button.flex');
                        const dropdownMenu = document.querySelector('.dropdown-menu');
                        accountButton.addEventListener('click', function() {
                            dropdownMenu.classList.toggle('hidden');
                        });

                        document.getElementById('logoutBtn').addEventListener('click', function() {
                            window.location.href = '../actions/log_out_action.php';
                        });
                    </script>
        HTML;
    } else {
        // User not logged in: Show login link and "Login to View Cart" message
        $header .= <<<HTML
                    <a href="../view/login.php" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login To View Cart
                    </a>
        HTML;
    }

    // Close the header structure
    $header .= <<<HTML
                </div>
            </div>
        </div>
    </header>
    HTML;

    return $header;
}

// Function to generate the header for all pages except the home page
function generateHeaderForNotHome() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Admin Header message if the user is an admin
    $adminHeader = '';
    if (!empty($_SESSION['admin']) && $_SESSION['admin'] === true) {
        $adminHeader = <<<HTML
        <div class="bg-red-500 text-white text-center py-2">
            <p>You are an Admin currently using the ordinary customer view. 
                <a href="../view/admin.php" class="text-blue-800 underline hover:text-blue-600">Click here to return to the admin dashboard</a>.
            </p>
        </div>
        HTML;
    }

    // Main Header structure for non-home pages (similar to the above)
    $header = <<<HTML
    {$adminHeader}
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="w-full md:w-1/4 flex items-center">
                    <a href="../index.php" class="text-2xl font-bold text-gray-800">
                        <img src="../images/foos.png" alt="FOOS Logo" class="h-8">
                    </a>
                </div>
                <div class="w-full md:w-1/3 flex justify-end items-center space-x-4">
                    <nav class="flex space-x-4">
                        <a href="../user_view/home.php" class="text-gray-600 hover:text-gray-800">Home</a>
                        <a href="../user_view/about.php" class="text-gray-600 hover:text-gray-800">About</a>
                    </nav>
    HTML;

    // Account and Cart options for logged-in users
    if (isset($_SESSION['user_id'])) {
        $header .= <<<HTML
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-user"></i>
                            <span>Account</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden dropdown-menu">
                            <a href="../actions/log_out_action.php" id="logoutBtn" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>

                    <script>
                        const accountButton = document.querySelector('button.flex');
                        const dropdownMenu = document.querySelector('.dropdown-menu');
                        accountButton.addEventListener('click', function() {
                            dropdownMenu.classList.toggle('hidden');
                        });

                        document.getElementById('logoutBtn').addEventListener('click', function() {
                            window.location.href = '../actions/log_out_action.php';
                        });
                    </script>
        HTML;
    } 

    // Add the cart button at the end
    $header .= <<<HTML
                    <a href="../user_view/cart.php" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-shopping-cart mr-2"></i>View Cart
                    </a>
                </div>
            </div>
        </div>
    </header>
    HTML;

    return $header;
}

?>
