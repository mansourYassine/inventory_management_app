-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 08:09 PM
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
-- Database: `inventory_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(3, 'Construction Materials'),
(2, 'Stone'),
(1, 'Tiles'),
(4, 'Tools');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `supplier_id`, `product_quantity`, `product_price`) VALUES
(1, 'Ceramic Floor Tile 30x30', 1, 1, 500, 45.00),
(2, 'Porcelain Wall Tile 20x40', 1, 2, 300, 65.00),
(3, 'Mosaic Tile Sheet', 1, 3, 150, 120.00),
(4, 'Granite Slab 60x60', 2, 1, 80, 350.00),
(5, 'Marble Countertop', 2, 2, 40, 750.00),
(6, 'Cement Bag 50kg', 3, 4, 1000, 70.00),
(7, 'Tile Adhesive 25kg', 3, 4, 400, 95.00),
(8, 'Grout Powder White 10kg', 3, 5, 600, 55.00),
(9, 'Electric Tile Cutter', 4, 6, 25, 1200.00),
(10, 'Rubber Mallet', 4, 6, 100, 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `stock_movement_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `movement_quantity` int(11) NOT NULL,
  `movement_type` enum('IN','OUT') NOT NULL,
  `movement_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`stock_movement_id`, `product_id`, `movement_quantity`, `movement_type`, `movement_date`) VALUES
(1, 1, 100, 'IN', '2025-09-29 18:01:37'),
(2, 2, 50, 'IN', '2025-09-29 18:01:37'),
(3, 3, 30, 'IN', '2025-09-29 18:01:37'),
(4, 4, 20, 'IN', '2025-09-29 18:01:37'),
(5, 5, 10, 'IN', '2025-09-29 18:01:37'),
(6, 1, 20, 'OUT', '2025-09-29 18:01:37'),
(7, 2, 10, 'OUT', '2025-09-29 18:01:37'),
(8, 3, 5, 'OUT', '2025-09-29 18:01:37'),
(9, 4, 2, 'OUT', '2025-09-29 18:01:37'),
(10, 5, 1, 'OUT', '2025-09-29 18:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_phone` varchar(20) DEFAULT NULL,
  `supplier_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_email`, `supplier_phone`, `supplier_address`) VALUES
(1, 'TileMaster Co.', 'contact@tilemaster.com', '+212600111111', 'Casablanca, Morocco'),
(2, 'StoneWorld Ltd.', 'sales@stoneworld.com', '+212600222222', 'Marrakech, Morocco'),
(3, 'MosaicArt Supplies', 'info@mosaicart.com', '+212600333333', 'Rabat, Morocco'),
(4, 'BuildStrong Materials', 'support@buildstrong.com', '+212600444444', 'Tangier, Morocco'),
(5, 'GroutPro', 'orders@groutpro.com', '+212600555555', 'Fes, Morocco'),
(6, 'ProTools Morocco', 'service@protools.com', '+212600666666', 'Agadir, Morocco');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`stock_movement_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`),
  ADD UNIQUE KEY `supplier_email` (`supplier_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `stock_movement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
