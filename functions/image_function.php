<?php

// Function to handle image upload and return file path
function uploadImage($image) {
    $targetDir = "../images/"; // Path to the images directory
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    
    // Create a unique file name using uniqid() with a prefix
    $uniquePrefix = substr(uniqid(rand(), true), 0, 10); // Take first 10 characters of a unique ID
    $fileName = $uniquePrefix . basename($image["name"]); // Combine unique prefix with original file name

    $targetFile = $targetDir . $fileName; // Full file path

    // Check if the uploaded file is an actual image
    if (getimagesize($image["tmp_name"]) === false) {
        return false; // Not an image file
    }

    // Check if the file already exists (this should never happen due to the random name)
    if (file_exists($targetFile)) {
        return false; // File already exists
    }

    // Check file size (e.g., limit to 5MB)
    if ($image["size"] > 5000000) {
        return false; // File is too large
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return false; // Invalid file format
    }

    // Try to upload the file
    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        return $targetFile; // Return the file path if successful
    } else {
        return false; // Upload failed
    }
}




?>