-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 09:15 AM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `bar_code` varchar(255) NOT NULL,
  `tax` int(100) NOT NULL,
  `product_image` blob NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='products added to the system';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `bar_code`, `tax`, `product_image`, `year`, `month`, `day`) VALUES
(20, 'gala', 200, 'fgnghjgnk', 5, '', '24', '01', '18'),
(21, 'gala', 400, 'gkkjitjihjkhjihm', 30, '', '24', '01', '18'),
(23, 'sweet', 200, 'fjghjjgggkgkg', 20, '', '24', '01', '18'),
(25, 'chin chin', 100, 'ghghghghghg', 10, '', '24', '01', '18'),
(26, 'dry gin', 1500, 'ghggigjgogjgugkg', 200, '', '24', '01', '18'),
(27, 'goya oil', 2000, 'fighughnffjhuu', 120, '', '24', '01', '18'),
(29, 'action bitters', 400, 'kgnhuugnguggug', 10, '', '24', '01', '18'),
(30, 'flash drive', 3400, 'bbbbbbbbfgggg', 200, '', '24', '01', '19'),
(31, 'kettle', 3400, 'fgnghjgnkr', 120, '', '24', '01', '22');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(255) NOT NULL,
  `product_infor` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_infor`)),
  `total` bigint(255) NOT NULL,
  `trans_id` bigint(11) NOT NULL,
  `change_element` bigint(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='all sales made';

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_infor`, `total`, `trans_id`, `change_element`, `payment_mode`, `year`, `month`, `day`) VALUES
(21, '{\"25\":{\"name\":\"chin chin\",\"price\":110,\"quantity\":1},\"21\":{\"name\":\"gala\",\"price\":430,\"quantity\":1},\"30\":{\"name\":\"flash drive\",\"price\":3600,\"quantity\":1},\"29\":{\"name\":\"action bitters\",\"price\":410,\"quantity\":1},\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1},\"23\":{\"name\":\"sweet\",\"price\":220,\"quantity\":1}}', 6470, 74878517, 330, 'cash', '24', '01', '19'),
(22, '{\"21\":{\"name\":\"gala\",\"price\":430,\"quantity\":1},\"20\":{\"name\":\"gala\",\"price\":205,\"quantity\":1},\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1},\"27\":{\"name\":\"goya oil\",\"price\":2120,\"quantity\":1}}', 4455, 50728386, 100, 'transfer', '24', '01', '19'),
(23, '{\"30\":{\"name\":\"flash drive\",\"price\":3600,\"quantity\":1}}', 3600, 65438415, 0, 'card', '24', '01', '19'),
(24, '{\"21\":{\"name\":\"gala\",\"price\":430,\"quantity\":1},\"23\":{\"name\":\"sweet\",\"price\":220,\"quantity\":1}}', 650, 27034144, 500, 'cash', '24', '01', '20'),
(25, '{\"20\":{\"name\":\"gala\",\"price\":205,\"quantity\":1},\"25\":{\"name\":\"chin chin\",\"price\":110,\"quantity\":1},\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1},\"30\":{\"name\":\"flash drive\",\"price\":3600,\"quantity\":1}}', 5615, 90039299, 250, 'cash', '24', '01', '21'),
(26, '{\"30\":{\"name\":\"flash drive\",\"price\":3600,\"quantity\":1},\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1}}', 5300, 52730129, 200, 'cash', '24', '01', '21'),
(27, '{\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1}}', 1700, 55321094, 300, 'cash', '24', '01', '21'),
(28, '{\"26\":{\"name\":\"dry gin\",\"price\":1700,\"quantity\":1}}', 1700, 28260103, 300, 'cash', '24', '01', '21'),
(29, '{\"25\":{\"name\":\"chin chin\",\"price\":110,\"quantity\":1},\"29\":{\"name\":\"action bitters\",\"price\":410,\"quantity\":1}}', 520, 98061048, 80, 'cash', '24', '01', '21'),
(30, '{\"29\":{\"name\":\"action bitters\",\"price\":410,\"quantity\":1}}', 410, 95520388, 40, 'cash', '24', '01', '21'),
(31, '{\"31\":{\"name\":\"kettle\",\"price\":3520,\"quantity\":2},\"23\":{\"name\":\"sweet\",\"price\":220,\"quantity\":1},\"25\":{\"name\":\"chin chin\",\"price\":110,\"quantity\":1},\"20\":{\"name\":\"gala\",\"price\":205,\"quantity\":1}}', 7575, 64889463, 25, 'cash', '24', '01', '22'),
(32, '{\"20\":{\"name\":\"gala\",\"price\":205,\"quantity\":1}}', 205, 35472976, 0, 'transfer', '24', '01', '22'),
(33, '{\"20\":{\"name\":\"gala\",\"price\":205,\"quantity\":1},\"21\":{\"name\":\"gala\",\"price\":430,\"quantity\":1}}', 635, 50313013, 0, 'card', '24', '01', '22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
