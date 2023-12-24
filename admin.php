<?php 
include "DAO/DAO.php";
include "DAO/PDO.php";
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
        case 'donhang':
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý bài viết 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoBaiViet() {
    include "admin/view/BaiViet/BaiViet.Create.php";
}

function hienThiBaiViet() {
    include "admin/view/BaiViet/BaiViet.All.php";
}

function hienThiBaiVietChiTiet() {
    include "admin/view/BaiViet/BaiViet.Custom.php";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý danh mục bài viết
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoLoaiBaiViet() {
    include "admin/view/LoaiBaiViet/LoaiBaiViet.Create.php";
}

function hienThiChiTietDanhMucBaiViet() {
    include "admin/view/LoaiBaiViet/LoaiBaiViet.Custom.php";
}

function hienThiDanhMucBaiViet() {
    include "admin/view/LoaiBaiViet/LoaiBaiViet.All.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý danh mục/loại sản phẩm
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.Create.php";
}

function hienThiLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.All.php";
}

function hienThiChiTietLoaiSanPham() {
    include "admin/view/LoaiSanPham/LoaiSanPham.Custom.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý tài khoản
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý đơn hàng
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Trang chủ
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hienThiTrangChuAdmin() {
    include "admin/view/TrangChu/index.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Thống kê (Phần này chưa cần để ý lắm)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function thongKe() {
    include "admin/view/ThongKe/ThongKe.php";
}

//Cái của nợ bên dưới nên cho hẳn một file khác
?>

<!DOCTYPE html>
<html lang="en">
<?php include "admin/view/Body/Body.Head.php"; ?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "admin/view/Body/Body.Sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "admin/view/Body/Body.Topbar.php"; ?>

                <?php 
                if (isset($_GET['act'])) {
                    $hanhDong = $_GET['act'];
                    xuLyHanhDong($hanhDong);
                } else {
                    hienThiTrangChuAdmin();
                }
                ?>

            </div>
            <!-- End of Main Content -->

        <?php include "admin/view/Body/Body.Hidden.php"; ?>
</body>
</html>

