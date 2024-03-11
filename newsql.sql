-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2024 at 06:07 AM
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
-- Database: `testdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `color_variant_id` int DEFAULT NULL,
  `ram_variant_id` int DEFAULT NULL,
  `storage_variant_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `discount_code_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `color_variant_id`, `ram_variant_id`, `storage_variant_id`, `quantity`, `discount_code_id`) VALUES
(1, 8, 1, 2, 1, 1, 6, 4),
(2, 1, 5, 3, 4, 5, 6, 3),
(3, 4, 1, 1, 2, 2, 8, 3),
(4, 4, 2, 3, 5, 5, 6, 2),
(5, 6, 5, 5, 4, 5, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'nobis', 'ádada', '2024-03-11 13:03:26'),
(2, 'rerum', NULL, '2024-03-11 13:03:26'),
(3, 'eveniet', NULL, '2024-03-11 13:03:26'),
(4, 'quo', NULL, '2024-03-11 13:03:26'),
(5, 'saepe', NULL, '2024-03-11 13:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `color_variant`
--

CREATE TABLE `color_variant` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `color_variant`
--

INSERT INTO `color_variant` (`id`, `product_id`, `color`, `price`, `image`) VALUES
(1, 2, 'aqua', 12, 'https://via.placeholder.com/640x480.png/002233?text=iusto'),
(2, 3, 'white', 53, 'https://via.placeholder.com/640x480.png/0011bb?text=aut'),
(3, 2, 'green', 92, 'https://via.placeholder.com/640x480.png/009922?text=et'),
(4, 2, 'aqua', 64, 'https://via.placeholder.com/640x480.png/00ddff?text=ea'),
(5, 3, 'olive', 28, 'https://via.placeholder.com/640x480.png/00aacc?text=distinctio');

-- --------------------------------------------------------

--
-- Table structure for table `discount_code`
--

CREATE TABLE `discount_code` (
  `id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_amount` int NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount_code`
--

INSERT INTO `discount_code` (`id`, `code`, `discount_amount`, `is_used`) VALUES
(1, 'qa49kj', 32, 0),
(2, 'dc43ho', 43, 0),
(3, 'zm58kj', 39, 0),
(4, 'ws02jt', 33, 0),
(5, 'di23zt', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `user_id`, `address`, `city`, `country`) VALUES
(1, 4, '91501 Nyah Junctions Apt. 019\nOrenbury, GA 14405', 'North Erwin', 'Ecuador'),
(2, 7, '71990 Murray Shoal Suite 511\nFeiltown, AK 30909', 'Carrollville', 'Sudan'),
(3, 8, '96658 Lenna Parkways\nSouth Aftonbury, UT 01678-0931', 'Lake Providenci', 'Lesotho'),
(4, 7, '1329 Bernier Center Apt. 732\nPort Esther, NV 96488-5893', 'East Javon', 'Guam'),
(5, 7, '229 Sven Prairie\nLake Bettyeland, RI 22757', 'Lueilwitzfurt', 'Lesotho');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `location_id` int NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `total_price`, `location_id`, `order_status`) VALUES
(1, 9, 395, 5, 'pending'),
(2, 1, 258, 4, 'pending'),
(3, 10, 293, 2, 'pending'),
(4, 1, 412, 2, 'shipped'),
(5, 4, 226, 2, 'shipped');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `category_id`) VALUES
(1, 'blanditiis', 'Eveniet aut sed id non.', 1),
(2, 'fugiat', 'Iste fugit illo dolor eligendi.', 1),
(3, 'nesciunt', 'In commodi consequatur magnam illum.', 2),
(4, 'iste', 'Nihil assumenda quisquam at consequuntur nihil cum quos.', 2),
(5, 'cupiditate', 'Repellat praesentium omnis officia voluptas.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ram_variant`
--

CREATE TABLE `ram_variant` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ram_variant`
--

INSERT INTO `ram_variant` (`id`, `product_id`, `ram`, `price`, `image`) VALUES
(1, 3, '8GB', 192, 'https://via.placeholder.com/640x480.png/00dddd?text=enim'),
(2, 3, '4GB', 192, 'https://via.placeholder.com/640x480.png/007766?text=voluptates'),
(3, 1, '16GB', 123, 'https://via.placeholder.com/640x480.png/008811?text=provident'),
(4, 1, '4GB', 101, 'https://via.placeholder.com/640x480.png/002244?text=velit'),
(5, 2, '4GB', 145, 'https://via.placeholder.com/640x480.png/00dd00?text=numquam');

-- --------------------------------------------------------

--
-- Table structure for table `storage_variant`
--

CREATE TABLE `storage_variant` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storage_variant`
--

INSERT INTO `storage_variant` (`id`, `product_id`, `storage`, `price`, `image`) VALUES
(1, 5, '128GB', 118, 'https://via.placeholder.com/640x480.png/004411?text=corporis'),
(2, 5, '512GB', 66, 'https://via.placeholder.com/640x480.png/008855?text=et'),
(3, 4, '512GB', 57, 'https://via.placeholder.com/640x480.png/009988?text=ad'),
(4, 2, '128GB', 60, 'https://via.placeholder.com/640x480.png/00ffbb?text=non'),
(5, 5, '512GB', 67, 'https://via.placeholder.com/640x480.png/00bbbb?text=eos');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imgurl` text,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `imgurl`, `password`) VALUES
(1, 'diamond41', 'jeffery.rogahn@sporer.com', NULL, '$2y$10$o0572znjcbYOQaz0BsJCceUZKeDijUcQotCwGK6zv2wM97tdLRTzW'),
(2, 'tristin.renner', 'meta99@gmail.com', NULL, '$2y$10$wv7d5NaIFSleWizld165rOqA6lTfni6f.UlbLOvUjh8GG/2Xy0ndi'),
(3, 'hamill.icie', 'spinka.oleta@barton.com', NULL, '$2y$10$GbFQZORMgdHvTfvRSxuAee8lNejoaaM5PtWnml4Nr4CsCVMOcLGyS'),
(4, 'queen.herzog', 'moen.virginia@yahoo.com', NULL, '$2y$10$Em7agvtmRv/77hHjK.1lt.krxYSi9pmVzuHwUEPMUuLFmify5i/rO'),
(5, 'abdul.homenick', 'abigail.cole@yahoo.com', NULL, '$2y$10$yo8xVWHSDSwW53I7WIjrHOOOJxJK4V/ESCUTxF35C4Px4Oa14S32.'),
(6, 'slarson', 'berniece.dach@yahoo.com', NULL, '$2y$10$1zH.lHLVx.pvQ83vFee6DeNZrcfLcojRIaazDSZ1879Bdqt9w2gtq'),
(7, 'deckow.walton', 'antonetta.durgan@murazik.org', NULL, '$2y$10$UQzFLgS4inOyImQn9BZW4O7EuAe067oa8eqyngJT5OPI4HZJSAFtG'),
(8, 'paucek.raoul', 'wolf.kaden@dietrich.com', NULL, '$2y$10$WpAJjrzNhfINeiptc4kEuO.0tRfpFFoNdOGHis4ZXYmAjjRFFJWA6'),
(9, 'lubowitz.lesly', 'ljast@mccullough.org', NULL, '$2y$10$KIUi3ZTKxyn5Mwbr7L7I2e505XUwqZpYObYtbvuuGIOKLxPRz0Zbq'),
(10, 'douglas.anahi', 'bmcclure@fisher.info', NULL, '$2y$10$.9wK60wKz7ezkpIcnwNOgu6rruHCPX/TqaLnxnvIL73wHWLv/Ncfi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_variant_id` (`color_variant_id`),
  ADD KEY `ram_variant_id` (`ram_variant_id`),
  ADD KEY `storage_variant_id` (`storage_variant_id`),
  ADD KEY `cart_ibfk_6` (`discount_code_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_variant`
--
ALTER TABLE `color_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ram_variant`
--
ALTER TABLE `ram_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `storage_variant`
--
ALTER TABLE `storage_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `color_variant`
--
ALTER TABLE `color_variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ram_variant`
--
ALTER TABLE `ram_variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storage_variant`
--
ALTER TABLE `storage_variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`color_variant_id`) REFERENCES `color_variant` (`id`),
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`ram_variant_id`) REFERENCES `ram_variant` (`id`),
  ADD CONSTRAINT `cart_ibfk_5` FOREIGN KEY (`storage_variant_id`) REFERENCES `storage_variant` (`id`),
  ADD CONSTRAINT `cart_ibfk_6` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_code` (`id`);

--
-- Constraints for table `color_variant`
--
ALTER TABLE `color_variant`
  ADD CONSTRAINT `color_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `ram_variant`
--
ALTER TABLE `ram_variant`
  ADD CONSTRAINT `ram_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `storage_variant`
--
ALTER TABLE `storage_variant`
  ADD CONSTRAINT `storage_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
