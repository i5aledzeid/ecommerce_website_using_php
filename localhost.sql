-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 24, 2023 at 07:55 PM
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
CREATE DATABASE IF NOT EXISTS `id21113871_shopy` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id21113871_shopy`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'i5aledzeid', 'i5aledzeid@gmail.com', '7239e5187ddaca70eb2b4b8c1b169d7ba43a1808', '1996-06-09 16:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` int(11) NOT NULL,
  `tid` bigint(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_transfers`
--

INSERT INTO `bank_transfers` (`id`, `tid`, `title`, `subtitle`, `price`, `image`, `note`, `status`, `created_by`, `created_at`) VALUES
(1, 65286242230, 'Title', 'Subtitle', 666.00, 'DTAaA3hVwAAZW34.jpg', 'No note!', 0, 1, '2023-08-19 18:49:16'),
(2, 99504363131, 'Title', 'Subtitle', 25200.00, 'download (1).png', 'No Note!', 0, 3, '2023-08-21 10:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title_1` varchar(255) NOT NULL,
  `title_2` varchar(255) NOT NULL,
  `title_3` varchar(255) NOT NULL,
  `title_4` varchar(255) NOT NULL,
  `subtitle_1` text NOT NULL,
  `subtitle_2` varchar(255) NOT NULL,
  `subtitle_3` text NOT NULL,
  `subtitle_4` text NOT NULL,
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

INSERT INTO `banner` (`id`, `title_1`, `title_2`, `title_3`, `title_4`, `subtitle_1`, `subtitle_2`, `subtitle_3`, `subtitle_4`, `image_1`, `image_2`, `image_3`, `image_4`, `status`, `created_by`, `created_at`) VALUES
(1, 'Banner Title 1', 'Banner Title 2', 'Banner Title 3', 'Banner Title 4', 'Banner Subtitle 1', 'Banner Subtitle 2', 'Banner Subtitle 3', 'Banner Subtitle 4', 'home-bg.png', 'home-bg-1.jpg', 'home-bg-5.jpg', 'home-bg-8.jpg', 0, 1, '2023-08-11'),
(2, 'Banner Title 1', 'Banner Title 2', 'Banner Title 3', 'Banner Title 4', 'Banner Subtitle 1', 'Banner Subtitle 2', 'Banner Subtitle 3', 'Banner Subtitle 4', 'cover_635622410d6933-43493776-58945343.jpg', 'home-bg-1.jpg', 'home-bg-5.jpg', 'home-bg-8.jpg', 0, 1, '2023-08-11'),
(3, 'Banner Title 1', 'Banner Title 2', 'Banner Title 3', 'Banner Title 4', 'Banner Subtitle 1', 'Banner Subtitle 2', 'Banner Subtitle 3', 'Banner Subtitle 4', 'home-bg.png', 'home-bg-1.jpg', 'home-bg-5.jpg', 'home-bg-8.jpg', 0, 1, '2023-08-11');

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
(1, 'Apple', 'Apple Inc. is an American multinational technology company headquartered in Cupertino, California. Apple is the world\'s largest technology company by revenue, with US$394.3 billion in 2022 revenue. As of March 2023, Apple is the world\'s biggest company by market capitalization.', 'apple', 'apple_icon.png', '2023-08-05'),
(2, 'LG', 'LG Corporation, known as LG and formerly Lucky-Goldstar from 1983 to 1995, is a South Korean multinational conglomerate founded by Koo In-hwoi and managed by successive generations of his family. It is the fourth-largest chaebol in South Korea.', 'lg', 'lg_icon.png', '2023-08-05'),
(3, 'Samsung', 'Samsung is committed to complying with local laws and regulations as well as applying a strict global code of conduct to all employees. It believes that ethical management is not only a tool for responding to the rapid changes in the global business environment, but also a vehicle for building trust with its various stakeholders including customers, shareholders, employees, business partners and local communities.', 'samsung', 'samsung_icon.png', '2023-08-05'),
(4, 'Nike', 'Nike, Inc. is an American athletic footwear and apparel corporation headquartered near Beaverton, Oregon, United States. It is the world\'s largest supplier of athletic shoes and apparel and a major manufacturer of sports equipment, with revenue in excess of US$46 billion in its fiscal year 2022.', 'nike', 'nike_icon.png', '2023-08-05'),
(5, 'Puma', 'Puma SE is a German multinational corporation that designs and manufactures athletic and casual footwear, apparel and accessories, headquartered in Herzogenaurach, Bavaria, Germany. Puma is the third largest sportswear manufacturer in the world. The company was founded in 1948 by Rudolf Dassler.', 'puma', 'puma_animal_shoes_clothes_sport_icon.png', '2023-08-05'),
(6, 'Hewlett Packard', 'Puma SE is a German multinational corporation that designs and manufactures athletic and casual footwear, apparel and accessories, headquartered in Herzogenaurach, Bavaria, Germany. Puma is the third largest sportswear manufacturer in the world. The company was founded in 1948 by Rudolf Dassler.', 'hp', 'hp_icon.png', '2023-08-05');

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
(1, 'Laptop', 'A portable microcomputer having its main components (such as processor, keyboard, and display screen) integrated into a single unit capable of battery-powered operation.', 'laptop', 'icon-1.png', '2023-08-06'),
(2, 'Television', 'A system for converting visual images (with sound) into electrical signals, transmitting them by radio or other means, and displaying them electronically on a screen.', 'television', 'icon-2.png', '2023-08-06'),
(3, 'Camera', 'A device for recording visual images in the form of photographs, film, or video signals.', 'camera', 'icon-3.png', '2023-08-06'),
(4, 'Mouse', 'A small handheld device which is moved across a mat or flat surface to move the cursor on a computer screen.', 'mouse', 'icon-4.png', '2023-08-06'),
(5, 'Fridge', 'Fridge is short for refrigerator, that giant kitchen appliance that keeps food cold.', 'fridge', 'icon-5.png', '2023-08-06'),
(6, 'Washing Machine', 'A machine for washing clothes, sheets, and other things made of cloth.', 'washing', 'icon-6.png', '2023-08-06'),
(7, 'Smartphone', 'A mobile phone that performs many of the functions of a computer, typically having a touchscreen interface, internet access, and an operating system capable of running downloaded apps.', 'smartphone', 'icon-7.png', '2023-08-06'),
(8, 'Watch', 'A small timepiece worn typically on a strap on one\'s wrist.', 'watch', 'icon-8.png', '2023-08-06'),
(9, 'Real Estate', 'Real estate is property consisting of land and the buildings on it, along with its natural resources such as growing crops (eg. timber), minerals or water, and wild animals;', 'real_estate', 'icon-9.png', '2023-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pid`, `comment`, `created_by`, `created_at`) VALUES
(1, 1, 'This is a wonderful laptop as perfect products from apple.', 3, '2023-08-24 14:39:11'),
(2, 1, 'I like all products from apple.', 2, '2023-08-24 14:41:07'),
(3, 1, 'Thank you so much for your comments.', 1, '2023-08-24 14:42:45'),
(4, 1, 'High quality as expected.', 4, '2023-08-24 15:24:33'),
(5, 1, 'Apple products are great as always.', 5, '2023-08-24 15:25:34'),
(6, 1, 'We are continuing to develop the feedback system.\r\nWe would also like to inform you that comments contribute to the development of the site and the services it provides.', 1, '2023-08-24 16:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

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
(1, 'deliveries', '1004039239', 'deliveries@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 0, '2023-08-16'),
(2, 'delivery', '0582350407', 'delivery@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 0, '2023-08-18');

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
-- Table structure for table `real_estates`
--

CREATE TABLE `real_estates` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `image_04` varchar(255) NOT NULL,
  `image_05` varchar(255) NOT NULL,
  `image_06` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `real_estates`
--

INSERT INTO `real_estates` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `image_04`, `image_05`, `image_06`, `map`, `category`, `brand`, `created_by`, `sid`) VALUES
(1, 'real estate 1', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 76574, 'bigsmall_Mirvac_house2_twgogv.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'https://goo.gl/maps/CBaBKAJmE3kie73K9', 'Real Estate', 'Saudi Arabia', 'realestate', 6),
(2, 'real estate 2', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 5443, 'photo-1564013799919-ab600027ffc6.jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'photo-1564013799919-ab600027ffc6.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'https://goo.gl/maps/CBaBKAJmE3kie73K9', 'Real Estate', 'Saudi Arabia', 'realestate', 6),
(3, 'real estate 3', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 45435, 'iStock_185930591-scaled.jpg.optimal.jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'images (3).jpg', 'images (2).jpg', 'images (1).jpg', 'images (1).jpg', 'https://goo.gl/maps/CBaBKAJmE3kie73K9', 'Real Estate', 'Saudi Arabia', 'realestate', 6),
(4, 'real estate 4', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 9876, 'images (3).jpg', 'images (2).jpg', 'bigsmall_Mirvac_house2_twgogv.jpg', 'iStock_185930591-scaled.jpg.optimal.jpg', 'images (1).jpg', 'images (2).jpg', 'https://goo.gl/maps/CBaBKAJmE3kie73K9', 'Real Estate', 'Afghanistan', 'realestate', 6);

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
(3, 'User', 'The website user&#39;s marketplace is opened 24/7.', 0, 'avatar_male_man_portrait_icon.png', 'home-bg-1.png', 3, '2023-08-16 10:58:53'),
(6, 'realestate', 'The website real estate\'s marketplace is 24/7.', 7, 'builder_helmet_worker_icon.png', 'home-bg-1.png', 6, '2023-08-23 14:58:19');

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
(5, 'client', 'client@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(6, 'realestate', 'realestate@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d');

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
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
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
-- Indexes for table `real_estates`
--
ALTER TABLE `real_estates`
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
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `real_estates`
--
ALTER TABLE `real_estates`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
