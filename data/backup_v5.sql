-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 10:41 PM
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
  `category_name` varchar(50) NOT NULL,
  `is_categ_active` enum('YES','NO') NOT NULL DEFAULT 'YES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `is_categ_active`) VALUES
(1, 'Tiles', 'YES'),
(2, 'Stone', 'YES'),
(3, 'Construction Materials', 'YES'),
(4, 'Food', 'YES'),
(5, 'Electronics', 'YES'),
(6, 'Video Games', 'YES'),
(8, 'Furniture', 'YES'),
(10, 'Clothing', 'YES'),
(11, 'Toys', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `is_active` enum('YES','NO') NOT NULL DEFAULT 'YES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `supplier_id`, `product_quantity`, `product_price`, `is_active`) VALUES
(1, 'Ceramic Floor Tile 30x30', 1, 1, 400, 45.00, 'YES'),
(2, 'Porcelain Wall Tile 20x40', 1, 2, 360, 65.00, 'YES'),
(3, 'Mosaic Tile Sheet', 1, 3, 155, 120.00, 'YES'),
(4, 'Granite Slab 60x60', 1, 1, 32, 70.00, 'YES'),
(5, 'Chocop', 2, 1, 2170, 1.50, 'YES'),
(6, 'Cement Bag 50kg', 3, 1, 1000, 70.00, 'YES'),
(7, 'Genova', 4, 5, 150, 2.00, 'YES'),
(8, 'Grout Powder White 10kg', 3, 5, 600, 55.00, 'YES'),
(9, 'Electric Tile Cutter', 4, 6, 100, 12.00, 'YES'),
(10, 'Rubber Mallet', 4, 6, 50, 75.00, 'YES'),
(11, 'Danone', 4, 3, 495, 2.00, 'YES'),
(12, 'Merandina', 2, 5, 450, 2.50, 'YES'),
(15, 'Brick', 2, 2, 350, 5.50, 'YES'),
(16, 'Minecraft', 6, 6, 147, 1750.00, 'YES'),
(17, 'Saw', 3, 6, 784, 250.00, 'YES'),
(22, 'Raibi', 4, 3, 195, 75.00, 'YES'),
(23, 'reza', 4, 5, 147, 86.00, 'YES'),
(24, 'Jebes', 3, 3, 475, 34.00, 'YES');

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
(1, 2, 100, 'IN', '2025-09-29 18:00:00'),
(3, 3, 30, 'IN', '2025-09-29 18:00:00'),
(5, 5, 1880, 'IN', '2025-07-24 20:24:00'),
(6, 1, 20, 'OUT', '2025-09-29 18:00:00'),
(8, 11, 5, 'OUT', '2025-09-29 18:00:00'),
(10, 5, 1, 'OUT', '2025-09-29 18:00:00'),
(11, 10, 50, 'OUT', '2025-10-14 20:36:00'),
(12, 23, 100, 'IN', '2025-10-14 20:36:00'),
(13, 22, 5, 'OUT', '2025-10-14 20:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_phone` varchar(20) DEFAULT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `is_supp_active` enum('YES','NO') NOT NULL DEFAULT 'YES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_email`, `supplier_phone`, `supplier_address`, `is_supp_active`) VALUES
(1, 'Sonajib', 'sonajib@gmail.com', '+212614785692', 'Rachad, Morocco', 'YES'),
(2, 'StoneWorld Ltd.', 'sales@stoneworld.com', '+212600222222', 'Marrakech, Morocco', 'YES'),
(3, 'MosaicArt Supplies', 'info@mosaicart.com', '+212600333333', 'Rabat, Morocco', 'YES'),
(5, 'El Maraii', 'orders@elmaraii.com', '+212600555555', 'Mekness, Morocco', 'YES'),
(6, 'ProTools Morocco', 'service@protools.com', '+212600666666', 'Agadir, Morocco', 'YES'),
(7, 'Aqua', 'aqua@gmail.com', '0658479612', 'Casablanca, Morocco', 'YES'),
(8, 'coca', 'coca@gmail.com', '0514785962', 'Tanger, Morocco', 'YES'),
(9, 'Marjane', 'marjane@email.com', '0658974125', 'Sapino, Deroua', 'YES'),
(10, 'pepsi', 'pepsi@gmail.com', '0658479612', 'Marrakech, Morocco', 'YES');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `stock_movement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
