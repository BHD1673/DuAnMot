
CREATE TABLE `brand` (
  `id_brand` int NOT NULL,
  `ten_brand` varchar(255) NOT NULL,
  `mo_ta_brand` text
);


CREATE TABLE `giohang_session` (
  `id_gio_hang` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `id_san_pham` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `gia_san_pham` decimal(10,3) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hoa_don` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `tong_gia_tri` decimal(10,3) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id_khach_hang` int NOT NULL,
  `ten_khach_hang` varchar(225) DEFAULT NULL,
  `email_khach_hang` varchar(225) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `ngay_tao_tai_khoan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mat_khau` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `id_loai_san_pham` int NOT NULL,
  `ten_loai_san_pham` varchar(255) NOT NULL,
  `mo_ta` varchar(225) DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_san_pham` int NOT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `gia_ban_le` decimal(10,3) DEFAULT NULL,
  `gia_ban_buon` decimal(10,3) DEFAULT NULL,
  `gia_nhap_hang` decimal(10,3) DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `mo_ta` text,
  `id_loai_san_pham` int DEFAULT NULL,
  `id_brand` int DEFAULT NULL,
  `mau_sac` varchar(50) DEFAULT NULL,
  `nam_san_xuat` date DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Chỉ mục cho bảng `giohang_session`
--
ALTER TABLE `giohang_session`
  ADD PRIMARY KEY (`id_gio_hang`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoa_don`),
  ADD KEY `fk_hoadon_khachhang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`id_loai_san_pham`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_san_pham`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang_session`
--
ALTER TABLE `giohang_session`
  MODIFY `id_gio_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoa_don` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_khach_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `id_loai_san_pham` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_san_pham` int NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hoadon_khachhang` FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`);
COMMIT;

