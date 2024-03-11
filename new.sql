SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
);

CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
);

CREATE TABLE `ram_variant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `ram_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
);

CREATE TABLE `color_variant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `color_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
);

CREATE TABLE `storage_variant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `storage_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
);

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
);

CREATE TABLE `location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `color_variant_id` int DEFAULT NULL,
  `ram_variant_id` int DEFAULT NULL,
  `storage_variant_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `color_variant_id` (`color_variant_id`),
  KEY `ram_variant_id` (`ram_variant_id`),
  KEY `storage_variant_id` (`storage_variant_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`color_variant_id`) REFERENCES `color_variant` (`id`),
  CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`ram_variant_id`) REFERENCES `ram_variant` (`id`),
  CONSTRAINT `cart_ibfk_5` FOREIGN KEY (`storage_variant_id`) REFERENCES `storage_variant` (`id`)
);


CREATE TABLE `discount_code` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `discount_amount` int NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
);

ALTER TABLE `cart` ADD COLUMN `discount_code_id` int DEFAULT NULL,
                ADD CONSTRAINT `cart_ibfk_6` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_code` (`id`);


COMMIT;
