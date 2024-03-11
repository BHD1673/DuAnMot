<?php 
ob_start();
session_start();
include "DAO/Validate.php";
include "DAO/DAO.php";
include "DAO/PDO.php";
//Hàm xử lý hành động cho admin
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'taosanpham':
            taoSanPham();
            break;
            // Phần hiển thị tổng thể tất cả sản phẩm có thể sẽ chỉ hiển thị sơ qua
            // sẽ chỉ hiển thị chi tiết khi vào trang chi tiết sản phẩm
        case 'sanpham':
            hienThiSanPham();
            break;
        case 'chitietsanpham':
            hienThiChiTietSanPham();
            break;
        case 'xoasanpham':
            // Có thể thêm thanh trạng thái trong db cho phần sản phẩm, để sản phẩm khi xoá thì sẽ chỉ ẩn tạm thời
            // rồi viết một cái cronjob cho tầm n thời gian nếu quá cái n thời gian đấy thì mới xoá chính thức
            // cho như một cái lịch sử
            // HOẶC DẸP
            xoaSanPham();
            break;
        case 'loaisp':
            hienThiLoaiSanPham();
            break;
        case 'editloaisp':
            hienThiChiTietLoaiSanPham();
            break;
        case 'danhmucsanpham':
            //Ghi chú: Phần danh mục sản phẩm gộp luôn cái form thêm danh mục
            //nên không cần viết thêm cái thêm danh mục 
            hienThiLoaiSanPham();
            break;
        case 'xoaloaisp':
            xoaLoaiSanPham();
            break;
        case 'oof':
            echo "WHAT ?";
            break;

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
function hienThiLoaiSanPham() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["create"])) {
            // Nhận dữ liệu
            $ten_loai_san_pham = $_POST["ten_loai_san_pham"];
            $mo_ta = $_POST["mo_ta"];

            // Validate dữ liệu từ form
            $validationErrors = validateCreate($ten_loai_san_pham, $mo_ta);

            // Nếu mảng dữ liệu trống thì sẽ gửi
            if (empty($validationErrors)) {
                create_category($ten_loai_san_pham, $mo_ta);
                header("Location: admin.php?act=loaisp");
            } else {
                // Validate có dữ liệu không đạt yêu cầu, trả lại kết quả.
                // Đặt lỗi trong mảng, nên sẽ foreach ra kết quả. Có thể dùng modal box
                foreach ($validationErrors as $error): ?>
                    <p>Error: <?php echo $error ?></p>
                <?php endforeach;
            }
        } elseif (isset($_POST["delete"])) {
            // Xoá sản phẩm
            $id_loai_san_pham_to_delete = $_POST["id"];
            delete_category($id_loai_san_pham_to_delete);
        }
    }
    ?>
    <?php 
    require_once "admin/view/LoaiSanPham/LoaiSanPham.All.php";
}

function hienThiChiTietLoaiSanPham() {

        // Nhận Id danh mục từ URL
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        // Thao tác SQL
        $category_details = get_category($category_id);

        if (!$category_details) {
            echo "Danh mục không tồn tại.";
            exit;
        }
    } else {
        require_once "admin/view/Error/404.php";
        exit;
    }

    // Xử lý form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["update"])) {
            // Như trên.
            $newName = $_POST["new_ten_loai_san_pham"];
            $newDesc = $_POST["new_mo_ta"];

            update_category($category_id, $newName, $newDesc);
            header("Location: admin.php?act=loaisp");
        }
    }

    require_once "admin/view/LoaiSanPham/LoaiSanPham.Custom.php";
}


function xoaLoaiSanPham() {
    if (isset($_GET['id'])) {
        delete_category($_GET['id']);
        $_SESSION['msg']['xoadanhmuc'] = "Xoá danh mục thành công";
        header('LOCATION: admin.php?act=danhmuc');
        die;
    } else {
        $_SESSION['msg']['xoadanhmuc'] = "Loại sản phẩm không tồn tại. Vui lòng thử lại";
        header('LOCATION: admin.php?act=danhmuc');
        die;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý sản phẩm
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoSanPham() {
    require_once "admin/view/SanPham/SanPham.Add.php";
}


function hienThiSanPham() {
    require_once "admin/view/SanPham/SanPham.All.php";
}

function hienThiChiTietSanPham() {
    require_once "admin/view/SanPham/SanPham.Custom.php";
}

function xoaSanPham() {
    // Ở trang xoá sản phẩm thì chỉ cần tạo request với cái header
    // còn confirm thì tạo từ trong phần danh sách từ trước luôn cho tiện
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý tài khoản
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Phần tạo tài khoản sẽ bao gồm cả phần tạo thêm địa chỉ trong trường 
//hợp muốn tạo đơn ship cho khách hàng. Hoặc tùy. Chúa chịu đoạn này đang
//hơi lú
//Có thể để sau cùng vì nghe hơi ngáo, có thể chỉ dành cho admin
function taoTaiKhoan() {
    require_once "admin/view/TaiKhoan/TaiKhoan.Create.php";
}

//Hàm này sẽ bao gồm cả phần cập nhật, vì vẫn có khả năng có người vào chỉ muốn xem thông tin trang
//TODO: Xử lý qua js cho cái trang này có nút có thể chuyển từ form hiện thông tin thành điền được thông tin
//với cái điều kiện là nó phải nhất nút sửa tài khoản, còn không thì chỉ xem qua
function hienThiChiTietTaiKhoan() {
    include "admin/view/TaiKhoan/TaiKhoan.Custom.php";
}

function hienThiTaiKhoan() {
    include "admin/view/TaiKhoan/TaiKhoan.All.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý đơn hàng
//TODO: NHỚ VIẾT
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Onlan = Đặt hàng trực tiếp tại của hàng
//Online = Đặt hàng cho khách làm online

function taoDonHangOnLan() {
    include "admin/view/DonHang/DonHang.Create.OnLan.php";
}

function taoDonHangOnline() {
    include "admin/view/DonHang/DonHang.Add.php";
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
// TODO: Thống kê (Phần này chưa cần để ý lắm)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function thongKe() {
    include "admin/view/ThongKe/ThongKe.php";
}

//Cái của nợ bên dưới nên cho hẳn một file khác
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once("admin/view/Body/Body.Head.php");?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once ("admin/view/Body/Body.Sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once ("admin/view/Body/Body.Topbar.php"); ?>
                <div class="container-fluid">
                <?php 
                if (isset($_GET['act'])) {
                    $hanhDong = $_GET['act'];
                    xuLyHanhDong($hanhDong);
                } else {
                    hienThiTrangChuAdmin();
                }
                ?>
                </div>
            </div>
        <?php require_once("admin/view/Body/Body.Hidden.php"); ?>
</body>
</html>

