<?php  
require('../controllers/product_controller.php'); // Including the product controller to fetch product details
session_start(); // Starting the session to check user login status
require_once('../functions/header.php'); // Including header function for the website's header
$products = getAllProductsController(); // Fetch all products from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOOS</title>
    <!-- Including Tailwind CSS for styling -->
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Including Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmAddToCart(form) {
        // Check if the session is valid (user is logged in)
        <?php if (!isset($_SESSION['session_valid']) || $_SESSION['session_valid'] !== true) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Not logged in',
                text: 'You need to log in or sign up to add items to your cart.'
            });
            return false;
        <?php } ?>

        // Confirm adding the product to the cart using SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to add this product to your cart?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, add to cart!',
            cancelButtonText: 'Cancel',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Proceed with form submission if confirmed
            }
        });
        
        return false; 
    }

    
</script>


    <style>
        /* Styling for the overall page */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .bg-footer {
            background-color: #2d3748; /* Dark background for footer */
        }

        .hover\:bg-footer:hover {
            background-color: #4a5568; /* Hover effect for footer background */
        }

        .header-buttons button {
            padding: 12px 16px; 
            font-size: 14px; 
            height: 40px; 
            line-height: 1; 
            margin: 0; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border: 1px solid #ccc; 
            border-radius: 6px; 
            background-color: #4a5568; 
            cursor: pointer; 
        }

        .header-buttons button:hover {
            background-color: #e0e0e0; /* Hover effect for buttons */
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!-- Header Section -->
        <?php echo generateHeader(); ?>

        <!-- Main Content Section -->
        <main class="flex-grow container mx-auto px-4">
            <!-- Product Grid -->
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                <?php foreach ($products as $product) { ?>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['title']; ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-2"><?php echo $product['title']; ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $product['description']; ?></p>
                            <!-- Product Add to Cart Form -->
                            <form method="POST" action="../actions/add_cart.php" onsubmit="return confirmAddToCart(this);">
                                <input type="hidden" name="p_id" value="<?php echo $product['product_id']; ?>">
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-500 font-bold">GHS<?php echo $product['price']; ?></span>
                                    <button type="submit" name="add_to_cart" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </main>

        <!-- Footer Section -->
        <footer class="bg-footer text-white py-8 mt-auto">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <p>&copy; 2024 FOOS. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
    </div>
    <script>
    // Function to get URL parameter value
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Check for 'cart_add' parameter in the URL
    const cartAddStatus = getQueryParam('cart_add');

    if (cartAddStatus === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Item Added',
            text: 'The item has been successfully added to your cart!',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (cartAddStatus === 'failed') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error adding the item to your cart. Please try again.',
            timer: 3000,
            showConfirmButton: false
        });
    }

    // Clear the 'cart_add' variable from the URL
    if (cartAddStatus) {
        const url = new URL(window.location);
        url.searchParams.delete('cart_add');
        window.history.replaceState({}, document.title, url.toString());
    }
</script>


</body>

<script>
    // JavaScript function to filter products based on category
    function filterProducts(category) {
        // Get all filter buttons
        const filterButtons = document.querySelectorAll(".filter-button");

        // Remove active class from all buttons
        filterButtons.forEach(button => {
            button.classList.remove("bg-blue-500", "text-white");
            button.classList.add("bg-gray-200", "text-gray-800");
        });

        // Highlight the selected button
        const selectedButton = document.getElementById(
            category === "male" ? "filterMale" : 
            category === "female" ? "filterFemale" : 
            "filterAll"
        );
        selectedButton.classList.remove("bg-gray-200", "text-gray-800");
        selectedButton.classList.add("bg-blue-500", "text-white");

        // AJAX request to fetch filtered products
        fetch("../actions/filter_action.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `category=${category}`,
        })
            .then(response => response.json())
            .then(products => {
                const productsSection = document.querySelector("main section");
                productsSection.innerHTML = ""; // Clear existing products

                // Render each product dynamically based on the response
                products.forEach(product => {
                    productsSection.innerHTML += `
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="${product.img}" alt="${product.title}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold mb-2">${product.title}</h3>
                                <p class="text-gray-600 mb-4">${product.description}</p>
                                <form method="POST" action="../actions/add_cart.php" onsubmit="return confirmAddToCart(this);">
                                    <input type="hidden" name="p_id" value="${product.product_id}">
                                    <div class="flex justify-between items-center">
                                        <span class="text-blue-500 font-bold">GHS${product.price}</span>
                                        <button type="submit" name="add_to_cart" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>`;
                });
            })
            .catch(error => console.error("Error:", error));
    }

    // JavaScript function for handling search functionality
    document.getElementById("searchForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const searchQuery = document.getElementById("searchInput").value;

        // AJAX request to fetch search results
        fetch("../actions/search_action.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `query=${searchQuery}`
        })
        .then(response => response.json())
        .then(products => {
            const productsSection = document.querySelector("main section");
            productsSection.innerHTML = ""; // Clear existing products

            // Loop through products and render each product dynamically
            products.forEach(product => {
                productsSection.innerHTML += `
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="${product.img}" alt="${product.title}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-2">${product.title}</h3>
                            <p class="text-gray-600 mb-4">${product.description}</p>
                            <form method="POST" action="../actions/add_cart.php" onsubmit="return confirmAddToCart(this);">
                                <input type="hidden" name="p_id" value="${product.product_id}">
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-500 font-bold">GHS${product.price}</span>
                                    <button type="submit" name="add_to_cart" class="bg-footer hover:bg-footer text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>`;
            });
        })
        .catch(error => console.error('Error:', error));
    });
</script>

</html>
