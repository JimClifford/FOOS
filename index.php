<?php
//require_once('../functions/header.php'); 




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOOS - The Home Of Sustainable Fashion</title>
    <link rel="icon" href="images/foos.ico" type="image/x-icon">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .bg-footer {
            background-color: #2d3748;
        }

        .hover\:bg-footer:hover {
            background-color: #4a5568;
        }

        /* Custom styles for the landing page */
        .landing-page {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }

        /* Video background styling */
        .landing-page video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the video covers the whole screen */
            z-index: -1; /* Puts the video behind the content */
        }

        .landing-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .landing-button {
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            background-color: #2d3748;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .landing-button:hover {
            background-color: #4a5568;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-center items-center">
                <!-- Centered Logo -->
                <a href="../index.php" class="text-2xl font-bold text-gray-800">
                    <img src="images/foos.png" alt="FOOS Logo" class="h-8">
                </a>
            </div>
        </div>
    </header>
        
        
        <section class="landing-page">
            <!-- Video background -->
            <video autoplay muted loop>
                <source src="video/landingPageVideo.mp4" type="video/mp4"> <!-- Replace with the actual path to your video -->
                Your browser does not support the video tag.
            </video>
            
            <div class="text-white z-10">
                <h1 class="text-5xl font-bold mb-4">Welcome to FOOS</h1>
                <p class="text-xl mb-6">Sustainable, affordable, and stylish second-hand fashion for everyone.</p>

                <!-- Buttons -->
                <div class="landing-buttons">
                    <a href="user_view/home.php" class="landing-button">Start Shopping with Us</a>
                    <a href="user_view/about.php" class="landing-button">Learn More About FOOS</a>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
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
</body>
</html>
