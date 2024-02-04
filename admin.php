<?php 
ob_start();
session_start();
include "DAO/Validate.php";
include "DAO/DAO.php";
include "DAO/PDO.php";
//Hàm xử lý hành động cho admin
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'deletebrand':
            xoaBrand();
            break;
        case 'editbrand':
            hienThiChiTietBrand();
            break;
        case 'taobrand': 
            taoBrand();
            break;
        case 'brand':
            hienThiBrand();
            break;
        case 'taosanpham':
            taoSanPham();
            break;
        case 'sanpham':
            hienThiSanPham();
            break;
        case 'chitietsanpham';
            hienthiChiTietSanPham();
            break;
        case 'loaisp':
            hienThiLoaiSanPham();
            break;
        case 'editloaisp':
            hienThiChiTietLoaiSanPham();
            break;
        default:
            hienThiTrangChuAdmin();
            break;
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý brand
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoBrand() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $brandName = $_POST["brand_name"];
        $brandDescription = $_POST["quill_content"];
        $createBrandErrors = validateBrandValue($brandName);
        $brandDescriptionError = validateQuill($brandDescription);
        // echo "<pre>";
        // var_dump($brandName, htmlentities($brandDescription));
        // var_dump($brandDescriptionError);
        // var_dump($createBrandErrors);
        // echo "</pre>";
        if (empty($createBrandErrors) || empty($brandDescriptionError)) {
            insertBrand($brandName, $brandDescription);
            $_SESSION['message']['insertBrand'] = "Đã tạo brand mới";
            header("Location: admin.php?act=brand");
        } else {
            echo "b";
        }
    }
    require_once "admin/view/Brand/Brand.Create.php";
}

function hienThiBrand() {
    $brandInfor = viewBrand();
    include "admin/view/Brand/Brand.View.php";
}

function hienThiChiTietBrand() {    
    // $id = $_GET["id"];
    // echo $id;
    include "admin/view/Brand/Brand.Custom.php";
}

function xoaBrand() {
    $id = $_GET["id"];
    deleteBrand($id);
    $_SESSION['message']['deleteBrand'] = "Đã xoá danh mục sản phẩm thành công";
    header("Location: admin.php?act=brand");
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
                insertCategory($ten_loai_san_pham, $mo_ta);
                // displaySuccessModal("Product Type created successfully!", 3000); // 3000 milliseconds = 3 seconds
                header("Location: admin.php?act=loaisp");
            } else {
                // Validate có dữ liệu không đạt yêu cầu, trả lại kết quả.
                // Đặt lỗi trong mảng, nên sẽ foreach ra kết quả. Có thể dùng modal box
                foreach ($validationErrors as $error): ?>
                    <p>Error: <?= $error ?></p>
                <?php endforeach;
            }
        } elseif (isset($_POST["delete"])) {
            // Delete operation
            $id_loai_san_pham_to_delete = $_POST["id_loai_san_pham"];
            deleteCategory($id_loai_san_pham_to_delete);
        }
    }
    $rows = viewCategory();
    ?>
    <?php 
    require_once "admin/view/LoaiSanPham/LoaiSanPham.All.php";
}

function hienThiChiTietLoaiSanPham() {
    // Nhận Id danh mục từ URL
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        // Thao tác SQL
        $category_details = viewCategoryOne($category_id);

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
            $new_ten_loai_san_pham = $_POST["new_ten_loai_san_pham"];
            $new_mo_ta = $_POST["new_mo_ta"];
            $newData = array(
                "ten_loai_san_pham" => $new_ten_loai_san_pham,
                "mo_ta" => $new_mo_ta
            );
            updateCategory($category_id, $newData);
            header("Location: admin.php?act=loaisp");
        }
    }
    require_once "admin/view/LoaiSanPham/LoaiSanPham.Custom.php";
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý tài khoản
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Phần tạo tài khoản sẽ bao gồm cả phần tạo thêm địa chỉ trong trường 
//hợp muốn tạo đơn ship cho khách hàng. Hoặc tùy. Chúa chịu đoạn này đang
//hơi lú
function taoTaiKhoan() {
    require_once "admin/view/TaiKhoan/TaiKhoan.Create.php";
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
// Thống kê (Phần này chưa cần để ý lắm)
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

