-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 01:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_config`
--

CREATE TABLE `admin_config` (
  `id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Admin login configurations';

--
-- Dumping data for table `admin_config`
--

INSERT INTO `admin_config` (`id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', '$2y$10$wuyPz1Y3ezWqa5183p5ejudipMYF0IGROWTjHTovotZp5/Qgoj0pG');

-- --------------------------------------------------------

--
-- Table structure for table `cashier_infor`
--

CREATE TABLE `cashier_infor` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cashier_id` varchar(100) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='cashier''s information';

--
-- Dumping data for table `cashier_infor`
--

INSERT INTO `cashier_infor` (`id`, `name`, `gender`, `cashier_id`, `timestamp`) VALUES
(1, 'blessing h.', 'f', '1000', '2024-03-15 14:06:59.936284'),
(2, 'emmanuel c.', 'm', '2000', '2024-03-15 14:07:08.043973'),
(5, 'Ella w.', 'f', '3000', '2024-03-16 09:27:52.829906');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` int(255) NOT NULL,
  `distributor_name` varchar(100) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='distributors ';

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `distributor_name`, `reg_no`, `address`, `timestamp`) VALUES
(26, 'simple mart', 'cca2334', 'ajah lagos', '2024-03-10 19:53:44.070719'),
(29, 'kenny holdinds ltd', 'wirur484', 'wuse market Abuja', '2024-03-16 09:28:48.699914'),
(31, 'kenny holdings', 'nill', 'lokogoma abuja', '2024-04-06 08:29:20.917262');

-- --------------------------------------------------------

--
-- Table structure for table `expiry_config`
--

CREATE TABLE `expiry_config` (
  `id` int(255) NOT NULL,
  `expiry_range` varchar(100) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='time specified for product to rech expiry';

--
-- Dumping data for table `expiry_config`
--

INSERT INTO `expiry_config` (`id`, `expiry_range`, `timestamp`) VALUES
(1, '20', '2024-04-06 05:48:01.000000');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `notification_on` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product detail notificatioon';

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `product_name`, `notification_on`, `message`, `timestamp`) VALUES
(79, 'fish', 'expiry', 'close to expiry', '2024-02-28 16:48:15.268529'),
(80, 'electric kettle', 'expiry', 'close to expiry', '2024-02-28 16:48:15.331373'),
(190, 'food flask', 'expiry', 'close to expiry', '2024-03-02 12:02:34.266184'),
(192, 'bread', 'expiry', 'close to expiry', '2024-03-02 12:05:08.330043'),
(197, 'fanta orange', 'expiry', 'close to expiry', '2024-03-04 10:39:36.870744'),
(199, 'kellogs chips', 'expiry', 'close to expiry', '2024-03-04 11:51:12.778708'),
(200, 'kellogs peanut', 'stock', 'out of stock', '2024-03-04 14:59:51.521001'),
(203, 'molfix diaper', 'stock', 'out of stock', '2024-03-05 11:58:35.741895'),
(205, 'duduosun soap', 'stock', 'out of stock', '2024-03-06 15:14:20.222584'),
(206, 'KFC chicken', 'stock', 'out of stock', '2024-03-08 11:54:41.800598'),
(207, 'vanila icecream', 'stock', 'out of stock', '2024-03-13 11:59:32.326325'),
(208, 'kettle', 'expiry', 'close to expiry', '2024-03-13 16:11:38.520940'),
(209, 'kellogs oat', 'expiry', 'close to expiry', '2024-03-08 16:11:39.070787'),
(210, 'peanut', 'expiry', 'close to expiry', '2024-03-08 16:11:39.418866'),
(211, 'kings oat', 'expiry', 'close to expiry', '2024-03-08 16:11:39.586557'),
(212, 'sweet', 'expiry', 'close to expiry', '2024-03-08 16:11:42.649058'),
(217, 'pizza', 'expiry', 'close to expiry', '2024-03-16 06:50:29.838462'),
(218, 'shawarma', 'expiry', 'close to expiry', '2024-03-20 07:26:29.686173'),
(219, 'lolly pop', 'expiry', 'close to expiry', '2024-04-04 20:05:58.855326'),
(220, 'minimi chinchin', 'expiry', 'close to expiry', '2024-04-05 19:37:44.014498');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `sales_price` bigint(100) NOT NULL,
  `sale_percent` int(255) NOT NULL,
  `purchace_price` bigint(255) NOT NULL,
  `distributor` varchar(255) NOT NULL,
  `bar_code` varchar(255) NOT NULL,
  `tax` int(100) NOT NULL,
  `quantity` int(255) NOT NULL,
  `expiry_year` year(4) NOT NULL,
  `expiry_month` int(50) NOT NULL,
  `expiry_day` int(50) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='products added to the system';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `sales_price`, `sale_percent`, `purchace_price`, `distributor`, `bar_code`, `tax`, `quantity`, `expiry_year`, `expiry_month`, `expiry_day`, `timestamp`) VALUES
(40, 'bread', 1200, 40, 900, 'ali and sons', 'hfhughigkugkg', 100, 57, 2024, 2, 10, '2024-02-01 16:15:38.819264'),
(41, 'sweet', 120, 20, 100, 'ali and sons', 'ffigungugnunm', 230, 220, 2024, 2, 12, '2024-02-01 16:18:38.452743'),
(42, 'fish', 3900, 30, 3000, 'chinedu holdings', 'hfuhugugng', 20, 576, 2024, 2, 10, '2024-02-01 16:33:09.486542'),
(44, 'kettle', 13200, 10, 12000, 'chinedu holdings', 'oiuytsxdcfhjk98765', 150, 28, 2024, 2, 10, '2024-02-07 15:17:56.647818'),
(45, 'electric kettle', 25200, 25, 20000, 'Charles d lmt', 'iuytrewetyui876', 200, 44, 2024, 2, 17, '2024-02-08 16:08:54.507664'),
(46, 'food flask', 12500, 18, 15000, 'Emperors lmt', 'oooooopppp', 100, 336, 2024, 2, 10, '2024-02-08 16:12:16.556519'),
(47, 'fanta orange', 200, 5, 100, 'Iniobong holdings', '1234567890', 50, 320, 2024, 2, 10, '2024-02-08 16:15:26.445166'),
(48, 'kellogs oat', 2000, 30, 1200, 'chinedu holdings', 'pjghuhri04945', 150, 488, 2024, 2, 16, '2024-02-09 11:38:53.468277'),
(49, 'minimi chinchin', 96, 20, 80, 'chinedu holdings', 'uyydfyfhir56764', 9, 44, 2024, 5, 1, '2024-02-09 16:10:42.274980'),
(50, 'peanut', 150, 40, 70, 'ali and sons', 'iuyhtgee5789', 0, 430, 2024, 2, 11, '2024-02-09 16:42:27.042996'),
(51, 'kings oat', 3500, 39, 2500, 'Emperors lmt', 'kings', 100, 661, 2024, 2, 27, '2024-02-12 14:34:09.901415'),
(52, 'kellogs chips', 260, 32, 200, 'Iniobong holdings', 'iuytrewwe57890', 40, 827, 2024, 3, 7, '2024-02-14 15:20:32.710963'),
(55, 'kellogs peanut', 200, 45, 120, 'chinedu holdings', 'o8yrhuryn', 10, -1, 2024, 3, 1, '2024-02-27 13:17:56.663773'),
(56, 'shawarma', 1200, 34, 45, 'Iniobong holdings', 'ekifof', 100, 233, 2024, 4, 9, '2024-02-27 13:21:58.266915'),
(57, 'razor', 50, 23, 332, 'Iniobong holdings', 'wofif', 0, 223, 2034, 3, 14, '2024-02-27 13:35:41.523548'),
(58, 'samosa', 4500, 35, 2700, 'Charles d lmt', 'samosa', 100, 32, 2034, 10, 14, '2024-02-27 13:42:03.066989'),
(59, 'freezed catfish', 1500, 48, 12000, 'Iniobong holdings', 'iuyet56rdum', 100, 1198, 2033, 7, 24, '2024-02-27 15:01:31.737960'),
(62, 'pizza', 1200, 39, 43, 'Alibaba globals', 'kdinf', 50, 35, 2024, 4, 5, '2024-02-28 16:34:43.397889'),
(67, 'vanila icecream', 400, 30, 200, 'Emperors lmt', '3oeiuugg', 50, 1, 2024, 6, 2, '2024-03-08 11:59:24.253812'),
(68, 'Electric kettle', 36000, 20, 30000, 'simple mart', 'kjhgftgfdgfk', 0, 116, 2048, 2, 20, '2024-03-22 07:17:31.893411'),
(69, 'bottle honey 3g', 2400, 25, 2000, 'kenny holdinds ltd', 'hhh', 200, 291, 2030, 6, 14, '2024-04-03 16:33:37.420781'),
(70, 'bottle water 50cl', 2500, 25, 2000, 'kenny holdinds ltd', 'br', 0, 187, 2044, 5, 14, '2024-04-03 20:04:15.041462'),
(71, 'lolly pop', 399, 33, 300, 'simple mart', 'jdhbvhbnm', 1, 19, 2024, 4, 10, '2024-04-04 20:05:49.819620'),
(72, 'groundnut', 450, 50, 300, 'simple mart', 'gr', 0, 98, 2027, 2, 2, '2024-04-05 07:58:38.592512'),
(73, 'rose flower', 15000, 25, 12000, 'kenny holdinds ltd', 'r34ee', 0, 99, 2031, 3, 4, '2024-04-05 08:04:12.100616');

-- --------------------------------------------------------

--
-- Table structure for table `quantity_config`
--

CREATE TABLE `quantity_config` (
  `id` int(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product quantity to alert for restocking';

--
-- Dumping data for table `quantity_config`
--

INSERT INTO `quantity_config` (`id`, `quantity`, `timestamp`) VALUES
(1, 12, '2024-04-05 13:04:09.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(255) NOT NULL,
  `product_infor` varchar(9000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `total_naira` bigint(255) NOT NULL,
  `trans_id` bigint(11) NOT NULL,
  `change_element` bigint(50) NOT NULL,
  `change_reminant` int(100) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='all sales made';

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_infor`, `total_naira`, `trans_id`, `change_element`, `change_reminant`, `payment_mode`, `ip_address`, `cashier`, `year`, `month`, `day`) VALUES
(66, 'sweet (Quantity: 1, Price: ₦130)', 130, 16903614, 0, 0, 'transfer', '105.112.120.12', 'john amos.', 2023, '2', '17'),
(67, 'bread (Quantity: 1, Price: ₦1,410), sweet (Quantity: 1, Price: ₦130), shoe (Quantity: 6, Price: ₦3,920), sugar (Quantity: 1, Price: ₦600)', 6060, 16314011, 0, 0, 'transfer', '', 'Loveth adams', 2024, '2', '20'),
(68, 'kings oat (Quantity: 1, Price: ₦3,575)', 17800, 68745496, 200, 0, 'cash', '', 'Loveth adams', 2024, '2', '20'),
(71, 'fish (Quantity: 4, Price: ₦3,920)', 3920, 66452494, 80, 0, 'cash', '105.112.234.184', 'Loveth adams', 2024, '2', '21'),
(72, 'kings oat (Quantity: 1, Price: ₦3,575)', 3575, 21195106, 0, 0, 'cash', '105.112.121.51', 'Loveth adams', 2024, '2', '21'),
(73, 'peanut (Quantity: 15, Price: ₦98), kings oat (Quantity: 1, Price: ₦3,575), kellogs chips (Quantity: 3, Price: ₦289)', 3962, 12783862, 0, 0, 'transfer', '105.112.121.51', 'Loveth adams', 2024, '2', '21'),
(74, 'bread (Quantity: 30, Price: ₦1,410), sweet (Quantity: 3, Price: ₦130), peanut (Quantity: 3, Price: ₦130)', 1540, 87385867, 60, 0, 'cash', '', 'Loveth adams', 2024, '2', '21'),
(75, 'sweet (Quantity: 3, Price: ₦130), minimi chinchin (Quantity: 8, Price: ₦105)', 235, 68668770, 0, 0, 'transfer', '', 'Gideon whales', 2024, '2', '21'),
(76, 'electric kettle (Quantity: 1, Price: ₦25,100), food flask (Quantity: 2, Price: ₦17,800), egg (Quantity: 3, Price: ₦105), bread (Quantity: 2, Price: ₦1,410)', 43005, 12187240, 0, 0, 'card', '', 'Gideon whales', 2024, '2', '21'),
(77, 'fanta orange (Quantity: 2, Price: ₦105)', 210, 15589031, 0, 0, 'cash', '', 'Gideon whales', 2024, '2', '21'),
(78, 'fanta orange (Quantity: 4, Price: ₦105)', 315, 71303798, 0, 0, 'transfer', '', 'Gideon whales', 2024, '2', '21'),
(81, 'fish (Quantity: 4, Price: ₦3,920)', 7840, 71748949, 60, 0, 'cash', '', 'Gideon whales', 2024, '2', '21'),
(82, 'samosa (Quantity: 1, Price: ₦3,920)', 3920, 87106846, 0, 0, 'transfer', '', 'Gideon whales', 2024, '2', '21'),
(83, 'kings oat (Quantity: 5, Price: ₦3,575)', 7150, 88405850, 0, 0, 'cash', '', 'Gideon whales', 2024, '2', '21'),
(84, 'kings oat (Quantity: 1, Price: ₦3,575)', 3575, 40321168, 0, 0, 'transfer', '', 'john amos.', 2024, '2', '21'),
(85, 'kings oat (Quantity: 3, Price: ₦3,575)', 3575, 93169313, 0, 0, 'cash', '105.112.113.178', 'john amos.', 2024, '2', '21'),
(86, 'fanta orange (Quantity: 1, Price: ₦105), kellogs oat (Quantity: 1, Price: ₦1,660)', 1765, 49316435, 0, 0, 'card', '', 'john amos.', 2024, '2', '22'),
(88, 'kellogs oat (Quantity: 5, Price: ₦1,660), electric kettle (Quantity: 1, Price: ₦25,100), razor (Quantity: 1, Price: ₦100)', 26760, 64524442, 40, 0, 'cash', '', 'Favour steve', 2024, '2', '22'),
(89, 'razor (Quantity: 1, Price: ₦431), samosa (Quantity: 12, Price: ₦3,715), freezed catfish (Quantity: 1, Price: ₦18,010)', 22156, 17622566, 0, 0, 'cash', '', 'Favour steve', 2024, '2', '27'),
(90, 'electric kettle (Quantity: 1, Price: ₦25,100)', 25100, 39205149, 0, 0, 'card', '', 'Favour steve', 2024, '3', '1'),
(95, 'bread (Quantity: 1, Price: ₦1,410), kettle (Quantity: 1, Price: ₦13,350), electric kettle (Quantity: 1, Price: ₦25,001), fanta orange (Quantity: 1, Price: ₦105)', 39866, 95205736, 0, 0, 'transfer', '', 'Favour steve', 2024, '3', '5'),
(96, 'molfix diaper (Quantity: 11, Price: ₦4,295)', 47245, 27902763, 0, 0, 'cash', '', 'Favour steve', 2024, '3', '5'),
(97, 'bread (Quantity: 1, Price: ₦1,410), kettle (Quantity: 1, Price: ₦13,350)', 14760, 14161347, 40, 0, 'cash', '', 'Favour steve', 2024, '3', '6'),
(98, 'smoked fish (Quantity: 2, Price: ₦2,520)', 5040, 74802558, 0, 0, 'transfer', '', 'Favour steve', 2024, '3', '6'),
(99, 'bread (Quantity: 1, Price: ₦1,410), sweet (Quantity: 1, Price: ₦350), fish (Quantity: 1, Price: ₦3,920)', 30681, 24075298, 20, 0, 'cash', '', 'Favour steve', 2024, '3', '6'),
(100, 'bread (Quantity: 1, Price: ₦1,410), fish (Quantity: 1, Price: ₦3,920), peanut (Quantity: 1, Price: ₦98), shawarma (Quantity: 1, Price: ₦120), kellogs chips (Quantity: 1, Price: ₦280), minimi chinchin (Quantity: 2, Price: ₦105)', 30681, 61708975, 0, 0, 'cash', '', 'Favour steve', 2024, '3', '8'),
(101, 'bread (Quantity: 2, Price: ₦1,350), sweet (Quantity: 1, Price: ₦350)', 30681, 54067603, 50, 0, 'cash', '', 'Favour steve', 2024, '3', '8'),
(102, 'bread (Quantity: 2, Price: ₦1,350), sweet (Quantity: 1, Price: ₦350)', 30681, 38507004, 0, 0, 'cash', '', 'Favour steve', 2024, '3', '8'),
(103, 'bread (Quantity: 2, Price: ₦1,350), sweet (Quantity: 1, Price: ₦350)', 30681, 97047501, 555, 0, 'transfer', '', 'john amos.', 2024, '3', '8'),
(104, 'bread (Quantity: 1, Price: ₦1,350), sweet (Quantity: 1, Price: ₦350), fish (Quantity: 3, Price: ₦3,920)', 30681, 35943568, 40, 0, 'cash', '', 'john amos.', 2024, '3', '8'),
(105, 'fish (Quantity: 2, Price: ₦3,920), sweet (Quantity: 1, Price: ₦350)', 8190, 49531723, 0, 0, 'cash', '', 'john amos.', 2024, '3', '8'),
(106, 'KFC chicken (Quantity: 2, Price: ₦1,780)', 3560, 37432321, 40, 0, 'cash', '', 'john amos.', 2024, '3', '8'),
(107, 'vanila icecream (Quantity: 1, Price: ₦300)', 300, 85047577, 200, 0, 'cash', '', 'john amos.', 2024, '3', '8'),
(108, 'vanila icecream (Quantity: 2, Price: ₦300)', 600, 34509880, 0, 0, 'cash', '', 'john amos.', 2024, '3', '8'),
(109, 'vanila icecream (Quantity: 2, Price: ₦300), bread (Quantity: 1, Price: ₦1,350)', 1950, 68327523, 50, 0, 'transfer', '', 'Grace Akanem.', 2024, '3', '8'),
(110, 'vanila icecream (Quantity: 2, Price: ₦300), bread (Quantity: 1, Price: ₦1,350), peanut (Quantity: 2, Price: ₦98)', 2146, 41838365, 0, 0, 'card', '', 'Grace Akanem.', 2024, '3', '8'),
(111, 'peanut (Quantity: 2, Price: ₦98), vanila icecream (Quantity: 2, Price: ₦300)', 796, 80271531, 0, 0, 'cash', '', 'Grace Akanem.', 2024, '3', '8'),
(112, 'vanila icecream (Quantity: 2, Price: ₦300)', 600, 22756355, 0, 0, 'transfer', '', 'Grace Akanem.', 2024, '3', '8'),
(113, 'vanila icecream (Quantity: 2, Price: ₦300), pizza (Quantity: 2, Price: ₦102)', 804, 97850223, 0, 0, 'cash', '', 'Grace Akanem.', 2024, '3', '8'),
(114, 'bread (Quantity: 1, Price: ₦1,350, Total: ₦1,350), sweet (Quantity: 1, Price: ₦350, Total: ₦350), kettle (Quantity: 2, Price: ₦13,350, Total: ₦26,700), food flask (Quantity: 1, Price: ₦12,600, Total: ₦12,600)', 41000, 85908088, 0, 0, 'transfer', '', 'Grace Akanem.', 2024, '3', '9'),
(115, 'kettle (Quantity: 1, Price: ₦13,350, Total: ₦13,350)', 13350, 79716796, 50, 0, 'cash', '', 'Grace Akanem.', 2024, '3', '5'),
(116, 'bread (Quantity: 1, Price: ₦1,350, Total: ₦1,350), sweet (Quantity: 2, Price: ₦350, Total: ₦700)', 2050, 20360143, 0, 0, 'transfer', '', 'Grace Akanem.', 2024, '3', '8'),
(117, 'razor (Quantity: 2, Price: ₦100, Total: ₦200), pizza (Quantity: 2, Price: ₦2,500, Total: ₦5,000)', 5200, 51309496, 0, 0, 'Debit card', '', 'blessing h.', 2024, '3', '9'),
(118, 'pizza (Quantity: 2, Price: ₦2,500, Total: ₦5,000), freezed catfish (Quantity: 1, Price: ₦1,800, Total: ₦1,800), samosa (Quantity: 2, Price: ₦9,200, Total: ₦18,400)', 25200, 50721710, 0, 0, 'transfer', '', 'blessing h.', 2024, '3', '7'),
(119, 'fanta orange (Quantity: 2, Price: ₦140, Total: ₦280), kellogs peanut (Quantity: 2, Price: ₦210, Total: ₦420), samosa (Quantity: 2, Price: ₦4,600, Total: ₦9,200), kellogs oat (Quantity: 3, Price: ₦2,150, Total: ₦6,450), food flask (Quantity: 2, Price: ₦12,600, Total: ₦25,200)', 41550, 69201733, 50, 0, 'cash', '', 'emmanuel c.', 2024, '3', '16'),
(120, 'bread (Quantity: 2, Price: ₦1,300, Total: ₦2,600)', 2600, 15595881, 200, 200, 'cash', '', 'Ella w.', 2024, '3', '18'),
(121, 'bread (Quantity: 2, Price: ₦1,300, Total: ₦2,600), sweet (Quantity: 1, Price: ₦350, Total: ₦350), kettle (Quantity: 2, Price: ₦13,350, Total: ₦26,700)', 29650, 52629834, 0, 0, 'transfer', '', 'emmanuel c.', 2024, '3', '19'),
(122, 'bottle honey 3g (Quantity: 1, Price: ₦2,500, Total: ₦2,500), Electric kettle (Quantity: 1, Price: ₦36,000, Total: ₦36,000)', 38500, 91880973, 500, 0, 'cash', '105.117.128.91', 'emmanuel c.', 2024, '4', '3'),
(123, 'bottle honey 3g (Quantity: 3, Price: ₦2,500, Total: ₦7,500), Electric kettle (Quantity: 1, Price: ₦36,000, Total: ₦36,000)', 43500, 24395494, 0, 0, 'transfer', '105.117.128.91', 'emmanuel c.', 2024, '4', '3'),
(125, 'Electric kettle (Quantity: 1, Price: ₦36,000, Total: ₦36,000)', 36000, 97422560, 0, 0, 'cash', '105.112.124.42', 'blessing h.', 2024, '4', '4'),
(126, 'lolly pop (Quantity: 1, Price: ₦400, Total: ₦400), bottle water 50cl (Quantity: 2, Price: ₦2,500, Total: ₦5,000)', 5400, 88284731, 600, 0, 'cash', '', 'blessing h.', 2024, '4', '5'),
(127, 'kellogs peanut (Quantity: 3, Price: ₦210, Total: ₦630), kellogs chips (Quantity: 5, Price: ₦280, Total: ₦1,400), bottle honey 3g (Quantity: 1, Price: ₦2,600, Total: ₦2,600)', 4630, 67360252, 0, 0, 'transfer', '', 'Ella w.', 2024, '4', '6'),
(128, 'kellogs chips (Quantity: 8, Price: ₦300, Total: ₦2,400), kellogs peanut (Quantity: 3, Price: ₦210, Total: ₦630)', 3030, 22143779, 0, 0, 'cash', '', 'Ella w.', 2024, '4', '6'),
(129, 'kings oat (Quantity: 2, Price: ₦3,600, Total: ₦7,200), samosa (Quantity: 3, Price: ₦4,600, Total: ₦13,800)', 21000, 79747821, 0, 0, 'cash', '', 'Ella w.', 2024, '4', '6'),
(130, 'kings oat (Quantity: 1, Price: ₦3,600, Total: ₦3,600)', 3600, 89598459, 400, 0, 'cash', '', 'Ella w.', 2024, '4', '6'),
(131, 'samosa (Quantity: 3, Price: ₦4,600, Total: ₦13,800)', 13800, 77490425, 200, 0, 'cash', '', 'Ella w.', 2024, '4', '6'),
(132, 'samosa (Quantity: 2, Price: ₦4,600, Total: ₦9,200)', 9200, 56068175, 800, 0, 'cash', '105.112.114.29', 'Ella w.', 2024, '4', '6'),
(133, 'samosa (Quantity: 2, Price: ₦4,600, Total: ₦9,200)', 9200, 80728567, 800, 0, 'cash', '', 'Ella w.', 2024, '4', '6');

-- --------------------------------------------------------

--
-- Table structure for table `udo_list`
--

CREATE TABLE `udo_list` (
  `id` int(255) NOT NULL,
  `product_id` bigint(255) NOT NULL,
  `quantity` bigint(255) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='UDO list | unsold,destroyed or other |';

--
-- Dumping data for table `udo_list`
--

INSERT INTO `udo_list` (`id`, `product_id`, `quantity`, `action`) VALUES
(1, 40, 2, 'unsold'),
(2, 40, 1, 'unsold'),
(3, 40, 1, 'unsold'),
(4, 71, 2, 'other'),
(5, 70, 8, 'destroyed'),
(6, 70, 8, 'destroyed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_config`
--
ALTER TABLE `admin_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashier_infor`
--
ALTER TABLE `cashier_infor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expiry_config`
--
ALTER TABLE `expiry_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantity_config`
--
ALTER TABLE `quantity_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `udo_list`
--
ALTER TABLE `udo_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_config`
--
ALTER TABLE `admin_config`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cashier_infor`
--
ALTER TABLE `cashier_infor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `expiry_config`
--
ALTER TABLE `expiry_config`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `quantity_config`
--
ALTER TABLE `quantity_config`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `udo_list`
--
ALTER TABLE `udo_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
