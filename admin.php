<?php 
ob_start();
include "DAO/DAO.php";
include "DAO/PDO.php";
//Hàm xử lý hành động cho admin
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'taosanpham':
            taoSanPham();
            break;
        case 'sanpham':
            hienThiSanPham();
            break;
        case 'chitietsanpham';
            hienthiChiTietSanPham();
            break;
        case 'hienthiloaisanpham':
            hienThiLoaiSanPham();
            break;
        case 'taotaikhoan':
            taoTaiKhoan();
            break;
        case 'chitiettaikhoan':
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
        case 'chitietdon':
            hienThiChiTietDonHang();
            break;
        case 'donhang':
            hienThiDonHang();
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
        default:
            hienThiTrangChuAdmin();
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
    include "admin/view/LoaiSanPham/LoaiSanPham.All.php";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Phần xử lý danh mục/loại sản phẩm
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function taoSanPham() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Phần lấy data form
        $itemName = isset($_POST['itemName']) ? $_POST['itemName'] : "";
        $itemBrand = isset($_POST['itemBrand']) ? $_POST['itemBrand'] : "";
        $itemDescription = isset($_POST['itemDescription']) ? $_POST['itemDescription'] : "";
        $itemSelectedColors = isset($_POST['selectedColors']) ? $_POST['selectedColors'] : "";
        $itemType = isset($_POST['itemType']) ? $_POST['itemType'] : "";
        $itemSmallSellPrice = isset($_POST['itemSmallSellPrice']) ? $_POST['itemSmallSellPrice'] : "";
        $itemBigSellPrice = isset($_POST['itemBigSellPrice']) ? $_POST['itemBigSellPrice'] : "";
        $itemBuyPrice = isset($_POST['itemBuyPrice']) ? $_POST['itemBuyPrice'] : "";

        if (empty($itemName) || empty($itemBrand) || empty($itemDescription) || empty($itemSelectedColors) || empty($itemType) || empty($itemSmallSellPrice) || empty($itemBigSellPrice) || empty($itemBuyPrice)) {
            echo 'Không được bỏ trống bất kì trường nào';
        } else {
            // Địa chỉ ảnh được cho 
            $uploadDir = "assets/upload/";
            
            // Lấy tên file
            $fileName = isset($_FILES['itemImage']['name']) ? $_FILES['itemImage']['name'] : "";
            
            // Đặt vị trí file sẽ được cho vào
            $targetFile = $uploadDir . $fileName;

            // Kiểm tra nếu có file trùng tên
            // Nếu có file trùng tên thật thì sẽ thêm (số) vào tên file
            // để tránh conflict file
            $counter = 1;
            while (file_exists($targetFile)) {
                $fileInfo = pathinfo($fileName);
                $fileName = $fileInfo['filename'] . "($counter)." . $fileInfo['extension'];
                $targetFile = $uploadDir . $fileName;   
                $counter++;
            }

            var_dump($itemName, $itemBrand, $itemDescription, $itemSelectedColors, $itemType, $itemSmallSellPrice, $itemBigSellPrice, $itemBuyPrice, $fileName);

            // Xử lý tập tin đã được gửi lên chưa
            if (move_uploaded_file(isset($_FILES['itemImage']['tmp_name']) ? $_FILES['itemImage']['tmp_name'] : "", $targetFile)) {
                echo 'File đã được gửi hoàn';
            } else {
                echo 'Lỗi tải file.';
            }

            // Phần thế header vì lỗi quần què gì đấy. Đặt mặc định là 5000 mili sec cho 5 giây
            echo '
            <script>
            setTimeout(function() {
                window.location.href = "admin.php";
            }, 5000); // 5000 milliseconds = 5 seconds
            </script>';
        }
    }
    include "admin/view/SanPham/SanPham.Add.php";
}


function hienThiSanPham() {
    include "admin/view/SanPham/SanPham.All.php";
}

function hienThiChiTietSanPham() {
    include "admin/view/SanPham/SanPham.Custom.php";
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

                <!-- Begin Page Content -->
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
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        <?php include "admin/view/Body/Body.Hidden.php"; ?>
</body>
</html>

