var paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener('submit', payWithPaystack, false);

function payWithPaystack(e) {
    e.preventDefault(); // Prevent the default form submission

    var handler = PaystackPop.setup({
        key: 'pk_test_3a0e41fbeb6dfd19a1e6c12fe20b770f427ade21', // Replace with your public key
        email: document.getElementById('email-address').value,
        amount: document.getElementById('amount').value * 100, // Convert amount to lowest currency unit
        currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
        ref: "" + Math.floor(Math.random() * 1000000000 + 1), // Generate a random reference
        callback: function(response) {
            // After successful payment
            $.ajax({
                url: "checkout_process.php?reference=" + response.reference,
                method: "GET",
                success: function (response) {
                    // Redirect to success page
                    window.location.href = "../view/success.php";
                }
            });

            // Submit form to add_order_action.php after payment success
            const formAction = paymentForm.action; // Store the original form action
            paymentForm.action = '../actions/add_order_action.php'; // Set new action
            paymentForm.method = 'POST'; // Ensure POST method is used
            const referenceInput = document.createElement('input');
            referenceInput.type = 'hidden';
            referenceInput.name = 'reference';
            referenceInput.value = response.reference; // Pass the reference to the server
            paymentForm.appendChild(referenceInput); // Add hidden input for the reference
            paymentForm.submit(); // Submit the form to add_order_action.php
        },
        onClose: function() {
            alert('Transaction was not completed, window closed.');
        }
    });

    handler.openIframe(); // Open the payment iframe
}

