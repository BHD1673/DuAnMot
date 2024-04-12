<?php 
ob_start();
session_start();
require_once "model/pdo.php";
require_once "admin/model/DAO.php";
require_once "admin/model/Validate.php";
function pre_dump(...$variables)
{
    echo "<pre>";
    foreach ($variables as $variable) {
        var_dump($variable);
    }
    echo "</pre>";
}


//Hàm xử lý hành động cho admin

// Comment do nothing. I dont even thing u can read a docs, nor code comment.
// just kys
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'giatribienthe': 
            hienThiGiaTriBienThe();
            break;
        case 'bienthe':
            hienThiBienThe();
            break;
        case 'thembienthe':
            taoBienThe();
            break;
        case 'chitietbienthe':
            hienThiChiTietBienThe();
            break;
        case 'xoabienthe':
            xoaBienThe();
            break;
        case 'taosanpham':
            taoSanPham();
            break;
        case 'sanpham':
            hienThiSanPham();
            break;
        case 'chitietsanpham':
            hienThiChiTietSanPham();
            break;
        case 'xoasanpham':
            xoaSanPham();
            break;
        case 'loaisp':
            hienThiLoaiSanPham();
            break;
        case 'editloaisp':
            hienThiChiTietLoaiSanPham();
            break;
        case 'danhmucsanpham':
            hienThiLoaiSanPham();
            break;
        case 'xoaloaisp':
            xoaLoaiSanPham();
            break;
        case 'donhang':
            hienThiDonHang();
            break;
        case 'chitietdonhang':
            hienThiChiTietDonHang();
            break;
        case 'thongke':
            hienThiThongKe();
            break;
        case 'xoataikhoan':
            xoaTaiKhoan();
            break;
        case 'taikhoan':
            hienThiTaiKhoan();
            break;
        case 'chitiettaikhoan':
            hienThiChiTietTaiKhoan();
            break;
        case 'comment':
            hienThiDanhSachComment();
            break;
        case 'xoacomment':
            xoaComment();
            break;
        default:
            hienThiTrangChuAdmin();
            break;
    }
}

//dump some trash

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý biến thể
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hienThiGiaTriBienThe() {
    require_once "admin/view/BienThe/BienThe.ShowValue.php";
}

function hienThiBienThe() {
    require_once "admin/view/BienThe/BienThe.All.php";
}

function hienThiChiTietBienThe() {
    require_once "admin/view/BienThe/BienThe.Value.php";
    //require_once "admin/view/BienThe/BienThe.Edit.php";
}

function taoBienThe() {
    require_once "admin/view/BienThe/BienThe.Add.php";
}

function xoaBienThe() {
    $sql = "DELETE FROM `bien_the` WHERE `id` = " . $_GET['id'];
    pdo_execute($sql);
    header("Location: admin.php?act=bienthe");
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý danh mục/loại sản phẩm
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hienThiDanhSachComment() {
    
    require_once "admin/view/Comment/Comment.All.php";
}

function xoaComment() {
    echo "<script>alert('Đã xóa thành công!')</script>";
    $sql = "DELETE FROM `comments` WHERE comment_id = " . $_GET['id'];
    pdo_execute($sql);
    echo "<script>alert('Đã xóa thành công!')</script>";
    header("Location: admin.php?act=comment");
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
                create_danh_muc($ten_loai_san_pham, $mo_ta);
                $_SESSION['msg']['danhmuc'] = "Tạo thêm danh mục thành công";
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
            delete_danh_muc($id_loai_san_pham_to_delete);
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
        $category_details = get_danh_muc($category_id);

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

            update_danh_muc($category_id, $newName, $newDesc);
            header("Location: admin.php?act=loaisp");
        }
    }

    require_once "admin/view/LoaiSanPham/LoaiSanPham.Custom.php";
}


function xoaLoaiSanPham() {
    // if (isset($_GET['id'])) {
    //     //delete_category($_GET['id']);
    //     $_SESSION['msg']['xoadanhmuc'] = "Xoá danh mục thành công";
    //     header('LOCATION: admin.php?act=danhmuc');
    //     die;
    // } else {
    //     $_SESSION['msg']['xoadanhmuc'] = "Loại sản phẩm không tồn tại. Vui lòng thử lại";
    //     header('LOCATION: admin.php?act=danhmuc');
    //     die;
    // }
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

    if (isset($_GET['id'])) {
        try {
            if (delete_product($_GET['id'])) {
                $_SESSION['msg']['xoadanhmuc'] = "Xoá danh mục này.";
                header('LOCATION: admin.php?act=sanpham');
                die;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $_SESSION['msg']['xoadanhmuc'] = "Bạn phải xoá tất cả các biến thể của sản phẩm này thì mới có thể xoá được sản phẩm này. Vui lòng kiểm tra lại";
                header('LOCATION: admin.php?act=sanpham');
                die;
            } else {
                echo "Lỗi: " . $e->getMessage();
            }
        }
    } else {
        $_SESSION['msg']['xoadanhmuc'] = "Sản phẩm không tồn tại. Vui lòng kiểm tra lại.";
    }
    
    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý tài khoản
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function xoaTaiKhoan() {
    $sql = "DELETE FROM `nguoi_dung` WHERE `id` = " . $_GET['id'];
    pdo_execute($sql);
    echo "<script>alert('Đã xóa thành công!')</script>";
    header('location: admin.php?act=taikhoan');
}

function hienThiChiTietTaiKhoan() {
    require_once "admin/view/TaiKhoan/TaiKhoan.Custom.php";
}

function hienThiTaiKhoan() {
    require_once "admin/view/TaiKhoan/TaiKhoan.All.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý đơn hàng
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function hienThiChiTietDonHang() {
    require_once "admin/view/DonHang/DonHang.Custom.php";
}

function hienThiDonHang() {
    require_once "admin/view/DonHang/DonHang.All.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Trang chủ
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hienThiTrangChuAdmin() {
    require_once "admin/view/TrangChu/index.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// TODO: Thống kê (Phần này chưa cần để ý lắm)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hienThiThongKe() {
    require_once "admin/view/ThongKe/ThongKe.php";
}

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

