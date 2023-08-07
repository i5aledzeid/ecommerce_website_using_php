-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2023 at 09:35 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21113871_shopy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'i5aledzeid', '7239e5187ddaca70eb2b4b8c1b169d7ba43a1808');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `title`, `subtitle`, `link`, `image`, `created_at`) VALUES
(1, 'Apple', 'Apple Inc. is an American multinational technology company headquartered in Cupertino, California. Apple is the world\'s largest technology company by revenue, with US$394.3 billion in 2022 revenue. As of March 2023, Apple is the world\'s biggest company by market capitalization.', 'apple', 'laptop-2.webp', '2023-08-05'),
(2, 'LG', 'LG Corporation, known as LG and formerly Lucky-Goldstar from 1983 to 1995, is a South Korean multinational conglomerate founded by Koo In-hwoi and managed by successive generations of his family. It is the fourth-largest chaebol in South Korea.', 'lg', 'laptop-2.webp', '2023-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `subtitle`, `link`, `image`, `created_at`) VALUES
(1, 'Laptop', 'A portable microcomputer having its main components (such as processor, keyboard, and display screen) integrated into a single unit capable of battery-powered operation.', 'laptop', '', '2023-08-06'),
(2, 'Television', 'A system for converting visual images (with sound) into electrical signals, transmitting them by radio or other means, and displaying them electronically on a screen.', 'television', '', '2023-08-06'),
(3, 'Camera', 'A device for recording visual images in the form of photographs, film, or video signals.', 'camera', '', '2023-08-06'),
(4, 'Mouse', 'A small handheld device which is moved across a mat or flat surface to move the cursor on a computer screen.', 'mouse', '', '2023-08-06'),
(5, 'Fridge', 'Fridge is short for refrigerator, that giant kitchen appliance that keeps food cold.', 'fridge', '', '2023-08-06'),
(6, 'Washing Machine', 'A machine for washing clothes, sheets, and other things made of cloth.', 'washing', '', '2023-08-06'),
(7, 'Smartphone', 'A mobile phone that performs many of the functions of a computer, typically having a touchscreen interface, internet access, and an operating system capable of running downloaded apps.', 'smartphone', '', '2023-08-06'),
(8, 'Watch', 'A small timepiece worn typically on a strap on one\'s wrist.', 'watch', '', '2023-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 2, 'user', '1004039239', 'user@gmail.com', 'cash on delivery', 'flat no. 2, Tokyo Ghoul, Tokyo, Osaka, Japan - 123456', 'LG (1359 x 1) - ', 1359, '2023-08-07', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`, `brand`, `created_by`) VALUES
(1, 'MacBook Air 16', 'Product details', 666, '4ebc92d70ccc33b1c731e398976cd32c57d72014_589225.jpg', '123fd9e53305d0bee7140768cb2c03968bbdc65c_571594_4.jpg', '558437_0.jpg', 'Laptop', 'Apple', 'Khaled Zeid'),
(2, 'MacBook Air 14', 'Product details', 323, '558437_1.jpg', '558437_2.jpg', '558437_4.jpg', 'Laptop', 'Apple', 'Khaled Zeid'),
(3, 'MacBook Air 13', 'Product details (required) \r\nenter product details', 5443, '558437_5.jpg', '571594_0.jpg', 'b8a02514bdff679ae03ed0b4ddf57fffe38f0f88_571594_1.jpg', 'Laptop', 'Apple', 'Khaled Zeid'),
(4, 'iPhone 14', 'no note', 1425, '0c8af9460cf39ace9fa43e0b4442c39778006905_620141.jpg', '6f1933f06f9b04613b5a31e4b9a06dc9282e01bc_620225.jpg', '004579b9568bb0f607102e178e181903fd6b9618_620113.jpg', 'Smartphone', 'Apple', 'Khaled Zeid'),
(5, 'LG', 'ألوان نقية بدقة Real 4K\r\nتقنية NanoCell\r\nمعالج (α5 Gen5 AI Processor 4K) من LG\r\nThinQ AI', 1359, '4f9d8f573c516463af00776702dd8986edf5c5e6_610730.jpg', 'eb9251b7e213f6fb711ddfa7ad86d912beab0d0d_610730_1.jpg', 'ac8137f0b27c7b016e1cfd25f68a1440bc689a43_610730_2.jpg', 'Television', 'LG', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `title`, `subtitle`, `status`, `image`, `background`, `created_by`, `created_at`) VALUES
(1, 'Khaled Zeid', 'khaled zeid store.', 6, '@i5aledzeid-profile.jpeg', 'home-bg.png', '1', '2023-08-06 15:55:34'),
(2, 'User', 'user store.', 0, 'avatar_man_muslim_icon.png', 'home-bg-1.png', '2', '2023-08-06 15:58:12'),
(3, 'Customer', 'customer store.', 0, 'avatar_male_man_portrait_icon.png', 'home-bg-1.png', '3', '2023-08-07 13:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'i5aledzeid', 'i5aledzeid@gmail.com', '7239e5187ddaca70eb2b4b8c1b169d7ba43a1808'),
(2, 'user', 'user@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(3, 'customer', 'customer@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
