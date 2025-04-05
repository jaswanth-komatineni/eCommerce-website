-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 05, 2025 at 04:57 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(11, 2, 4, 2, '2025-04-04 20:45:17', '2025-04-04 20:47:07'),
(12, 2, 5, 1, '2025-04-04 20:47:11', '2025-04-04 20:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `created_at`) VALUES
(2, 'Product 2', 29.99, 'Description for Product 2', 'product2.jpg', '2025-04-04 02:15:00'),
(3, 'Product 3', 39.99, 'Description for Product 3', 'product3.jpg', '2025-04-04 02:15:00'),
(4, 'Product 4', 49.99, 'Description for Product 4', 'product4.jpg', '2025-04-04 02:15:00'),
(5, 'Product 5', 39.99, 'Description for Product 5', 'product5.jpg', '2025-04-04 02:15:00'),
(6, 'Product 6', 29.99, 'Description for Product 6', 'product6.jpg', '2025-04-04 02:15:00'),
(7, 'Product 7', 49.99, 'Description for Product 7', 'product7.jpg', '2025-04-04 02:15:00'),
(8, 'Product 8', 39.99, 'Description for Product 8', 'product8.jpg', '2025-04-04 02:15:00'),
(9, 'Product 9', 29.99, 'Description for Product 9', 'product9.jpg', '2025-04-04 02:15:00'),
(10, 'Pen', 19.99, 'description for a pen', 'product1.png', '2025-04-04 20:20:19'),
(11, 'book', 24.99, 'description of book', 'story book.jpg', '2025-04-04 21:44:36'),
(12, 'story thieves', 34.99, 'Story Thieves series book', 'story thieves.jpg', '2025-04-04 21:46:37'),
(13, 'The King of the World!', 19.99, 'The King of the World! book', 'king of the world.jpg', '2025-04-04 21:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'nani', '19bcs1420@gmail.com', '$2y$10$yBClyggAgo39S4TJABjCVuhxFaFtWNp6rMTN1Z8W725Fp7RcANI7G', '2025-04-04 00:40:48', 'admin'),
(2, 'jkomatin', 'jaswanthkomatineni@gmail.com', '$2y$10$M0Pfv9WrSGgm3teF6b/NIuiefMglzMMD3AnOaJmeJIn0f0WKI/Y3a', '2025-04-04 20:07:47', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
