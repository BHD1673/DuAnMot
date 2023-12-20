-- Bảng khách hàng
CREATE TABLE khachhang() {
    id_khach_hang INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ten_khach_hang VARCHAR(225) NULL,
    email_khach_hang VARCHAR(225) NULL,
    so_dien_thoai VARCHAR(225) NULL, --Lí do mà cái sdt nó phải set như thế này vì còn trường hợp nhập tên quốc gia vào, như +84 
    ngay_tao TIMESTAMP,
    ngay_cap_nhat TIMESTAMP,
    mat_khau VARCHAR(225),
}

CREATE TABLE hoadon() {
    id_hoa_don INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_khach_hang INT NULL,
    ten_san_pham TEXT NULL,
    gia_tri_san_pham TEXT NULL,
    so_luong_san_pham TEXT NULL,
    tong_gia_tri_tung_san_pham TEXT NULL,
    tong_don_hang TEXT NULL
}

CREATE TABLE giohang() {
    id_gio_hang INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_khach_hang INT NULL,
    tong_gio_hang INT NULL,
}

CREATE TABLE item.giohang() {
    id_item INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_gio_hang INT NULL,
    id_san_pham INT NULL,
    so_luong_san_pham INT NULL,
}

CREATE TABLE danhmuc() {
    id_danh_muc INT PRIMARY KEY NOT NULL,
    ten_danh_muc VARCHAR(225),
    mo_ta_danh_muc TEXT,
    ngay_tao TIMESTAMP,
    ngay_cap_nhat TIMESTAMP
}

CREATE TABLE sanpham() {
    id_san_pham INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ten_san_pham VARCHAR(225) NULL,
    mo_ta_san_pham TEXT NULL,
    gia_san_pham DECIMAL(10,3),
    ngay_tao TIMESTAMP,
    ngay_cap_nhat TIMESTAMP,
}
CREATE TABLE `danhmuc` (
  `id_danh_muc` INT PRIMARY KEY NOT NULL,
  `ten_danh_muc` VARCHAR(225),
  `mo_ta_danh_muc` TEXT,
  `ngay_tao` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `sanpham` (
  `id_san_pham` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_danh_muc` INT,
  `so_luong_san_pham` INT,
  `ten_san_pham` VARCHAR(225),
  `mo_ta_san_pham` TEXT,
  `gia_san_pham` DECIMAL(10,3),
  `so_luot_xem` INT DEFAULT 0,
  `so_luot_mua` INT DEFAULT 0,
  `ngay_tao` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_danh_muc`) REFERENCES `danhmuc` (`id_danh_muc`)
);

CREATE TABLE `khachhang` (
  `id_khach_hang` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ten_khach_hang` VARCHAR(225),
  `email_khach_hang` VARCHAR(225),
  `so_dien_thoai` VARCHAR(225),
  `ngay_tao` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ngay_cap_nhat` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `mat_khau` VARCHAR(225)
);

CREATE TABLE `diachikhachhang` (
  `id_dia_chi` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_khach_hang` INT,
  `dia_chi` VARCHAR(225),
  `thanh_pho` VARCHAR(225),
  `huyen` VARCHAR(225),
  `xa` VARCHAR(225),
  `so_dien_thoai` VARCHAR(225),
  FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`)
);

CREATE TABLE `hoadon` (
  `id_hoa_don` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_khach_hang` INT,
  `ten_san_pham` TEXT,
  `gia_tri_san_pham` TEXT,
  `so_luong_san_pham` TEXT,
  `tong_gia_tri_tung_san_pham` TEXT,
  `tong_don_hang` TEXT,
  FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`)
);

CREATE TABLE `giohang` (
  `id_gio_hang` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_khach_hang` INT,
  `tong_gio_hang` INT,
  FOREIGN KEY (`id_khach_hang`) REFERENCES `khachhang` (`id_khach_hang`)
);

CREATE TABLE `item_giohang` (
  `id_item` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_gio_hang` INT,
  `id_san_pham` INT,
  `so_luong_san_pham` INT,
  FOREIGN KEY (`id_gio_hang`) REFERENCES `giohang` (`id_gio_hang`),
  FOREIGN KEY (`id_san_pham`) REFERENCES `sanpham` (`id_san_pham`)
);
