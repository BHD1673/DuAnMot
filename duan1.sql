-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2024 at 06:09 AM
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
-- Database: `thithu`
--

-- --------------------------------------------------------

--
-- Table structure for table `bien_the`
--

CREATE TABLE `bien_the` (
  `id` int NOT NULL,
  `ten_bien_the` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `bien_the`
--

INSERT INTO `bien_the` (`id`, `ten_bien_the`) VALUES
(1, 'Color'),
(2, 'Size'),
(3, 'Weight'),
(5, 'dung lượng');

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mo_ta` varchar(225) DEFAULT NULL
);

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`id`, `ten_danh_muc`, `mo_ta`) VALUES
(1, 'Electronics', NULL),
(2, 'Clothing', NULL),
(3, 'Books', NULL),
(8, 'Laptop', 'adwadawd');

-- --------------------------------------------------------

--
-- Table structure for table `dia_chi_nguoi_dung`
--

CREATE TABLE `dia_chi_nguoi_dung` (
  `id` int NOT NULL,
  `id_nguoi_dung` int NOT NULL,
  `ten_nguoi_nhan` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `la_dia_chi_chinh` tinyint(1) NOT NULL DEFAULT '0'
);

--
-- Dumping data for table `dia_chi_nguoi_dung`
--

INSERT INTO `dia_chi_nguoi_dung` (`id`, `id_nguoi_dung`, `ten_nguoi_nhan`, `so_dien_thoai`, `dia_chi`, `la_dia_chi_chinh`) VALUES
(1, 2, 'hải DƯơng', '0365486687', 'thanh sơn', 1),
(2, 2, 'ưdawdawdawd', '213123', 'dădadacawcafawf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int NOT NULL,
  `id_nguoi_dung` int DEFAULT NULL,
  `session_guest` varchar(225) DEFAULT NULL,
  `id_san_pham_bien_the_1` int DEFAULT NULL,
  `id_san_pham_bien_the_2` int DEFAULT NULL,
  `id_san_pham_bien_the_3` int DEFAULT NULL,
  `id_san_pham_bien_the_4` int DEFAULT NULL,
  `id_san_pham_bien_the_5` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `ten_nguoi_nhan` varchar(255) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL
);

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `id_nguoi_dung`, `session_guest`, `id_san_pham_bien_the_1`, `id_san_pham_bien_the_2`, `id_san_pham_bien_the_3`, `id_san_pham_bien_the_4`, `id_san_pham_bien_the_5`, `so_luong`, `ten_nguoi_nhan`, `dia_chi`, `so_dien_thoai`) VALUES
(1, 1, 'guest_660b9d272c1cd', 1, 2, 10, NULL, NULL, 1, 'Hai Duong', 'thanh son', '0365486687'),
(2, 4, 'adawd', 9, NULL, NULL, NULL, NULL, 2, 'adadw', 'dăd', '2313123'),
(3, 4, '12312321', 4, 4, NULL, NULL, NULL, 2, 'sadwd', 'ădawdawdaw', NULL),
(4, 4, '12312321', 4, 4, NULL, NULL, NULL, 1, 'sadwd', 'ădawdawdaw', NULL),
(5, 3, 'addadwad', 5, NULL, NULL, NULL, NULL, 5, 'adaw', 'dâdawdadaada', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int NOT NULL,
  `id_nguoi_dung` int DEFAULT NULL,
  `session_guest` varchar(225) DEFAULT NULL,
  `id_san_pham_bien_the_1` int DEFAULT NULL,
  `id_san_pham_bien_the_2` int DEFAULT NULL,
  `id_san_pham_bien_the_3` int DEFAULT NULL,
  `id_san_pham_bien_the_4` int DEFAULT NULL,
  `id_san_pham_bien_the_5` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL
);

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id`, `id_nguoi_dung`, `session_guest`, `id_san_pham_bien_the_1`, `id_san_pham_bien_the_2`, `id_san_pham_bien_the_3`, `id_san_pham_bien_the_4`, `id_san_pham_bien_the_5`, `so_luong`) VALUES
(6, NULL, 'guest_660a8252f195a', 13, NULL, NULL, NULL, NULL, 0),
(7, NULL, 'guest_660a8252f195a', 13, NULL, NULL, NULL, NULL, 1),
(14, 2, 'guest_660b9d272c1cd', 1, 2, 10, NULL, NULL, 2121);

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` int NOT NULL,
  `ho_ten` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `anh` text,
  `mat_khau` varchar(225) DEFAULT NULL,
  `role` int DEFAULT NULL
);

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ho_ten`, `email`, `so_dien_thoai`, `anh`, `mat_khau`, `role`) VALUES
(1, 'Hải Dương', 'adwd@afaf.j', '2133123123', 'awdawdsa', '23sdawd', NULL),
(2, 'haiduong', 'banhaiduong167@gmail.com', '03654866687', '1', '1', 0),
(3, '1', 'duongbhph41427@fpt.edu.vn', '1', NULL, '1', NULL),
(4, '2syk4ver', 'banhdiuong16&@gmail.chalcka', '03231231983', NULL, 'Banhaiduong167@@', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `mo_ta` text,
  `id_danh_muc` int DEFAULT NULL,
  `gia_co_ban` int DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `ten_san_pham`, `mo_ta`, `id_danh_muc`, `gia_co_ban`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(1, 'Smartphone', 'A high-end smartphone with advanced features', 1, 10000, '2024-04-01 09:53:00', '2024-04-01 09:53:00'),
(2, 'T-shirt', 'A comfortable cotton T-shirt for everyday wear', 2, 20000, '2024-04-01 09:53:00', '2024-04-01 09:53:00'),
(3, 'Java Programming Book', 'A comprehensive guide to Java programming language', 3, 50000, '2024-04-01 09:53:00', '2024-04-01 09:53:00'),
(4, 'ădawdaw', '&lt;p&gt;ăda&lt;/p&gt;', 1, 213123, '2024-04-01 09:53:00', '2024-04-01 09:53:00'),
(5, 'Bàn phím máy tính hỏng', '<p><strong>MÔ TẢ SẢN PHẨM</strong></p><p>Bàn phím máy case cổng USB; cổng com (cổng tròn) các loại thanh lý văn phòng!</p><p>PHím có nhiều loại cho anh chọn lựa, ace có thể chát với shop để tư vấn thêm</p><p><strong>- Bảo hành 1 tháng</strong></p><p><em>NOTE: Với phân loại phím CŨ: hình ảnh mang tính chất minh họa, không đảm bảo hình dáng của phím 100% như ảnh đăng vì hàng cũ là hàng thanh lý lại từ rất nhiều ng dùng trước mỗi người dùng, dùng 1 loại phím khác nhau và thanh lý lại nên sẽ đa dạng về kiểu dáng, mẫu mã, màu sắc cũng như thương hiệu. Tuy nhiên đảm bảo phím hoạt động tốt và giao đúng loại chân cắm khách đặt.</em></p>', 8, 50000, '2024-04-01 09:54:14', '2024-04-01 10:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham_bien_the`
--

CREATE TABLE `san_pham_bien_the` (
  `id` int NOT NULL,
  `id_san_pham` int DEFAULT NULL,
  `id_bien_the` int DEFAULT NULL,
  `gia_tri` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `so_luong` int DEFAULT '0',
  `gia_bien_the` int DEFAULT NULL
);

--
-- Dumping data for table `san_pham_bien_the`
--

INSERT INTO `san_pham_bien_the` (`id`, `id_san_pham`, `id_bien_the`, `gia_tri`, `image`, `so_luong`, `gia_bien_the`) VALUES
(1, 1, 1, 'Black', '1706368172992630.jpg', 50, 5000),
(2, 1, 2, 'Green', '1706368172992630.jpg', 30, 15000),
(3, 2, 1, 'Blue', '1706368172992630.jpg', 100, 15000),
(4, 2, 2, 'L', '1706368172992630.jpg', 150, 15000),
(5, 3, 1, 'Paperback', '1706368172992630.jpg', 80, 2500),
(7, 1, 2, 'Đỏ', '1706368172992630.jpg', 13123, 6000),
(8, 1, 2, 'S1mple', '1706368172992630.jpg', 123123, 4250),
(9, 4, 1, 'Red', '1706368172992630.jpg', 1, 4321),
(10, 1, 5, 'COlor', '1706368172992630.jpg', 424234, 222),
(11, 1, 1, 'Đỏ', '1706368172992630.jpg', 31312, 123),
(12, 2, 1, 'Đen', '1706368172992630.jpg', 1, 123),
(13, 5, 1, 'Đen', 'Screenshot_20240304_184328_Instagram.jpg', 12, NULL),
(14, 5, 1, 'Đỏ', '1706374127280917.jpg', 22, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bien_the`
--
ALTER TABLE `bien_the`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dia_chi_nguoi_dung`
--
ALTER TABLE `dia_chi_nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`),
  ADD KEY `don_hang_ibfk_2` (`id_san_pham_bien_the_1`),
  ADD KEY `don_hang_ibfk_3` (`id_san_pham_bien_the_2`),
  ADD KEY `don_hang_ibfk_4` (`id_san_pham_bien_the_3`),
  ADD KEY `don_hang_ibfk_5` (`id_san_pham_bien_the_4`),
  ADD KEY `don_hang_ibfk_6` (`id_san_pham_bien_the_5`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`),
  ADD KEY `gio_hang_ibfk_2` (`id_san_pham_bien_the_1`),
  ADD KEY `gio_hang_ibfk_3` (`id_san_pham_bien_the_2`),
  ADD KEY `gio_hang_ibfk_4` (`id_san_pham_bien_the_3`),
  ADD KEY `gio_hang_ibfk_5` (`id_san_pham_bien_the_4`),
  ADD KEY `gio_hang_ibfk_6` (`id_san_pham_bien_the_5`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- Indexes for table `san_pham_bien_the`
--
ALTER TABLE `san_pham_bien_the`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_san_pham` (`id_san_pham`),
  ADD KEY `id_bien_the` (`id_bien_the`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bien_the`
--
ALTER TABLE `bien_the`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dia_chi_nguoi_dung`
--
ALTER TABLE `dia_chi_nguoi_dung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `san_pham_bien_the`
--
ALTER TABLE `san_pham_bien_the`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dia_chi_nguoi_dung`
--
ALTER TABLE `dia_chi_nguoi_dung`
  ADD CONSTRAINT `dia_chi_nguoi_dung_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`id_san_pham_bien_the_1`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_3` FOREIGN KEY (`id_san_pham_bien_the_2`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_4` FOREIGN KEY (`id_san_pham_bien_the_3`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_5` FOREIGN KEY (`id_san_pham_bien_the_4`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_6` FOREIGN KEY (`id_san_pham_bien_the_5`) REFERENCES `san_pham_bien_the` (`id`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`id_san_pham_bien_the_1`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_3` FOREIGN KEY (`id_san_pham_bien_the_2`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_4` FOREIGN KEY (`id_san_pham_bien_the_3`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_5` FOREIGN KEY (`id_san_pham_bien_the_4`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_6` FOREIGN KEY (`id_san_pham_bien_the_5`) REFERENCES `san_pham_bien_the` (`id`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id`);

--
-- Constraints for table `san_pham_bien_the`
--
ALTER TABLE `san_pham_bien_the`
  ADD CONSTRAINT `san_pham_bien_the_ibfk_1` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id`),
  ADD CONSTRAINT `san_pham_bien_the_ibfk_2` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
