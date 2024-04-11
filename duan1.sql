

CREATE TABLE `bien_the` (
  `id` int NOT NULL,
  `ten_bien_the` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bien_the`
--

INSERT INTO `bien_the` (`id`, `ten_bien_the`) VALUES
(1, 'Màu sắc'),
(2, 'Dung lượng');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mo_ta` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`id`, `ten_danh_muc`, `mo_ta`) VALUES
(1, 'Laptop', 'a'),
(2, 'Máy tính', 'q'),
(3, 'Bàn phím', '32'),
(4, 'Chuột máy tính', 'ad');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dia_chi_nguoi_dung`
--

INSERT INTO `dia_chi_nguoi_dung` (`id`, `id_nguoi_dung`, `ten_nguoi_nhan`, `so_dien_thoai`, `dia_chi`, `la_dia_chi_chinh`) VALUES
(1, 1, 'Hải Dương', '0364548687', 'Thanh Sơn', 0),
(2, 1, 'Mai Dương', '123465798798', 'Thanh Nhàn, Hà Nội', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ho_ten`, `email`, `so_dien_thoai`, `anh`, `mat_khau`, `role`) VALUES
(1, '1', '1', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `id_nguoi_dung` int DEFAULT NULL,
  `id_dia_chi_nguoi_dung` int DEFAULT NULL,
  `ghi_chu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `phuong_thuc_thanh_toan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `trang_thai` varchar(255) DEFAULT 'Mới nhận đơn hàng',
  `tao_vao_luc` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `id_nguoi_dung`, `id_dia_chi_nguoi_dung`, `ghi_chu`, `phuong_thuc_thanh_toan`, `trang_thai`, `tao_vao_luc`) VALUES
(3, 1, 1, 'asdawdasdadwdawd', 'COD', 'Mới nhận đơn hàng', '2024-04-10 15:19:47'),
(4, 1, 1, 'asdawdasdadwdawd', 'COD', 'Mới nhận đơn hàng', '2024-04-10 15:21:02'),
(5, 1, 1, 'Cái lồn', 'COD', 'Mới nhận đơn hàng', '2024-04-10 15:56:29'),
(6, 1, 2, 'Nhận thì đánh người nhận', 'COD', 'Mới nhận đơn hàng', '2024-04-10 16:00:29'),
(7, 1, 2, 'Nhận thì đánh người nhận', 'COD', 'Mới nhận đơn hàng', '2024-04-10 16:03:24'),
(8, 1, 2, 'Nhận thì đánh người nhận', 'COD', 'Mới nhận đơn hàng', '2024-04-10 16:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_variant` varchar(50) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `item_quantity` int DEFAULT NULL,
  `item_total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `item_name`, `item_variant`, `item_price`, `item_quantity`, `item_total_price`) VALUES
(7, 3, 'Laptop Cũ Dell Latitude 9510 2 in 1 - Intel i7-10710U | 16GB | 15.6 inch Full HD Touch', 'Đỏ', '6000.00', 3, '18000.00'),
(8, 3, 'Laptop Cũ Dell Precision 7550 - Intel Core i7 10750H | Quadro T1000M', 'Đen', '1901000.00', 2, '3802000.00'),
(9, 3, 'Laptop Cũ Dell Precision 7550 - Intel Core i7 10750H | Quadro T1000M', 'Xám', '1901000.00', 3, '5703000.00'),
(10, 4, 'Laptop Cũ Dell Latitude 9510 2 in 1 - Intel i7-10710U | 16GB | 15.6 inch Full HD Touch', 'Đỏ', '6000.00', 3, '18000.00'),
(11, 4, 'Laptop Cũ Dell Precision 7550 - Intel Core i7 10750H | Quadro T1000M', 'Đen', '1901000.00', 2, '3802000.00'),
(12, 4, 'Laptop Cũ Dell Precision 7550 - Intel Core i7 10750H | Quadro T1000M', 'Xám', '1901000.00', 3, '5703000.00'),
(13, 5, 'Laptop Cũ HP 14s-dr2009tu - Intel Core i5-1135G7 | 14 inch Full HD', 'Đỏ', '106000.00', 1, '106000.00'),
(14, 6, 'Laptop Cũ HP 14s-dr2009tu - Intel Core i5-1135G7 | 14 inch Full HD', 'Đỏ', '106000.00', 1, '106000.00'),
(15, 7, 'Laptop Cũ HP 14s-dr2009tu - Intel Core i5-1135G7 | 14 inch Full HD', 'Đỏ', '106000.00', 1, '106000.00'),
(16, 8, 'Laptop Cũ HP 14s-dr2009tu - Intel Core i5-1135G7 | 14 inch Full HD', 'Đỏ', '106000.00', 1, '106000.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `ten_san_pham`, `mo_ta`, `id_danh_muc`, `gia_co_ban`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(1, 'Laptop Cũ Dell Latitude 9510 2 in 1 - Intel i7-10710U | 16GB | 15.6 inch Full HD Touch', '&lt;h2 class=&quot;ql-align-justify&quot;&gt;&lt;strong&gt;Cấu hình Dell Latitude 9510 cực kì mạnh mẽ sẵn sàng xử lý tốt các&amp;nbsp;thao tác&amp;nbsp;phức tạp&lt;/strong&gt;&lt;/h2&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;Chiếc&amp;nbsp;&lt;strong&gt;Dell Latitude 9510&lt;/strong&gt;&amp;nbsp;được sở hữu một cấu hình khá lý tưởng và mạnh mẽ cho chiếc laptop văn phòng với chip Intel Core i7-10710U có 6 nhân 12 luồng, xung nhịp tối đa lên tới 4.70 GHz kèm bộ nhớ đệm 12 MB Intel Smart Cache giúp bạn có thể làm tốt mọi tác vụ văn phòng từ cơ bản đến phức tạp như code web, html, phần mềm quản lý, kế toán, bán hàng... một cách ổn định trong nhiều năm liền, thậm chí là còn có thể làm đồ họa 2D trên các ứng dụng Photoshop, AI, Canva và chơi các tựa game nhẹ HOT.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;Đặc biệt, máy được trang bị dung lượng RAM 16GB dung lượng cực lớn để bạn có thể xử lý mượt mà cùng lúc hơn chục các thao tác cơ bản đến các trình duyệt nặng trên các ứng dụng văn phòng cùng lúc mà không có độ trễ. Ổ cứng 512GB M.2 NVMe PCIe 4.0 SSD tốc độ cao được đánh giá là có tốc độ vận hành nhanh chóng. Thao tác mở máy chỉ tốn của bạn khoảng 10 giây. Các phần mềm nhẹ như Edge, Chrome gần như mở lên ngay lập tức khi bạn bấm vào.&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;h2 class=&quot;ql-align-justify&quot;&gt;&lt;strong&gt;Dell Latitude 9510 2 in 1 cực mỏng nhẹ và vô cùng bền bỉ&lt;/strong&gt;&lt;/h2&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;strong&gt;Dell 9510 Latitude&lt;/strong&gt;&amp;nbsp;sở hữu thiết kế cao cấp, chỉn chu đến từng chi tiết và có các góc cạnh vuông vắn lịch lãm đẹp như XPS. Máy có độ bền cao mang đến khả năng chống sốc và chống chịu các tác động của ngoại lực khi vô tình gặp sự cố va chạm. Thêm vào đó, độ hoàn thiện từ nắp máy, bàn phím cho đến bản lề máy đều được làm rất tốt để bạn có thể yên tâm sử dụng ổn định trong nhiều năm liền mà không sợ hỏng hóc, lỗi vặt.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt;Bên cạnh đó, chỉ với một thao tác xoay 360 độ bạn đã biến chiếc máy tính của mình trở thành một chiếc máy tính bảng 15 inch rồi đấy.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, 5000, '2024-04-08 16:24:24', '2024-04-08 16:24:24'),
(2, 'Laptop Cũ HP 14s-dr2009tu - Intel Core i5-1135G7 | 14 inch Full HD', '&lt;h1 class=&quot;ql-align-center&quot;&gt;&lt;strong style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt;HP 14s i5: Thiết kế sang trọng, bền bỉ - Làm việc, học tập, chơi game nhẹ mượt mà&amp;nbsp;&lt;/strong&gt;&lt;/h1&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;a href=&quot;https://laptop88.vn/hp.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;Laptop HP&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt; là dòng &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/may-tinh-xach-tay.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;laptop&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;, &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/may-tinh-xach-tay.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;máy tính xách tay&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt; được người tiêu dùng yêu thích và nhớ đến bởi thiết kế sang trọng, bền bỉ cùng sự ổn định khi sử dụng. Trong đó, &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-cu-hp-14s-dr2009tu-intel-core-i5-1135g7-14-inch-full-hd.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;&lt;strong&gt;HP 14s i5&lt;/strong&gt;&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt; nổi bật là một mẫu &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-sinh-vien-van-phong.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;laptop văn phòng&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;, &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-hp-core-i5.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;laptop HP Core i5&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt; đẹp, mỏng nhẹ, cấu hình khoẻ, phù hợp với dân văn phòng, các bạn sinh viên. Cùng tìm hiểu kỹ hơn về chiếc &lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-cu.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;laptop cũ&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;/&lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-hp-cu.html&quot; target=&quot;_blank&quot; style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt;laptop HP cũ&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); background-color: transparent;&quot;&gt; này ngay sau đây:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Ngoại hình ấn tượng với thiết kế màu trắng bạc sang trọng, siêu mỏng nhẹ nhưng cực kì bền bỉ dễ dàng cất vào balo di chuyển.&amp;nbsp;&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Hiệu năng ấn tượng trọng tầm giá với chip Intel Core i5-1135G7 đời 11 hiếm gặp ở phân khúc giá rẻ cho trải nghiệm làm việc, học tập thoải mái mà còn có thể chơi game nhẹ như liên minh huyền thoại,... hay thiết kế đồ họa 2D trên Ps.&amp;nbsp;&amp;nbsp;&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;em style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Màn 14 Inch cùng tấm nền IPS cho hình ảnh rõ nét ở các góc nhìn khác nhau trong tầm giá 10 triệu.&lt;/em&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);&quot;&gt;HP 14s i5 với thiết kế khi sờ vào mặt lưng, bạn sẽ cảm thấy mịn, mướt, mát và không hề bám vân. Với ngoài hình như thế này, bỏ ra chưa tới 10 triệu thì quả thật tuyệt vời.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 1, 105000, '2024-04-08 16:25:35', '2024-04-09 17:15:16'),
(3, 'Laptop Cũ Dell Precision 7550 - Intel Core i7 10750H | Quadro T1000M', '&lt;h1 class=&quot;ql-align-center&quot;&gt;Dell Precision 7550 i7 Cỗ Máy Trạm Cấu Hình Khủng, Card Đồ Họa Chuyên Nghiệp Siêu Khỏe, Siêu Bền&lt;/h1&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;a href=&quot;https://laptop88.vn/laptop-cu-dell-precision-7550-intel-core-i7-10850h-quadro-t1000m.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt;&lt;strong&gt;Dell Precision 7550&lt;/strong&gt;&lt;/a&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt; là một chiếc&lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-do-hoa.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; laptop đồ họa&lt;/a&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt; chuyên nghiệp dành cho dân kỹ thuật, đồ họa, Cad Revit, Sketchup, thiết kế 3D và Render được rất nhiều người lựa chọn và tin dùng. Dell 7750 i7 là sự lột xác của những chiếc&lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-dell-cu.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; laptop Dell cũ&lt;/a&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt; ở các dòng series 5000, 7000 trước đây không chỉ thiết kế thông minh mà chiếc&lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/laptop-cu.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; laptop cũ&lt;/a&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt; này còn là chiếc máy trạm di động siêu khỏe, siêu bền đáp ứng mọi nhu cầu của bạn. Cùng tìm hiểu ngay chiếc&lt;/span&gt;&lt;a href=&quot;https://laptop88.vn/may-tinh-xach-tay.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; laptop&lt;/a&gt;&lt;a href=&quot;https://laptop88.vn/may-tinh-xach-tay.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt;/&lt;/a&gt;&lt;a href=&quot;https://laptop88.vn/may-tinh-xach-tay.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; máy tính xách tay&lt;/a&gt;&lt;a href=&quot;https://laptop88.vn/laptop-dell-precision.html&quot; target=&quot;_blank&quot; style=&quot;background-color: transparent; color: rgb(17, 85, 204);&quot;&gt; Dell Precision&lt;/a&gt;&lt;span style=&quot;background-color: transparent; color: rgb(0, 0, 0);&quot;&gt; này nhé!&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Chiếc máy trạm sở hữu cấu hình khủng với Chip i7 10850H hiệu năng khỏe cùng Card riêng biệt cho đồ họa Nvidia Quadro T1000M cho hiệu năng vượt trội, nền tảng lý tưởng cho dân kỹ thuật, render, thiết kế 3D,... Bộ nhớ RAM 16GB khả năng đa nhiệm, SSD 256GB có khả năng nâng cấp lên 512GB.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Màn hình 15.6 inch IPS Full HD thiết kế hình ảnh rõ nét, sống động trong không gian rộng lớn cùng những công nghệ chống chói Anti Glare, Non - Touch, độ sáng lên đến 500 nits trải nghiệm màu sắc rõ nét và chân thật hơn.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;span style=&quot;background-color: transparent; color: rgb(255, 0, 0);&quot;&gt;- Thiết kế hiện đại theo ngôn ngữ phẳng, mạnh mẽ nhưng không kém phần sang trọng cùng với vỏ hợp kim nhôm nguyên khối bền bỉ. Độ bền của máy đạt chuẩn quân đội Mỹ: chống sốc, rơi vỡ, chống va đập và chịu đựng được dưới mọi thời tiết, yên tâm sử dụng trong thời gian dài.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&lt;strong&gt;Dell Precision 7550&lt;/strong&gt;&amp;nbsp;được trang bị chip Intel Core i7 10850H có 6 nhân 12 luồng, xung nhịp tối thiểu từ 2.7GHz đến tối đa 5.1GHz siêu khỏe. Con chip này mang đến hiệu năng rất ổn định và mạnh mẽ có thể đáp ứng được những nhu cầu giải trí, làm việc hiệu suất lớn. Điểm thu hút của chiếc laptop&amp;nbsp;&lt;strong&gt;Dell 7750&lt;/strong&gt;&amp;nbsp;đấy chính là trang bị một con Card chuyên biệt dành riêng cho dân đồ họa với tiến trình lên đến 12 nm. Nvidia T1000 là nền tảng lý tưởng cho các chuyên gia 3D và các môi trường đòi hỏi cao về mảng tập dữ liệu. Với công nghệ đổ bóng vượt trội vượt hẳn với các con card RTX thông thường bạn hay thấy ở những chiếc laptop đồ họa khác nhằm cải thiện hiệu suất của khối lượng công việc nặng về trình tạo bóng pixcel và độ sâu trường ảnh, chuyển động mờ.&amp;nbsp;&lt;strong&gt;Precision 7550&amp;nbsp;&lt;/strong&gt;với cấu hình khủng như này sẽ mang đến khả năng làm việc cực mượt ở các tác vụ thiết kế đồ họa 3Ds Max, Sketchup, Maya,.. siêu khỏe hay chính là chiếc máy trạm lý tưởng dành cho dân kỹ thuật và đồ họa chuyên nghiệp.&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;p class=&quot;ql-align-justify&quot;&gt;Máy có bộ nhớ RAM dung lượng sẵn 16GB DDR4 cho phép người sử dụng có thể làm việc đa nhiệm tốt, mở khoảng 20 tabs trình duyệt hay mở nhiều ứng dụng đồ hoạ, hay render video mà không lo bị giật lag, có khả năng truy xuất dữ liệu, giúp thao tác khởi động máy và phản hồi ứng dụng trơn tru hơn. Ổ cứng SSD 256GB PCle NVMe giúp bạn có không gian đủ dùng để lưu trữ tài liệu, phần mềm cần thiết. Ngoài ra, bạn có thể lựa chọn&amp;nbsp;&lt;strong&gt;Dell Precision 7550&lt;/strong&gt;&amp;nbsp;với ổ cứng 521GB PCIe cho tốc độ load máy. ứng dung nhanh hơn.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, 1900000, '2024-04-08 16:26:44', '2024-04-08 16:26:44');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_pham_bien_the`
--

INSERT INTO `san_pham_bien_the` (`id`, `id_san_pham`, `id_bien_the`, `gia_tri`, `image`, `so_luong`, `gia_bien_the`) VALUES
(1, 1, 1, 'Đỏ', '7366_ac___laptop_c___dell_precision_7550___intel_core_i7_10750h.jpg', 5, 1000),
(2, 2, 1, 'Đỏ', 'shop01.png', 10, 1000),
(3, 3, 1, 'Đen', 'product03.png', 12, 1000),
(4, 2, 1, 'Xanh', 'shop01.png', 1, 1000),
(5, 3, 1, 'Xám', 'product03.png', 1, 1000);

