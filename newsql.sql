-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2024 at 12:15 PM
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
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_variant_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `update_at`) VALUES
(1, 'magni', 'Nihil ex et quo molestias.', '2024-03-07 15:54:27', '2024-03-13 10:29:17'),
(2, 'eum', 'Minima a ab dolor omnis deserunt dolorem.', '2024-03-04 02:13:54', '2024-03-13 10:29:17'),
(3, 'non', 'Aspernatur deserunt a suscipit omnis itaque.', '2024-02-21 23:03:47', '2024-03-13 10:29:17'),
(4, 'sit', 'Occaecati esse voluptatem earum explicabo.', '2024-02-26 16:08:08', '2024-03-13 10:29:17'),
(5, 'consequuntur', 'Soluta dolore ut minima sunt corrupti.', '2024-02-14 21:44:22', '2024-03-13 10:29:17'),
(6, 'Máy tính để bàn', 'Nó là cái máy tính, hết\r\n', '2024-03-13 18:32:45', '2024-03-13 11:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `discount_code`
--

CREATE TABLE `discount_code` (
  `id` int NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `discount_amount` int DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT '0',
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount_code`
--

INSERT INTO `discount_code` (`id`, `code`, `discount_amount`, `is_used`, `create_at`, `update_at`) VALUES
(1, 'VEN51', 48, 1, '2024-03-13 17:29:55', '2024-03-13 17:29:55'),
(2, 'KTI52', 22, 1, '2024-03-13 17:29:55', '2024-03-13 17:29:55'),
(3, 'VUM04', 14, 1, '2024-03-13 17:29:55', '2024-03-13 17:29:55'),
(4, 'XBT46', 41, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(5, 'INO62', 5, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(6, 'AQF06', 8, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(7, 'RZN03', 17, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(8, 'BAK09', 12, 2, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(9, 'JRJ55', 38, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(10, 'WEZ34', 42, 2, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(11, 'YIF56', 40, 1, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(12, 'GRQ92', 30, 2, '2024-03-13 17:31:32', '2024-03-13 17:31:32'),
(13, 'ZPZ22', 5, 2, '2024-03-13 17:31:32', '2024-03-13 17:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `user_id`, `address`, `city`) VALUES
(1, 6, '256 Nathanael Spring', 'Maceyview'),
(2, 6, '47686 Dach Point Suite 092', 'New Wilbert'),
(3, 7, '745 Florine Bypass', 'New June'),
(4, 4, '40355 Corkery Estate', 'Lake Eloise'),
(5, 7, '468 Ullrich Rest', 'South Delphine'),
(6, 6, '8654 Amely Dale Apt. 349', 'Feilberg'),
(7, 2, '562 Joyce Well', 'South Leonardo'),
(8, 2, '1983 Stark Port', 'Yosthaven'),
(9, 7, '76684 Monty Village', 'East Jenaberg'),
(10, 8, '2151 Roberts Club', 'Lebsackville'),
(11, 3, '18974 Louie Stream', 'New Guillermo'),
(12, 10, '8222 Ebert Mills', 'Dibberttown'),
(13, 3, '470 Horacio Plains', 'Lake Roselynfurt'),
(14, 3, '783 Stokes Track Suite 247', 'North Brooke'),
(15, 4, '54733 Eda Neck Suite 756', 'Langoshland'),
(16, 6, '559 O\'Kon Coves', 'Kozeyside'),
(17, 7, '7749 Muller Land', 'Donnellborough'),
(18, 5, '6852 Berge Centers Suite 854', 'West Berenicestad'),
(19, 9, '26071 Diana Roads Suite 401', 'New Sam'),
(20, 2, '1300 Anderson Wall Suite 595', 'East Anastaciostad');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `location_id` int NOT NULL,
  `order_status` int DEFAULT '0',
  `discount_code_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `location_id`, `order_status`, `discount_code_id`, `created_at`, `update_at`) VALUES
(1, 8, 398, 2, 1, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(2, 2, 115, 9, 2, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(3, 8, 367, 6, 5, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(4, 4, 303, 7, 1, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(5, 6, 291, 10, 1, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(6, 4, 270, 2, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(7, 4, 223, 1, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(8, 9, 218, 5, 4, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(9, 6, 429, 3, 1, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(10, 1, 499, 4, 2, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(11, 1, 244, 5, 2, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(12, 10, 75, 1, 4, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(13, 9, 330, 9, 2, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(14, 10, 397, 9, 5, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(15, 8, 290, 2, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(16, 7, 175, 4, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(17, 8, 128, 8, 1, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(18, 7, 295, 1, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(19, 2, 424, 8, 5, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55'),
(20, 1, 127, 8, 3, NULL, '2024-03-13 10:32:55', '2024-03-13 10:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_variant_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `product_variant_id`, `quantity`, `price`) VALUES
(1, 1, 2, 1, 1, 398);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `category_id`, `created_at`, `update_at`) VALUES
(2, 'omnis est asperiores', 'Omnis cum quia neque quisquam. Voluptate esse porro ut neque earum eos et. Voluptatem quis temporibus omnis sint rerum. Voluptate in nihil delectus atque qui officiis similique.', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(3, 'magni harum error', 'Occaecati laudantium dolor eveniet numquam aut ut doloremque. Perspiciatis nostrum consequatur occaecati eum neque cum occaecati provident. Quibusdam atque excepturi neque esse dolorem ut expedita. Fuga non consectetur possimus.', 5, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(4, 'repudiandae voluptate est', 'Nobis eius praesentium ipsa quasi dolor quidem. Rerum et et facilis quia ea corporis doloribus. Aut necessitatibus culpa qui vel repudiandae harum earum.', 4, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(5, 'maiores ut explicabo', 'Sed quia quis rem delectus beatae non et. Quod nisi ducimus amet dolor. Ipsa exercitationem et qui.', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(6, 'eos sint quae', 'Voluptatem laboriosam quia at sit. Facere itaque iste autem pariatur facilis. Provident deserunt in illo doloribus quis soluta.', 5, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(7, 'aliquam aut consequatur', 'Distinctio ducimus pariatur sunt ipsa. Ut nihil rerum minima tenetur inventore commodi. Omnis provident est eius ipsum quasi. Quia sed id accusantium eos.', 5, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(8, 'voluptatibus modi et', 'Consequatur ducimus voluptas ea. Soluta inventore rerum rerum repellat recusandae.', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(9, 'nisi autem facere', 'Deserunt iste sit quos tempore officiis. Nobis necessitatibus omnis vero hic. Corrupti quaerat minima necessitatibus amet quae. Molestias doloribus dolorem non voluptas.', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(10, 'sunt distinctio laborum', 'Labore dolor ipsum quasi ut animi sit exercitationem. Aut vitae numquam sed mollitia id aliquam. Velit et ea et quisquam nihil non.', 2, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(11, 'ratione quis iure', 'Cum dolor labore dolorum odio veniam in fuga nam. Perspiciatis tenetur vel est rerum cum ex. Earum voluptatem omnis tenetur tempore. Repudiandae distinctio et assumenda dolores.', 2, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(12, 'et aperiam ut', 'Debitis officiis similique eos sint est unde incidunt. Non vel consequatur tempore deleniti aut velit illum est. Vel ipsam ad eius.', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(13, 'iusto ab odio', 'Aperiam tempora minima et excepturi id. Autem debitis est aliquid. Necessitatibus nihil ut nobis soluta odio.', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(14, 'pariatur velit ipsa', 'Itaque est voluptatem nam. Ducimus dolorem eaque non amet quia. Ipsum neque architecto sunt pariatur explicabo quis.', 4, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(22, 'Máy tính hỏng', '<p>Nó hỏng nhưng vẫn dùng được thì nó vẫn là dùng được chứ clgt gì</p>', 6, '2024-03-13 11:33:41', '2024-03-13 11:33:41'),
(23, 'Máy tính', '<p>Nó là cái máy tính</p>', 6, '2024-03-13 12:15:04', '2024-03-13 12:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `variant_type` varchar(255) DEFAULT NULL,
  `variant_value` varchar(50) NOT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `product_id`, `quantity`, `variant_type`, `variant_value`, `price`, `image`, `status`) VALUES
(1, 6, 53, 'color', 'reiciendis', 482, 'https://via.placeholder.com/640x480.png/008888?text=iure', 1),
(2, 4, 30, 'color', 'qui', 165, 'https://via.placeholder.com/640x480.png/001144?text=vel', 0),
(4, 22, 1, 'Màu sắc', 'Màu clgt ?', 100000, 'uploads/65f18f15a2b23_339811502_617808676451128_5645324132944411378_n.jpg', NULL),
(5, 23, 50, 'Màu', 'Đen', 5000, 'uploads/65f198c813fe4_320738461_535869885124193_7511563345536161237_n.jpg', NULL),
(6, 23, 100, 'Màu', 'Xanh', 10000, 'uploads/65f198c81485d_320738461_535869885124193_7511563345536161237_n.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imgurl` text,
  `password` varchar(255) NOT NULL,
  `role` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `imgurl`, `password`, `role`, `created_at`, `update_at`) VALUES
(1, 'dsipes', 'oren.schmeler@yahoo.com', 'https://via.placeholder.com/640x480.png/000055?text=nihil', '$2y$10$I4SuX2ryrw2zcS7Y6WkSQ.9u6NZjpzcIDNt3wTfsSARN2318izFOy', 0, '2024-03-13 10:20:22', '2024-03-13 10:20:22'),
(2, 'bernita62', 'clarabelle.mckenzie@hotmail.com', 'https://via.placeholder.com/640x480.png/00ee33?text=sint', '$2y$10$amkDaJbSACy1O0RHcaJLMeeiNwRZ7AHbhgea25w1mV.17nHwOP3VC', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(3, 'fcasper', 'modesta48@lind.com', 'https://via.placeholder.com/640x480.png/000000?text=et', '$2y$10$RVg9rQYSmqGPH6j9NrhR8uHpV/oVAG/U7Ycx8l2zuBWXcxkbkn6Xa', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(4, 'orlando12', 'romaguera.catherine@gmail.com', 'https://via.placeholder.com/640x480.png/0099dd?text=eos', '$2y$10$FZjOc..XrzYZwv54l.l01.eUK.tSFiB25f7w6.2MVgiA75urDx3g6', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(5, 'rae17', 'dangelo94@yahoo.com', 'https://via.placeholder.com/640x480.png/000099?text=iste', '$2y$10$mO8TiyZENITasQTG3Ds5k.X56Nm2DEEjm1HdL7FJayKgnZ0A2XhaO', 2, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(6, 'hmckenzie', 'aurelia.rau@goldner.com', 'https://via.placeholder.com/640x480.png/00ee66?text=quia', '$2y$10$OAtt7cD3j319iHHhlKSGHOec1stkANQHRKmlDa4Qy.yT4gKIO3.Yy', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(7, 'ischoen', 'sshields@hotmail.com', 'https://via.placeholder.com/640x480.png/000077?text=debitis', '$2y$10$q1001AM7VeXn5OIds8Sw2.Cmuvwt.JZbqBlbZOw579qaEapxt.0aG', 1, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(8, 'gretchen32', 'raynor.meagan@gleason.com', 'https://via.placeholder.com/640x480.png/007755?text=id', '$2y$10$SWKQvIqDiZXAi0nq/1U30el8KMSsglJ0PWm5srDLu/q6qgYRd.QAG', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(9, 'tbashirian', 'schiller.kacie@hotmail.com', 'https://via.placeholder.com/640x480.png/0044ee?text=ut', '$2y$10$fWWNkcwXaa3XjRrqmuKBHurhch.l1gt5xKnPciPYehV7M0fzKldiW', 3, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(10, 'kilback.mona', 'kuhic.reta@hotmail.com', 'https://via.placeholder.com/640x480.png/0000bb?text=atque', '$2y$10$LzePPiC2OQ.lbGO3mAmwieAuQXqDB6F9u3v1wUSofSBRcPJF6cO3K', 2, '2024-03-13 10:29:17', '2024-03-13 10:29:17'),
(11, 'randal.lowe', 'morar.price@yahoo.com', 'https://via.placeholder.com/640x480.png/009988?text=tenetur', '$2y$10$P3bv6GYuqdHKmPAcR2bO4Of8SeXvIGtfpVUTss0qrYTtC8hJUYS7m', 2, '2024-03-13 10:29:17', '2024-03-13 10:29:17');

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
  ADD KEY `cart_product_variant_fk` (`product_variant_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `discount_code_id` (`discount_code_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_product_variant_fk` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_code` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
