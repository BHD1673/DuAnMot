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
