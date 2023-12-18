-- Bảng khách hàng
CREATE TABLE khachhang (
    id_khach_hang INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    ten_khach_hang VARCHAR(225) NULL,
    email_khach_hang VARCHAR(225) NULL,
    so_dien_thoai VARCHAR(20) NULL,
    ngay_tao_tai_khoan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ngay_cap_nhat TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    mat_khau VARCHAR(255) NULL,
    role VARCHAR(50) NULL
);

-- Bảng hóa đơn
CREATE TABLE hoadon (
    id_hoa_don INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_khach_hang INT,
    ten_san_pham VARCHAR(255) NULL,
    FOREIGN KEY (id_khach_hang) REFERENCES khachhang(id_khach_hang)
);

-- Bảng giỏ hàng tạm thời
CREATE TABLE giohang_session (
    id_gio_hang INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_khach_hang INT,
    id_san_pham INT,
    so_luong INT,
    gia_san_pham DECIMAL(10, 2),
    FOREIGN KEY (id_khach_hang) REFERENCES khachhang(id_khach_hang),
    FOREIGN KEY (id_san_pham) REFERENCES sanpham(id_san_pham)
);

-- Bảng sản phẩm
CREATE TABLE sanpham (
    id_san_pham INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    ten_san_pham VARCHAR(255) NOT NULL,
    gia DECIMAL(10, 2) NOT NULL,
    so_luong INT NOT NULL,
    mo_ta TEXT,
    id_loai_san_pham INT,
    id_brand INT,
    mau_sac VARCHAR(50),
    FOREIGN KEY (id_loai_san_pham) REFERENCES loaisanpham(id_loai_san_pham),
    FOREIGN KEY (id_brand) REFERENCES brand(id_brand)
);

-- Bảng loại sản phẩm
CREATE TABLE loaisanpham (
    id_loai_san_pham INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    ten_loai_san_pham VARCHAR(255) NOT NULL
);

-- Bảng thương hiệu (brand)
CREATE TABLE brand (
    id_brand INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    ten_brand VARCHAR(255) NOT NULL,
    mo_ta_brand TEXT
);

-- Add foreign key to hoadon table
ALTER TABLE hoadon
ADD COLUMN id_khach_hang INT,
ADD CONSTRAINT fk_hoadon_khachhang
FOREIGN KEY (id_khach_hang) REFERENCES khachhang(id_khach_hang);

-- Add foreign key to giohang_session table
ALTER TABLE giohang_session
ADD COLUMN id_khach_hang INT,
ADD COLUMN id_san_pham INT,
ADD CONSTRAINT fk_giohang_khachhang
FOREIGN KEY (id_khach_hang) REFERENCES khachhang(id_khach_hang),
ADD CONSTRAINT fk_giohang_sanpham
FOREIGN KEY (id_san_pham) REFERENCES sanpham(id_san_pham);

-- Add foreign key to sanpham table
ALTER TABLE sanpham
ADD COLUMN id_loai_san_pham INT,
ADD COLUMN id_brand INT,
ADD CONSTRAINT fk_sanpham_loaisanpham
FOREIGN KEY (id_loai_san_pham) REFERENCES loaisanpham(id_loai_san_pham),
ADD CONSTRAINT fk_sanpham_brand
FOREIGN KEY (id_brand) REFERENCES brand(id_brand);
