-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2024 at 02:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwwwwww`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT (now()),
  `updated_at` timestamp NULL DEFAULT (now()),
  `role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `password`, `email`, `phone_number`, `created_at`, `updated_at`, `role`) VALUES
(1, 'John Doe', 'password123', 'john@example.com', '1234567890', '2024-02-07 19:30:00', '2024-02-07 19:30:00', 1),
(2, 'Jane Smith', 'abc123', 'jane@example.com', '9876543210', '2024-02-07 19:31:00', '2024-02-07 19:31:00', 2),
(3, 'Alice Johnson', 'pass456', 'alice@example.com', '5556667777', '2024-02-07 19:32:00', '2024-02-07 19:32:00', 1),
(4, 'Bob Williams', 'test789', 'bob@example.com', '9998887777', '2024-02-07 19:33:00', '2024-02-07 19:33:00', 2),
(5, 'Eve Brown', 'pass123', 'eve@example.com', '1112223333', '2024-02-07 19:34:00', '2024-02-07 19:34:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `product_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `product_id`, `image_path`) VALUES
(1, 1, '/images/product1.jpg'),
(2, 2, '/images/product2.jpg'),
(3, 3, '/images/product3.jpg'),
(4, 4, '/images/product4.jpg'),
(5, 5, '/images/product5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_price` decimal(10,3) NOT NULL,
  `total_price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `customer_id`, `product_id`, `product_price`, `total_price`) VALUES
(1, 1, 1, '10.990', '10.990'),
(2, 2, 2, '15.990', '15.990'),
(3, 3, 3, '20.990', '20.990'),
(4, 4, 4, '25.990', '25.990'),
(5, 5, 5, '30.990', '30.990');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `smallSellPrice` decimal(10,3) DEFAULT NULL,
  `bigSellPrice` decimal(10,3) DEFAULT NULL,
  `buyPrice` decimal(10,3) DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT (now()),
  `update_at` datetime NOT NULL DEFAULT (now()),
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `smallSellPrice`, `bigSellPrice`, `buyPrice`, `amount`, `manufacturer`, `create_at`, `update_at`, `category_id`) VALUES
(1, 'Product 1', 'Description for Product 1', '9.990', '19.990', '5.990', 100, 'Manufacturer A', '2024-02-08 02:35:00', '2024-02-08 02:35:00', 1),
(2, 'Product 2', 'Description for Product 2', '14.990', '24.990', '10.990', 200, 'Manufacturer B', '2024-02-08 02:36:00', '2024-02-08 02:36:00', 2),
(3, 'Product 3', 'Description for Product 3', '19.990', '29.990', '15.990', 150, 'Manufacturer C', '2024-02-08 02:37:00', '2024-02-08 02:37:00', 3),
(4, 'Product 4', 'Description for Product 4', '24.990', '34.990', '20.990', 120, 'Manufacturer A', '2024-02-08 02:38:00', '2024-02-08 02:38:00', 4),
(5, 'Product 5', 'Description for Product 5', '29.990', '39.990', '25.990', 180, 'Manufacturer B', '2024-02-08 02:39:00', '2024-02-08 02:39:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `attribute_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`attribute_id`, `name`) VALUES
(1, 'Attribute 1'),
(2, 'Attribute 2'),
(3, 'Attribute 3'),
(4, 'Attribute 4'),
(5, 'Attribute 5');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `value_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `product_id` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`value_id`, `attribute_id`, `product_id`, `value`) VALUES
(1, 1, 1, 'Value 1 for Product 1'),
(2, 2, 2, 'Value 2 for Product 2'),
(3, 3, 3, 'Value 3 for Product 3'),
(4, 4, 4, 'Value 4 for Product 4'),
(5, 5, 5, 'Value 5 for Product 5');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT (now()),
  `update_at` datetime NOT NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Category 1', '2024-02-08 02:40:00', '2024-02-08 02:40:00'),
(2, 'Category 2', '2024-02-08 02:41:00', '2024-02-08 02:41:00'),
(3, 'Category 3', '2024-02-08 02:42:00', '2024-02-08 02:42:00'),
(4, 'Category 4', '2024-02-08 02:43:00', '2024-02-08 02:43:00'),
(5, 'Category 5', '2024-02-08 02:44:00', '2024-02-08 02:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `cart_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `total_price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`cart_id`, `customer_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(1, 1, 1, 2, '9.990', '19.980'),
(2, 2, 2, 1, '14.990', '14.990'),
(3, 3, 3, 3, '19.990', '59.970'),
(4, 4, 4, 1, '24.990', '24.990'),
(5, 5, 5, 2, '29.990', '59.980');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`);

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`attribute_id`),
  ADD CONSTRAINT `product_attribute_values_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `shopping_carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
