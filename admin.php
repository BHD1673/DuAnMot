
<?php 
//Hàm xử lý hành động cho admin
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'taoloaisanpham':
            taoLoaiSanPham();
            break;
        case 'hienthiloaisanpham':
            hienThiLoaiSanPham();
            break;
        case 'hienthichitietloaisanpham':
            hienThiChiTietLoaiSanPham();
            break;
        case 'taotaikhoan':
            taoTaiKhoan();
            break;
        case 'hienthichitiettaikhoan':
            hienThiChiTietTaiKhoan();
            break;
        case 'hienthitaikhoan':
            hienThiTaiKhoan();
            break;
        case 'taodonhangonlan':
            taoDonHangOnLan();
            break;
        case 'taodonhangonline':
            taoDonHangOnline();
            break;
        case 'hienthichitietdonhang':
            hienThiChiTietDonHang();
            break;
        case 'hienthidonhang':
            hienThiDonHang();
            break;
        case 'hienthitrangchuadmin':
            hienThiTrangChuAdmin();
            break;
        case 'thongke':
            thongKe();
            break;
        case 'gioithieu':
            gioiThieu();
            break;
        case 'baiviet':
            baiViet();
            break;
        // case 'dangxuat':
        //     dangXuatNguoiDung();
        //     break;
        // case 'dangnhap':
        //     dangNhapNguoiDung();
        //     break;
        // case 'dangky':
        //     dangKyNguoiDung();
        //     break;
        // case 'quenmatkhau':
        //     quenMatKhau();
        //     break;
        default:
            hienThiTrangChuAdmin();
            break;
    }
}



function taoLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.Create.php";
}

function hienThiLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.All.php";
}

function hienThiChiTietLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.Custom.php";
}

//Phần tạo tài khoản sẽ bao gồm cả phần tạo thêm địa chỉ trong trường 
//hợp muốn tạo đơn ship cho khách hàng. Hoặc tùy. Chúa chịu đoạn này đang
//hơi lú
function taoTaiKhoan() {
    include "admin/view/TaiKhoan/TaiKhoan.Create.php";
}

//Hàm này sẽ bao gồm cả phần cập nhật, vì vẫn có khả năng có người vào chỉ muốn xem thông tin trang
function hienThiChiTietTaiKhoan() {
    include "admin/view/TaiKhoan/TaiKhoan.Custom.php";
}

function hienThiTaiKhoan() {
    include "admin/view/TaiKhoan/TaiKhoan.All.php";
}

//Onlan = Đặt hàng trực tiếp tại của hàng
//Online = Đặt hàng cho khách làm online
function taoDonHangOnLan() {
    include "admin/view/DonHang/DonHang.Create.OnLan.php";
}

function taoDonHangOnline() {
    include "admin/view/DonHang/DonHang.Create.OnLine.php";
}

function hienThiChiTietDonHang() {
    include "admin/view/DonHang/DonHang.Custom.php";
}

function hienThiDonHang() {
    include "admin/view/DonHang/DonHang.All.php";
}

function hienThiTrangChuAdmin() {
    include "admin/view/index.php";
}

function thongKe() {
    include "admin/view/ThongKe/ThongKe.php";
}

//Cái của nợ bên dưới nên cho hẳn một file khác
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php include "admin/view/head.php"; ?>
<body>
    <div id="main-wrapper" data-sidebartype="full">
        <?php 
        include "admin/view/topbar.php";
        include "admin/view/leftSidebar.php";

        if (isset($_GET['act'])) {
            $hanhDong = $_GET['act'];
            xuLyHanhDong($hanhDong);
        } else {
            hienThiTrangChuAdmin();
        }

        ?>
    </div>
    <?php include "admin/view/hidden.php"; ?>
    <div class="flotTip" style="display: none; position: absolute;"></div>
</body>
</html>

