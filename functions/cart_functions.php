<?php

// Include necessary controller files for cart and product operations
require_once('../controllers/cart_controller.php');
require_once('../controllers/product_controller.php');

// Function to generate the cart items HTML for the given customer ID
function cartItems($c_id) { 
    // Retrieve the cart items for the customer
    $cartItems = getCartItemsByCustomerIdController($c_id);

    // Initialize an output variable to store the HTML
    $output = '';

    // Check if the cart has items
    if (is_array($cartItems) && count($cartItems) > 0) {
        
        // Begin the table body
        $output .= '<tbody>';

        // Loop through the items and generate HTML rows
        foreach ($cartItems as $row) {
            // Sanitize inputs
            $productId = htmlspecialchars($row['p_id']);
            // Retrieve the product title
            $p = getProductTitleController($productId);
            $product = $p['title'];
            // Retrieve the product price
            $t = getProductPriceController($productId);
            $price = $t['price'];
            // Get the quantity for this item
            $qty = htmlspecialchars($row['qty'], ENT_QUOTES, 'UTF-8');
            // Retrieve the product image
            $i = getProductImageController($productId);
            $img = $i['img'];
            // Calculate the total for this item (quantity * price)
            $total = $qty * $price;

            // Output each row of the cart table with product details
            $output .= '
            <tr class="border-t">
                <td class="p-4 flex items-center">
                    <img src="' . htmlspecialchars($img, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($product, ENT_QUOTES, 'UTF-8') . '" class="w-12 h-12 object-cover rounded-lg mr-4">
                    <div>
                        <h3 class="text-lg font-bold">' . htmlspecialchars($product, ENT_QUOTES, 'UTF-8') . '</h3>
                    </div>
                </td>
                <td class="p-4 text-gray-600">GHS ' . number_format($price, 2) . '</td>
                <td class="p-4">
                    <input class="quantity-input bg-gray-200 rounded-md px-2 py-1" type="number" id="qty_' . $productId . '" name="qty" value="' . $qty . '" min="1">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded ml-4 update-btn" onclick="updateCart(' . $productId . ', ' . $c_id . ')">Update</button>
                </td>
                <td class="p-4 text-gray-600">GHS ' . number_format($total, 2) . '</td>
                <td class="p-4">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded delete-btn" onclick="confirmDelete(' . $productId . ', ' . $c_id . ')">Delete</button>
                </td>
            </tr>
            ';
        }

        // End the table body
        $output .= '</tbody>';
        
    } else {
        // If no items in the cart, display a message
        $output = "<div class='bg-white shadow-md rounded-lg p-4 text-center'>No Products found in your cart.</div>";
    }

    // Return the output HTML for display on the page
    return $output;
}

// Function to calculate the grand total of items in the cart for a given customer ID
function calculateTotal($c_id) {
    // Retrieve the cart items for the customer
    $cartItems = getCartItemsByCustomerIdController($c_id);

    // Initialize a variable to store the grand total
    $grandTotal = 0;

    // Check if the cart has items
    if (is_array($cartItems) && count($cartItems) > 0) {
        // Loop through the items and calculate the grand total
        foreach ($cartItems as $row) {
            // Get the product ID and quantity
            $productId = htmlspecialchars($row['p_id']);
            $qty = htmlspecialchars($row['qty'], ENT_QUOTES, 'UTF-8');

            // Retrieve the product price
            $productData = getProductPriceController($productId);
            $price = $productData['price'];

            // Add the total for this item to the grand total
            $grandTotal += $qty * $price;
        }
    }

    // Return the grand total value
    return $grandTotal;
}

function calculateGrandTotal($c_id) {
    // Retrieve the cart items for the customer
    $cartItems = getCartItemsByCustomerIdController($c_id);

    // Initialize a variable to store the grand total
    $grandTotal = 0;

    // Check if the cart has items
    if (is_array($cartItems) && count($cartItems) > 0) {
        // Loop through the items and calculate the grand total
        foreach ($cartItems as $row) {
            // Get the product ID and quantity
            $productId = htmlspecialchars($row['p_id']);
            $qty = htmlspecialchars($row['qty'], ENT_QUOTES, 'UTF-8');

            // Retrieve the product price
            $productData = getProductPriceController($productId);
            $price = $productData['price'];

            // Add the total for this item to the grand total
            $grandTotal += $qty * $price;
        }
    }

    // Return the grand total value
    $vat = 0.15 * $grandTotal;
    return $grandTotal + $vat;
}

function generateCartInvoiceMessage($c_id) {
    // Retrieve the cart items for the customer
    $cartItems = getCartItemsByCustomerIdController($c_id);

    // Initialize variables
    $total = 0;
    $message = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .email-container {
                    max-width: 600px;
                    margin: 0 auto;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 20px;
                    background-color: #f9f9f9;
                }
                .header {
                    text-align: center;
                    padding: 10px 0;
                    background-color: #4CAF50;
                    color: white;
                    border-radius: 8px 8px 0 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                table th, table td {
                    border: 1px solid #ddd;
                    padding: 10px;
                    text-align: left;
                }
                table th {
                    background-color: #4CAF50;
                    color: white;
                }
                .totals {
                    text-align: right;
                    font-weight: bold;
                    margin-top: 20px;
                }
                .footer {
                    text-align: center;
                    font-size: 12px;
                    color: #666;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>
                    <h2>Thank You for Shopping with FOOS!</h2>
                </div>
                <p>Here is your order summary:</p>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>";

    // Check if the cart has items
    if (is_array($cartItems) && count($cartItems) > 0) {
        // Loop through the items to construct the table rows
        foreach ($cartItems as $row) {
            // Get product details
            $productId = htmlspecialchars($row['p_id']);
            $qty = htmlspecialchars($row['qty'], ENT_QUOTES, 'UTF-8');
            $productData = getProductTitleController($productId);
            $product = $productData['title'];
            $priceData = getProductPriceController($productId);
            $price = $priceData['price'];
            $subtotal = $qty * $price;

            // Add to the total
            $total += $subtotal;

            // Add a row to the table
            $message .= "
                        <tr>
                            <td>{$product}</td>
                            <td>GHS " . number_format($price, 2) . "</td>
                            <td>{$qty}</td>
                            <td>GHS " . number_format($subtotal, 2) . "</td>
                        </tr>";
        }

        // Calculate VAT and grand total
        $vat = 0.15 * $total;
        $grandTotal = $total + $vat;

        // Add totals to the message
        $message .= "
                    </tbody>
                </table>
                <div class='totals'>
                    <p>Total: GHS " . number_format($total, 2) . "</p>
                    <p>VAT (15%): GHS " . number_format($vat, 2) . "</p>
                    <p>Grand Total: GHS " . number_format($grandTotal, 2) . "</p>
                </div>";
    } else {
        // If no items in the cart, display a message
        return "<p>Error: No Products found in your order.</p>";
    }

    // Footer section
    $message .= "
                <div class='footer'>
                    <p>We hope to see you again soon!</p>
                    <p>FOOS Team</p>
                </div>
            </div>
        </body>
    </html>";

    return $message;
}







?>
