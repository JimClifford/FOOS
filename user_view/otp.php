<?php
session_start();

// Check if the user is logged in (session variable is set)
if (!isset($_SESSION['user_id'])) {
    // If session variable is not set, redirect to the login page
    header("Location: ../view/login.php");
    exit(); // Ensure no further code is executed after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA for Security - FOOS</title>
    <link rel="icon" href="../images/foos.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS for form styling and overall page appearance -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;  /* Light background for the page */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;  /* White background for the form */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);  /* Shadow effect for the form */
        }

        h2 {
            text-align: center;
            color: #333;  /* Dark color for headings */
        }

        label {
            font-size: 14px;
            color: #555;  /* Slightly lighter color for label text */
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ccc;  /* Border around input fields */
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #475569;  /* Button background color */
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3a4b5e;  /* Darken button when hovered */
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        #request-new-otp {
            display: none;  /* Hide the "Request New OTP" button initially */
            margin-top: 10px;
            padding: 10px;
            background-color: #f44336;  /* Red background for the button */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #request-new-otp:hover {
            background-color: #d32f2f;  /* Darker red when button is hovered */
        }

        #countdown {
            margin-top: 10px;
            font-size: 14px;
            color: #555;  /* Lighter color for the countdown message */
        }
    </style>

    <!-- jQuery for AJAX handling and DOM manipulation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Function to validate OTP input (6 digits)
        function validateOTP() {
            var otp = document.getElementById("otp").value;

            // Clear previous error message
            document.getElementById("error").innerHTML = "";

            // Ensure OTP is 6 digits and contains only numbers
            if (!/^\d{6}$/.test(otp)) {
                document.getElementById("error").innerHTML = "Please enter a valid 6-digit OTP.";
                return false;
            }
            return true; // Allow form submission if OTP is valid
        }

        // Function to request a new OTP if needed
        function requestNewOTP() {
    var requestOtpButton = document.getElementById("request-new-otp");
    requestOtpButton.disabled = true;  // Disable the button while waiting
    startCountdown();  // Start the countdown for OTP regeneration

    // AJAX request to regenerate OTP
    $.ajax({
        url: '../actions/otp_action.php', // Path to the action file
        type: 'POST',
        data: { action: 'regenerate_otp' }, // Action identifier for OTP regeneration
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                // SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Check your email',
                    text: response.message,  // Show the success message
                    confirmButtonText: 'OK'
                });
            } else {
                // SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,  // Show the error message
                    confirmButtonText: 'Try Again'
                });
            }
        },
        error: function(xhr, status, error) {
            // SweetAlert error for AJAX request failure
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "An error occurred while processing the request. Please try again.",
                confirmButtonText: 'OK'
            });
        }
    });
}

        // Countdown timer for re-enabling the "Request New OTP" button
        function startCountdown() {
            var countdownTime = 50;  // Countdown duration (in seconds)
            var countdownElement = document.getElementById("countdown");

            countdownElement.innerHTML = "Please wait " + countdownTime + " seconds before requesting a new OTP.";

            var countdownInterval = setInterval(function() {
                countdownTime--;  // Decrease countdown time
                countdownElement.innerHTML = "Please wait " + countdownTime + " seconds before requesting a new OTP.";

                // Stop countdown and re-enable button when time reaches 0
                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "";
                    document.getElementById("request-new-otp").disabled = false;  // Re-enable the button
                }
            }, 1000); // Update countdown every second
        }
    </script>
</head>
<body>

    <div class="container">
        <h2>Enter Your OTP</h2>

        <!-- OTP Form -->
        <form action="../actions/otp_action.php" method="POST" onsubmit="return validateOTP();">
            <label for="otp">Enter the OTP sent to your email here:</label>
            <input type="text" id="otp" name="otp" maxlength="6" placeholder="Enter 6-digit OTP" required>

            <!-- Error message container -->
            <div class="error" id="error">
                <?php
                // Display any error message passed via the GET parameter (e.g., wrong OTP)
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            </div>

            <!-- Submit button for OTP -->
            <input type="submit" value="Submit">
        </form>

        <!-- Button to request a new OTP -->
        <button id="request-new-otp" onclick="requestNewOTP()">Request New OTP</button>

        <!-- Countdown timer display -->
        <div id="countdown"></div>
    </div>

    <script>
        // If there's an error, show the "Request New OTP" button
        if (document.getElementById("error").innerHTML != "") {
            document.getElementById("request-new-otp").style.display = "block";
        }
    </script>

</body>
</html>
