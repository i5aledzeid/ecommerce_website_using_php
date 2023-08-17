-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2023 at 02:34 PM
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
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `image_4` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `subtitle`, `image_1`, `image_2`, `image_3`, `image_4`, `status`, `created_by`, `created_at`) VALUES
(1, 'Banner Title 1', 'Banner Subtitle 1', 'home-bg.png', 'home-bg-1.jpg', 'home-bg-5.jpg', 'home-bg-8.jpg', 0, 1, '2023-08-11');

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
(2, 'LG', 'LG Corporation, known as LG and formerly Lucky-Goldstar from 1983 to 1995, is a South Korean multinational conglomerate founded by Koo In-hwoi and managed by successive generations of his family. It is the fourth-largest chaebol in South Korea.', 'lg', 'laptop-2.webp', '2023-08-05'),
(3, 'Samsung', 'Samsung is committed to complying with local laws and regulations as well as applying a strict global code of conduct to all employees. It believes that ethical management is not only a tool for responding to the rapid changes in the global business environment, but also a vehicle for building trust with its various stakeholders including customers, shareholders, employees, business partners and local communities. With an aim to become one of the most ethical companies In the world, Samsung continues to train its employees and operate monitoring systems, while practicing fair and transparent corporate management.', 'samsung', 'laptop-2.webp', '2023-08-05');

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
  `image` varchar(100) NOT NULL,
  `store` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
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
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `name`, `phone`, `email`, `password`, `status`, `created_at`) VALUES
(1, 'deliveries', '1004039239', 'deliveries@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 0, '2023-08-16');

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
  `oid` bigint(255) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `order_store`
--

CREATE TABLE `order_store` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `oid` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `total_products` varchar(1275) NOT NULL,
  `total_price` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `store` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL,
  `delivery_by` int(11) NOT NULL DEFAULT 0,
  `delivery_price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_by` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`, `brand`, `created_by`, `sid`) VALUES
(1, 'MacBook Pro 14', 'Processor Type: M1 Pro 10-core chip with 16-core Neural Engine\r\nScreen Card: 16-core GBU\r\nScreen type: Liquid Retina XDR Display\r\nScreen size: 14.2 inches\r\nOperating system: macOS Monterey\r\nGeneration / year of release: 2021\r\nColour: Space Gray\r\nCapacity: 1 TB SSD\r\nSystem memory capacity: 16 GB RAM\r\nConnectivity Technology Bluetooth - Wi-Fi\r\nWeight: 1.60 kg\r\nShipping weight: 2.78 lbs', 2666, '571627.jpg', 'baef972cddcf7338ddba3cc82d2607da492dec02_571627_1.jpg', '7b414a4287e144d68ba1da7654756cf2e53e6ccb_571627_6.jpg', 'Laptop', 'Apple', 'Khaled Zeid', 1),
(2, 'MacBook Air 13', 'Processor Type: Octa-core M1 chip with 16-core Neural Engine\r\nScreen Card: 7 Core GBU\r\nScreen type: Retina display\r\nScreen size: 13.3 inches\r\nOperating system: macOS Big Sur\r\nGeneration / year of release: 2020\r\nColour: Space Gray\r\nCapacity: 256 GB SSD\r\nSystem memory capacity: 8 GB RAM\r\nSound features: Speakers/Built-in Microphone\r\nBattery type: Lithium-ion polymer battery\r\nWeight: 1.29 kg', 1012, '558437.jpg', '558437_1.jpg', '558437_4.jpg', 'Laptop', 'Apple', 'Khaled Zeid', 1),
(3, 'MacBook Air 15 M2', 'Processor Type: Octa-core M2 chip with 16-core Neural Engine\r\nGraphics card: 10 GBU cores\r\nScreen type: Liquid Retina display\r\nScreen Size: 15.3&#34;\r\nOperating system: macOS Ventura\r\nGeneration / year of release: 2023\r\nColor: starlight color\r\nCapacity: 512GB SSD\r\nSystem memory capacity: 8 GB RAM\r\nFingerprint reader: Yes\r\nBattery type: lithium polymer battery\r\nWeight: 1.51 kg', 1852, 'b8be1d7db630a9f134c72f3171603e07f3796af8_619142.jpg', 'e17a2c79f0e7bf72c2711a52f746428e0d911e09_619142_2.jpg', '8869f93a2bac80023083eabad424d334c13eaeaa_619142_4.jpg', 'Laptop', 'Apple', 'Khaled Zeid', 1),
(4, 'MacBook Air 13 M2', 'Processor Type: Octa-core M2 chip with 16-core Neural Engine\r\nScreen Card: 8 Core GBU\r\nScreen type: Retina display\r\nScreen Size: 13.6&#34;\r\nOperating system: macOS Monterey\r\nGeneration / year of release: 2022\r\nColour: Space Gray\r\nCapacity: 256 GB SSD\r\nSystem memory capacity: 8 GB RAM\r\nWeight: 1.24 kg', 1333, '409d2d1e40d7b4edfeb5b212c54ea44afaed8294_589170.jpg', '2913b6646ec57428ee438832d041d9670b1b809b_589170_7.jpg', 'a71c0def663b7c272436ba0af5fb86f37880a233_589170_3.jpg', 'Laptop', 'Apple', 'Khaled Zeid', 1),
(5, 'MacBook Pro 13 M2', 'Processor Type: Octa-core M2 chip with 16-core Neural Engine\nGraphics card: 10 GBU cores\nScreen type: Retina display\nScreen size: 13.3 inches\nOperating system: macOS Monterey\nGeneration / year of release: 2022\nColour: Space Gray\nCapacity: 256 GB SSD\nSystem memory capacity: 8 GB RAM\nBattery type: lithium polymer battery\nWeight: 1.38 kg', 1600, '0f3bf30bcb9a5d97cd8e62a71ca58eb5401047df_589228.jpg', '45677ce033de74319ce737cc6494afdbf10a3331_589228_5.jpg', 'e253c7dfd259104ded930ecb829c06796844b34c_589228_3.jpg', 'Laptop', 'Apple', 'Khaled Zeid', 1),
(6, 'iPad Pro 9.12', 'Supported networks: Wi-Fi\r\nBattery type: lithium polymer battery\r\nBattery capacity: up to 10 hours\r\nNumber of core processing cores: 8-core CPU\r\nScreen protection type: Anti-fingerprint coating / anti-fingerprint glass\r\nPorts: USB-C (Thunderbolt/USB 4).\r\nModel Series: Apple iPad Pro\r\nCapacity: 2 TB\r\nGeneration / year of release: (iPad Pro) 2022\r\nSystem memory capacity: 16 GB RAM\r\nProcessor Speed: 4 Performance Cores/4 Efficiency Cores\r\nOperating system: iPadOS 16\r\nShipping weight: 1.71', 2399, 'c811e522446b6510fc1b4d2ea04963849bf59916_598802.jpg', '0f460dfa60f487c0b858c036015711a09c5f5683_598802_1.jpg', 'f52b224a2bb56117bd43b45c91c9f038515ac251_598802_2.jpg', 'Smartphone', 'Apple', 'Khaled Zeid', 1),
(7, 'iPad Pro 11', 'Screen type: Liquid Retina display\r\nSupported networks: Wi-Fi\r\nBattery type: lithium polymer battery\r\nBattery capacity: up to 10 hours\r\nNumber of core processing cores: 8-core CPU\r\nScreen protection type: Anti-fingerprint coating / anti-fingerprint glass\r\nProcessor chip type: Apple M2 with 16 Core Neural Engine\r\nCapacity: 128 GB\r\nGeneration / year of release: (iPad Pro) 2022\r\nSystem memory capacity: 8 GB RAM\r\nScreen size: 11 inches\r\nOperating system: iPadOS 16\r\nColor: silver', 2132, '03ac199e834440eb8dd192f4a1789ba07a0f6d24_598750.jpg', '0ad54c6615423dfa35d82e37b58286451bcbbf55_598750_1.jpg', 'fdf4e82606b0164e6f5f54674304b376a8f6a608_598750_2.jpg', 'Smartphone', 'Apple', 'Khaled Zeid', 1),
(8, 'Samsung Galaxy Tab S8 Ultra', 'Screen type: Super AMOLED capacitive touch screen\r\nSupported networks: 5G\r\nBattery type: lithium polymer battery\r\nBattery capacity: 11200 mAh\r\nConnectivity: Yes\r\nSIM type: Nano SIM (small).\r\nNumber of core processing centers: eight cores\r\nNumber of SIMs supported: 1 SIM\r\nChipset Type: Qualcomm SM8450 Snapdragon 8 Gen\r\nPorts: USB-C (3.2)/3.5 mm Connector\r\nCapacity: 128 GB\r\nGeneration / year of release: 2022\r\nSystem memory capacity: 8 GB RAM\r\nOperating system: Android 12', 1120, '8f450c19d12dd7d253489e29f19f305164359883_585573.jpg', '44d7eb349305fc0b6068af8e39baf641cd0570ec_585573_1.jpg', '636204a8df362d13cd1b5858a1f4d7a362bb3db5_585550.jpg', 'Smartphone', 'Samsung', 'Khaled Zeid', 1),
(9, 'Samsung Odyssey G7', 'Screen resolution: 2560 x 1440 (WQHD)\r\nAttachment color: black\r\nWidth: 710.10 mm ( 27.96 in ).\r\nDepth: 305.90 mm ( 12.04 in ).\r\nHeight: 594.50 mm ( 23.41 in ).\r\nPower source: 240 volts - 100\r\nScreen type: curved\r\nTilt feature: yes\r\nWeight: 8.20 kg\r\nBrightness: 600 cd/m2\r\nRefresh rate: 240 Hz\r\nProduct type: game screen\r\nConnectivity Ports: HDMI/DisplayPort/USB 3.0/USB Hub/Headphone Jack\r\nShipping weight: 28.5 lbs', 679, '552096.jpg', '552096_1.jpg', '552096_2.jpg', 'Television', 'Samsung', 'Developer', 2),
(10, 'Samsung Odyssey G5', 'Screen size: 32 inches\r\nAttachment color: black\r\nWidth: 710.10 mm ( 27.96 in ).\r\nDepth: 272.60 mm ( 10.73 in ).\r\nHeight: 533.60 mm ( 21.01 in ).\r\nPower source: 240 volts - 100\r\nScreen type: WQHD curved\r\nSpecial Features: AMD FreeSync\r\nWeight: 5.70 kg ( 12.57 lb ).\r\nBacklight: LED\r\nProduct Type: Game Monitor\r\nConnection ports: HDMI/DisplayPort\r\nResponse time: 1ms (MPRT)\r\nShipping weight: 18.15 lbs', 373, 'c8d9ddc1decc353155b8883a50d239bea244d05f_585577.jpg', '552096_2.jpg', '14ff00fc1fa9a7ac138ff378bd17d0912ccaf9de_585577_1.jpg', 'Television', 'Samsung', 'Developer', 2),
(11, 'LG Ultra Gear 48&#34;', 'Speakers: 10W x Built-in Dual Speaker 2\r\nScreen size: 48 inches\r\nAttachment color: black\r\nWidth: 107.06 cm ( 3.51 ft ).\r\nDepth: 184.80 mm ( 7.28 in ).\r\nHeight: 659.70 mm ( 25.97 in ).\r\nScreen type: 4K Ultra HD\r\nPixel pitch: 0.274mm x 0.274mm\r\nWeight: 16.80 kg ( 37.04 lb ).\r\nBrightness: 330 cd/m2\r\nRefresh rate: 120 Hz\r\nProduct type: gaming screen\r\nConnectivity Ports: HDMI/DisplayPort/USB-B/USB-A/Audio Out\r\nShipping weight is 41.34', 1279, 'a325a8f67c9330123b71d646f569d8d155b19f99_598170.jpg', '05ee19b4a6bd8293c80fda718f2452cd35058171_598170_1.jpg', '9123a71a88b10fa2829d2a5d0389446c7cbbd619_598170_2.jpg', 'Television', 'LG', 'Developer', 2);

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
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `title`, `subtitle`, `status`, `image`, `background`, `created_by`, `created_at`) VALUES
(1, 'Khaled Zeid', 'Software engineer by day tech YouTube by night.', 6, 'owner_avatar_male_man_icon.png', 'home-bg.png', 1, '2023-08-15 18:25:03'),
(2, 'Developer', 'The website developer\'s marketplace is 24/7.', 3, 'avatar_geisha_japanese_woman_icon.png', 'home-bg-4.jpg', 2, '2023-08-15 19:02:32'),
(3, 'User', 'The website user&#39;s marketplace is 24/7.', 0, 'avatar_male_man_portrait_icon.png', 'home-bg-1.png', 3, '2023-08-16 10:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `title`, `subtitle`, `date`, `image`, `background`, `icon`) VALUES
(1, 'النظام', 'رؤية معلومات النظام', '2023-08-10', 'owner_avatar_male_man_icon.png', 'home-bg.png', 'bag_shopping_store_shop_icon.ico');

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
(2, 'developer', 'developer@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(3, 'user', 'user@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(4, 'customer', 'customer@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(5, 'client', 'client@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d');

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
  `image` varchar(100) NOT NULL,
  `store` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
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
-- Indexes for table `banner`
--
ALTER TABLE `banner`
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
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
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
-- Indexes for table `order_store`
--
ALTER TABLE `order_store`
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
-- Indexes for table `system`
--
ALTER TABLE `system`
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
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_store`
--
ALTER TABLE `order_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
