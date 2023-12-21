CREATE TABLE `danhmuc` (
  `id_danh_muc` int NOT NULL,
  `ten_danh_muc` varchar(225) DEFAULT NULL,
  `mo_ta_danh_muc` text,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` datetime DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `diachikhachhang` (
  `id_dia_chi` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `dia_chi` varchar(225) DEFAULT NULL,
  `thanh_pho` varchar(225) DEFAULT NULL,
  `huyen` varchar(225) DEFAULT NULL,
  `xa` varchar(225) DEFAULT NULL,
  `so_dien_thoai` varchar(225) DEFAULT NULL
);
CREATE TABLE `giohang` (
  `id_gio_hang` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `tong_gio_hang` int DEFAULT NULL
);
CREATE TABLE `hoadon` (
  `id_hoa_don` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `ten_san_pham` text,
  `gia_tri_san_pham` text,
  `so_luong_san_pham` text,
  `tong_gia_tri_tung_san_pham` text,
  `tong_don_hang` text
);
CREATE TABLE `item_giohang` (
  `id_item` int NOT NULL,
  `id_gio_hang` int DEFAULT NULL,
  `id_san_pham` int DEFAULT NULL,
  `so_luong_san_pham` int DEFAULT NULL
);
CREATE TABLE `khachhang` (
  `id_khach_hang` int NOT NULL,
  `ten_khach_hang` varchar(225) DEFAULT NULL,
  `email_khach_hang` varchar(225) DEFAULT NULL,
  `so_dien_thoai` varchar(225) DEFAULT NULL,
  `hinh_anh` text,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` datetime DEFAULT CURRENT_TIMESTAMP,
  `mat_khau` varchar(225) DEFAULT NULL
);
CREATE TABLE `sanpham` (
  `id_san_pham` int NOT NULL,
  `id_danh_muc` int DEFAULT NULL,
  `so_luong_san_pham` int DEFAULT NULL,
  `ten_san_pham` varchar(225) DEFAULT NULL,
  `mo_ta_san_pham` text,
  `hinh_anh` text,
  `gia_san_pham` decimal(10,3) DEFAULT NULL,
  `so_luot_xem` int DEFAULT '0',
  `so_luot_mua` int DEFAULT '0',
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` datetime DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_danh_muc`);

--
-- Chỉ mục cho bảng `diachikhachhang`
--
ALTER TABLE `diachikhachhang`
  ADD PRIMARY KEY (`id_dia_chi`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoa_don`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `item_giohang`
--
ALTER TABLE `item_giohang`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_gio_hang` (`id_gio_hang`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `diachikhachhang`
--
ALTER TABLE `diachikhachhang`
  MODIFY `id_dia_chi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id_gio_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoa_don` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `item_giohang`
--
ALTER TABLE `item_giohang`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `khachhang`
  MODIFY `id_khach_hang` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `sanpham`
  MODIFY `id_san_pham` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `diachikhachhang`
  ADD CONSTRAINT `diachikhachhang_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`);

ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`);

ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`);

ALTER TABLE `item_giohang`
  ADD CONSTRAINT `item_giohang_ibfk_1` FOREIGN KEY (`id_gio_hang`) REFERENCES `giohang` (`id_gio_hang`),
  ADD CONSTRAINT `item_giohang_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `sanpham` (`id_san_pham`);

ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danhmuc` (`id_danh_muc`);
COMMIT;
