
CREATE TABLE `brand` (
  `id_brand` int NOT NULL,
  `ten_brand` varchar(255) NOT NULL,
  `mo_ta_brand` text
);

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `ten_brand`, `mo_ta_brand`) VALUES
(3, 'Nvidia', '<p>a</p>');

-- --------------------------------------------------------

--
-- Table structure for table `giohang_session`
--

CREATE TABLE `giohang_session` (
  `id_gio_hang` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `id_san_pham` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `gia_san_pham` decimal(10,3) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hoa_don` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `tong_gia_tri` decimal(10,3) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
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
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `id_loai_san_pham` int NOT NULL,
  `ten_loai_san_pham` varchar(255) NOT NULL,
  `mo_ta` varchar(225) DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`id_loai_san_pham`, `ten_loai_san_pham`, `mo_ta`, `ngay_tao`) VALUES
(2, 'Card đồ hoạ', 'ádasdasd', '2024-02-04 16:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
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
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ngay_tao` timestamp NULL DEFAULT NULL,
  `ngay_cap_nhat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_san_pham`, `ten_san_pham`, `gia_ban_le`, `gia_ban_buon`, `gia_nhap_hang`, `so_luong`, `mo_ta`, `id_loai_san_pham`, `id_brand`, `image`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(2, 'Product Name', '50.990', '45.990', '35.990', 100, 'Product Description', 2, 1, 'image_path.jpg', NULL, '2024-02-04 16:33:21'),
(3, 'Card màn hình ASUS Tuf GTX 1660 SUPER 6G GDDR6', '5690000.000', '5690000.000', '5690000.000', NULL, NULL, 2, 3, NULL, NULL, '2024-02-04 16:39:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `giohang_session`
--
ALTER TABLE `giohang_session`
  ADD PRIMARY KEY (`id_gio_hang`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoa_don`),
  ADD KEY `fk_hoadon_khachhang` (`id_khach_hang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`id_loai_san_pham`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_san_pham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `giohang_session`
--
ALTER TABLE `giohang_session`
  MODIFY `id_gio_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoa_don` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_khach_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `id_loai_san_pham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_san_pham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hoadon_khachhang` FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
