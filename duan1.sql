

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `bien_the` (
  `id` int NOT NULL,
  `ten_bien_the` varchar(255) DEFAULT NULL
);

CREATE TABLE `chi_tiet_don_hang` (
  `id` int NOT NULL,
  `id_don_hang` int NOT NULL,
  `id_san_pham_bien_the_1` int DEFAULT NULL,
  `id_san_pham_bien_the_2` int DEFAULT NULL,
  `id_san_pham_bien_the_3` int DEFAULT NULL,
  `id_san_pham_bien_the_4` int DEFAULT NULL,
  `id_san_pham_bien_the_5` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `thanh_tien` int DEFAULT NULL
);

CREATE TABLE `danh_muc` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mo_ta` varchar(225) DEFAULT NULL
);

CREATE TABLE `dia_chi_nguoi_dung` (
  `id` int NOT NULL,
  `id_nguoi_dung` int NOT NULL,
  `ten_nguoi_nhan` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `la_dia_chi_chinh` tinyint(1) NOT NULL DEFAULT '0'
);
CREATE TABLE `don_hang` (
  `id` int NOT NULL,
  `id_nguoi_dung` int NOT NULL,
  `id_dia_chi_nguoi_dung` int DEFAULT NULL,
  `ngay_dat_hang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tong_tien` int DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT '1'
);
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

CREATE TABLE `nguoi_dung` (
  `id` int NOT NULL,
  `ho_ten` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `anh` text,
  `mat_khau` varchar(225) DEFAULT NULL,
  `role` int DEFAULT NULL
);

CREATE TABLE `san_pham` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `mo_ta` text,
  `id_danh_muc` int DEFAULT NULL,
  `gia_co_ban` int DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `san_pham_bien_the` (
  `id` int NOT NULL,
  `id_san_pham` int DEFAULT NULL,
  `id_bien_the` int DEFAULT NULL,
  `gia_tri` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `so_luong` int DEFAULT '0',
  `gia_bien_the` int DEFAULT NULL
);
ALTER TABLE `bien_the`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_don_hang` (`id_don_hang`),
  ADD KEY `id_san_pham_bien_the_1` (`id_san_pham_bien_the_1`),
  ADD KEY `id_san_pham_bien_the_2` (`id_san_pham_bien_the_2`),
  ADD KEY `id_san_pham_bien_the_3` (`id_san_pham_bien_the_3`),
  ADD KEY `id_san_pham_bien_the_4` (`id_san_pham_bien_the_4`),
  ADD KEY `id_san_pham_bien_the_5` (`id_san_pham_bien_the_5`);
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `dia_chi_nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`);
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`),
  ADD KEY `id_dia_chi_nguoi_dung` (`id_dia_chi_nguoi_dung`);
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`),
  ADD KEY `gio_hang_ibfk_2` (`id_san_pham_bien_the_1`),
  ADD KEY `gio_hang_ibfk_3` (`id_san_pham_bien_the_2`),
  ADD KEY `gio_hang_ibfk_4` (`id_san_pham_bien_the_3`),
  ADD KEY `gio_hang_ibfk_5` (`id_san_pham_bien_the_4`),
  ADD KEY `gio_hang_ibfk_6` (`id_san_pham_bien_the_5`);
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);
ALTER TABLE `san_pham_bien_the`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_san_pham` (`id_san_pham`),
  ADD KEY `id_bien_the` (`id_bien_the`);
ALTER TABLE `bien_the`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `danh_muc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `dia_chi_nguoi_dung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `gio_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `nguoi_dung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `san_pham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `san_pham_bien_the`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`id_san_pham_bien_the_1`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_3` FOREIGN KEY (`id_san_pham_bien_the_2`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_4` FOREIGN KEY (`id_san_pham_bien_the_3`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_5` FOREIGN KEY (`id_san_pham_bien_the_4`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_6` FOREIGN KEY (`id_san_pham_bien_the_5`) REFERENCES `san_pham_bien_the` (`id`);

ALTER TABLE `dia_chi_nguoi_dung`
  ADD CONSTRAINT `dia_chi_nguoi_dung_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`);

ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`id_dia_chi_nguoi_dung`) REFERENCES `dia_chi_nguoi_dung` (`id`);

ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`id_san_pham_bien_the_1`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_3` FOREIGN KEY (`id_san_pham_bien_the_2`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_4` FOREIGN KEY (`id_san_pham_bien_the_3`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_5` FOREIGN KEY (`id_san_pham_bien_the_4`) REFERENCES `san_pham_bien_the` (`id`),
  ADD CONSTRAINT `gio_hang_ibfk_6` FOREIGN KEY (`id_san_pham_bien_the_5`) REFERENCES `san_pham_bien_the` (`id`);

ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id`);
ALTER TABLE `san_pham_bien_the`
  ADD CONSTRAINT `san_pham_bien_the_ibfk_1` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id`),
  ADD CONSTRAINT `san_pham_bien_the_ibfk_2` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the` (`id`);
COMMIT;
