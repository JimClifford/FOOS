-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 12:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `ip_addr` varchar(50) DEFAULT NULL,
  `c_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_addr`, `c_id`, `qty`) VALUES
(17, '', 2, 2),
(19, '', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `order_amount` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `invoice`, `order_date`, `status`, `order_amount`) VALUES
(31, 2, '448725', '2024-11-20', 'paid', 125),
(32, 20, '734317', '2024-11-20', 'paid', 45);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `qty`) VALUES
(31, 19, 1),
(31, 20, 1),
(31, 27, 1),
(32, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `stock_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category`, `title`, `price`, `description`, `keywords`, `img`, `stock_amount`) VALUES
(17, '1', 'Cargo Pants Deep Brown', 50.00, 'Brown cargo pants for men', 'cargo,brown,pants,men', '../images/3284647366cargo1.jpeg', 20),
(18, '1', 'Cargo Pant Light Brown', 45.00, 'Light brown cargo pants for men', 'Men, Cargo, Fit, men, brwon', '../images/2041556845cargo4.jpeg', 13),
(19, '1', 'Black cargo pants', 45.00, 'Black Cargo pants for men', 'Men, Cargo, Fit, Slim fir, male', '../images/1048371558cargo7.jpeg', 17),
(20, '1', 'White cargo pants', 45.00, 'men cargo pants - white', 'Men, Cargo, Fit, Slim Fit,white', '../images/1750027745cargo8.jpeg', 15),
(21, '1', 'cargo pants brown', 49.00, 'cargo pants white for male', 'Men, Cargo, Fit, Slim Fit, brwon', '../images/2065721449cargo2.jpeg', 15),
(22, '1', 'Cargo pants Green', 45.00, 'cargo pants', 'Men, Cargo, Fit, Slim Fit,green', '../images/1853622247cargo3.jpeg', 15),
(23, '1', 'Cargo Shorts', 30.00, 'cargo shorts for men army green', 'Men, Cargo, Fit, Shorts, army green', '../images/1938813152cargoshorts1.jpeg', 8),
(24, '1', 'Classic Shorts - White', 50.00, 'Classic Shorts for Men', 'shorts, classic ,men, ', '../images/1423167747cargoshorts4.jpeg', 9),
(25, '1', 'Classic Shorts - Blue', 50.00, 'classic shorts for men', 'Men, classic, shorts, blue', '../images/1979463246cargoshorts3.jpeg', 5),
(26, '1', 'Flannel Shirt', 35.00, 'nice flannel shirts', 'shirts,men, flannel', '../images/3161500196shirt1.jpeg', 45),
(27, '1', 'Flannel Shirt - white/blue', 35.00, 'nice flannel shirts for men', 'men, shirt , flannel, ', '../images/6986944646shirt2.jpeg', 4),
(28, '1', 'Flannel Shirt Men - Blue', 40.00, 'blue flannel shirt for men', 'men,shirt,flannel,blue', '../images/1780942474shirt3.jpeg', 5),
(29, '1', 'Flannel Shirt - White ', 40.00, 'shirt, flannel,white for men', 'shirt, flannel,white for men', '../images/1662551520shirt7.jpeg', 5),
(30, '1', 'Shirt Flanner - Nice', 40.00, 'shirt for men, flannel', 'shirt for men, flannel', '../images/1434075615shirt6.jpeg', 5),
(31, '1', 'Flannel Shirt - Deep Blue', 40.00, 'deep blue flannel shirt', 'deep, blue, flannel, shirt', '../images/7140395446shirt4.jpeg', 5),
(32, '1', 'Flannel Shirt - Brown', 45.00, 'brown flannel shirt for men', 'brown, flannel, shirt, men', '../images/1022107673shirt8.jpeg', 4),
(33, '2', 'Flannel Shirt Women - Red', 45.00, 'red flannel shirt for women', 'red, flannel, shirt,  women', '../images/1571091826wshirt2.jpeg', 5),
(34, '2', 'Flannel Shirt Women - Blue', 40.00, 'blue flannel shirt for women', 'blue, flannel, shirt, women', '../images/1568776016wshirt3.jpeg', 4),
(35, '2', 'Flannel Shirt For women - White', 40.00, 'white flannel shirt for women', 'white, flannel, shirt, women', '../images/7594508566wshirt4.jpeg', 5),
(36, '2', 'Cyan Flannel Shirt For Women', 35.00, 'nice flannel shirt for women', 'women, shirt, nice', '../images/2098477183wshirt1.jpeg', 4),
(37, '2', 'Cargo Short for women - black', 45.00, 'nice cargo shorts for women', 'cargo,shorts,female,black', '../images/1855384179wcargo2.jpeg', 3),
(38, '2', 'Cargo Shorts Brown women', 40.00, 'nice cargo shorts for women', 'cargo,shorts,women', '../images/9299887226wcargo1.jpeg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `contact_number` varchar(256) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `country`, `city`, `contact_number`, `image`, `role`) VALUES
(2, 'Admin@Xavier', 'micy@ashesi.edu.gh', '3d69f7548cb1177c3b1a89c818ec903f', 'Ghana', 'Berekuso', '+233552088914', NULL, 0),
(20, 'Jimmy Jazz', 'jim.edward@ashesi.edu.gh', '686f54f48982050e0964e65595bc9d66', 'Finland', '', '+233552088914', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`,`c_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
