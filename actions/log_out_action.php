<?php

// Start the session to access session variables
session_start();

// Clear all session variables
session_unset();  // This will remove all session variables

// Destroy the session completely
session_destroy();  // This will terminate the session

// Redirect the user to the homepage (index.php) after logging out
header("Location: ../index.php");

// Exit the script to ensure no further code is executed
exit();
?>
