SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
);

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`) VALUES
(1, 'Color'),
(2, 'Size'),
(3, 'Material');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text
);

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`) VALUES
(1, 'Nike', 'Sportswear and equipment manufacturer'),
(2, 'Adidas', 'Sportswear manufacturer'),
(3, 'Apple', 'Technology company known for its electronic devices');

-- --------------------------------------------------------

--
-- Table structure for table `cart_session`
--

CREATE TABLE `cart_session` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `product_price` decimal(10,3) DEFAULT NULL
);

--
-- Dumping data for table `cart_session`
--

INSERT INTO `cart_session` (`id`, `customer_id`, `product_id`, `quantity`, `product_price`) VALUES
(1, 1, 1, 2, '49.990'),
(2, 1, 2, 1, '99.990'),
(3, 2, 3, 1, '199.990');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
);

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone_number`, `created_at`, `updated_at`, `password`, `role`) VALUES
(1, 'John Doe', 'john@example.com', '+1234567890', '2024-02-15 19:13:00', '2024-02-17 10:37:54', 'password123', '1'),
(2, 'Jane Smith', 'jane@example.com', '+0987654321', '2024-02-15 19:13:00', '2024-02-17 10:38:02', 'password456', '0');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `total_price` decimal(10,3) DEFAULT NULL,
  `product_group` varchar(225) DEFAULT NULL,
  `price_group` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL
);

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `customer_id`, `total_price`, `product_group`, `price_group`, `create_at`, `status`) VALUES
(1, 1, '149.970', NULL, '', '2024-02-16 09:28:09', NULL),
(2, 2, '199.990', NULL, '', '2024-02-16 09:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `retail_price` decimal(10,3) DEFAULT NULL,
  `wholesale_price` decimal(10,3) DEFAULT NULL,
  `purchase_price` decimal(10,3) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `description` text,
  `category_id` int DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `image` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `retail_price`, `wholesale_price`, `purchase_price`, `quantity`, `description`, `category_id`, `brand_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Running Shoes', '59.990', '39.990', '29.990', 50, 'High-performance running shoes', 1, 1, 'running_shoes.jpg', '2024-02-15 19:13:00', '2024-02-15 19:13:00'),
(2, 'Soccer Ball', '29.990', '19.990', '14.990', 100, 'Official size and weight soccer ball', 2, 2, 'soccer_ball.jpg', '2024-02-15 19:13:00', '2024-02-15 19:13:00'),
(3, 'iPhone 15', '999.990', '799.990', '699.990', 20, 'Latest model of iPhone', 3, 3, 'iphone_15.jpg', '2024-02-15 19:13:00', '2024-02-15 19:13:00'),
(4, 'silly kat', '3000.000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 03:41:28', '2024-02-16 03:41:28'),
(5, 'silly kat', '3000.000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 03:51:16', '2024-02-16 03:51:16'),
(6, '1', '10000.000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 03:51:36', '2024-02-16 03:51:36'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 03:59:28', '2024-02-16 03:59:28'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 03:59:36', '2024-02-16 03:59:36'),
(9, 'Bàn phím máy tính hỏng', '1111.000', '111.000', '111.000', 1111, '1111', 1, 1, '2', '2024-02-16 04:00:09', '2024-02-16 04:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_detail`
--

CREATE TABLE `product_attribute_detail` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `product_attribute_detail`
--

INSERT INTO `product_attribute_detail` (`id`, `product_id`, `attribute_id`, `value`) VALUES
(1, 1, 1, 'Black'),
(2, 1, 2, '10'),
(3, 2, 1, 'White'),
(4, 3, 1, 'Space Gray');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Footwear', 'Shoes, sandals, and boots', '2024-02-15 19:13:00'),
(2, 'Sports Equipment', 'Equipment for various sports', '2024-02-15 19:13:00'),
(3, 'Electronics', 'Electronic devices and accessories', '2024-02-15 19:13:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_session`
--
ALTER TABLE `cart_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_attribute_detail`
--
ALTER TABLE `product_attribute_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_session`
--
ALTER TABLE `cart_session`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_attribute_detail`
--
ALTER TABLE `product_attribute_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_session`
--
ALTER TABLE `cart_session`
  ADD CONSTRAINT `cart_session_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `cart_session_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `product_attribute_detail`
--
ALTER TABLE `product_attribute_detail`
  ADD CONSTRAINT `product_attribute_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_attribute_detail_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
