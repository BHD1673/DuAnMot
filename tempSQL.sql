CREATE TABLE `address_delivery` (
  `id_address_delivery` int NOT NULL,
  `address_delivery` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `id_user` int NOT NULL
);

CREATE TABLE `bill` (
  `id_bill` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `total_name_product` varchar(500) NOT NULL,
  `name_receiver` varchar(255) DEFAULT NULL,
  `address_delivery` varchar(255) DEFAULT NULL,
  `phone_numnber` varchar(255) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `method` varchar(225) NOT NULL,
  `total_price` float NOT NULL,
  `sub_total` float NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  `state` tinyint NOT NULL DEFAULT '0'
);

CREATE TABLE `categories` (
  `id_categories` int NOT NULL,
  `name_categories` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `favorites_list` (
  `id_list` int NOT NULL,
  `id_products` int DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE `products` (
  `id_products` int NOT NULL,
  `id_categories` int DEFAULT NULL,
  `name_products` varchar(225) DEFAULT NULL,
  `images` varchar(225) DEFAULT NULL,
  `original_price` int DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(225) NOT NULL
);

CREATE TABLE `reviews` (
  `id_review` int NOT NULL,
  `id_products` int NOT NULL,
  `id_user` int NOT NULL,
  `comment` text NOT NULL,
  `rating` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `shopping_cart` (
  `id_cart` int NOT NULL,
  `id_products` int DEFAULT NULL,
  `name_products` varchar(225) NOT NULL,
  `images` varchar(225) NOT NULL,
  `price_products` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int DEFAULT NULL,
  `name_topping` varchar(225) NOT NULL,
  `price_topping` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `total` int DEFAULT NULL
);


CREATE TABLE `statistical` (
  `id_statistical` int NOT NULL,
  `date_created` date NOT NULL,
  `revenue` float NOT NULL
);

CREATE TABLE `topping` (
  `id_topping` int NOT NULL,
  `name_topping` varchar(225) DEFAULT NULL,
  `price_topping` int DEFAULT NULL
);

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `full_name` varchar(225) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` tinyint(1) DEFAULT '0'
);

ALTER TABLE `address_delivery`
  ADD PRIMARY KEY (`id_address_delivery`);

ALTER TABLE `bill`
  ADD PRIMARY KEY (`id_bill`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categories`);

ALTER TABLE `favorites_list`
  ADD PRIMARY KEY (`id_list`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`),
  ADD KEY `products_ibfk_1` (`id_categories`);

ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`);

ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id_cart`);

ALTER TABLE `statistical`
  ADD PRIMARY KEY (`id_statistical`);

ALTER TABLE `topping`
  ADD PRIMARY KEY (`id_topping`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `address_delivery`
  MODIFY `id_address_delivery` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `bill`
  MODIFY `id_bill` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories`
  MODIFY `id_categories` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `favorites_list`
  MODIFY `id_list` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `id_products` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `reviews`
  MODIFY `id_review` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `shopping_cart`
  MODIFY `id_cart` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `statistical`
  MODIFY `id_statistical` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `topping`
  MODIFY `id_topping` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categories`);
COMMIT;
