<?php
ob_start();
session_start();

include "model/login.php";
include "model/pdo.php";
include "model/product.php";
include "model/cart.php";
include "model/comment.php";
include "indexRoute.php";
$category = category();

function pre_dump(...$variables)
{
    echo "<pre>";
    foreach ($variables as $variable) {
        var_dump($variable);
    }
    echo "</pre>";
}

function create_guest_session()
{
    if (!isset($_SESSION['guest_id'])) {
        $guest_id = uniqid('guest_');
        $_SESSION['guest_id'] = $guest_id;
    }
}

function setPageTitle($title) {
    echo "<script>document.title = '$title';</script>";
}

create_guest_session();

if (isset($_SESSION['user']) && $_SESSION['user']['id'] !== null) {
    $_SESSION['user_identify'] = $_SESSION['user']['id'];
} else {
    $_SESSION['user_identify'] = $_SESSION['guest_id'];
}



function hienthisanpham()
{
    $product = show_product();
    require_once "view/allsp.php";
}
function chitietsanpham()
{
    if (isset($_GET['id_sp']) && ($_GET['id_sp'] > 0)) {
        $list_comments = load_comments($_GET['id_sp']); // Load comments for the specified product
    }
    require_once "view/detailproduct.php"; // Include your HTML template
}
function hienThiDonHang()
{
    require_once "view/checkout.php";
}
function dangNhap()
{
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $error = check_login($user, $pass);
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            echo '<script>
            alert("Vui lòng điền đầy đủ thông tin");
            window.location= "index.php?act=login";
            </script>';
            exit; // Dừng việc thực thi tiếp tục nếu có trường trống
        }
        if (!is_array($error)) {
            echo '<script>
            alert("Sai tên và mật khẩu");
            window.location= " index.php?act=login ";
            </script>';
        } else {
            $_SESSION['user'] = $error;
            if ($_SESSION['user']['role'] == '1') {
                // Nếu là admin
                echo '<script>
                alert("Đăng Nhập Thành Công - Quản trị viên");
                window.location= "index.php"; // Đường dẫn đến trang quản trị
                </script>';
            } elseif ($_SESSION['user']['role'] == '') {
                // Nếu là user
                echo '<script>
                alert("Đăng Nhập Thành Công - Người dùng");
                window.location= "index.php"; // Đường dẫn đến trang người dùng
                </script>';
            }
        }
    } else {
        require "view/user/login.php";
    }
}
function gioHang()
{
    if (empty($_SESSION['user'])) {
        $_SESSION['msg']['cart-warning'] = "Vui lòng đăng nhập để có thể mua hàng !";
        header('Location: index.php?act=login');
        exit;
    }
    $cartItems = getCartValue();
    // pre_dump($cart);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['quantity']) && isset($_POST['item_id'])) {
    
            $item_id = $_POST['item_id'];
            $quantity_change = $_POST['quantity'] == '+' ? 1 : -1;
    
            try {
                $sql_update_quantity = "UPDATE gio_hang SET so_luong = so_luong + ? WHERE id = ?";
                pdo_execute($sql_update_quantity, $quantity_change, $item_id);
                $sql_check_quantity = "SELECT so_luong FROM gio_hang WHERE id = ?";
                $current_quantity = pdo_query_one($sql_check_quantity, $item_id)['so_luong'];
                if ($current_quantity <= 0) {
                    $sql_remove_product = "DELETE FROM gio_hang WHERE id = ?";
                    pdo_execute($sql_remove_product, $item_id);
                }
    
                header("location: index.php?act=cart");
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
            } finally {
                unset($conn);
            }
        }
    }
    
    
    require_once "view/cart/cart.php";
}

function thanhToan() {

    

    require_once "view/cart/checkoutFake.php";
}

function datHangThanhCong() {

    require_once "view/cart/checkoutsuccessFake.php";
}

function dangKy()
{
    if (isset($_POST['submit'])) {
        // Kiểm tra xem các trường đã được điền đầy đủ không
        $user = $_POST['user'];
        $email = $_POST['email'];
        $phone = $_POST['phonenumber'];
        $pass = $_POST['pass'];
        $check = check_taikhoan($email, $phone);
        if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['phonenumber']) || empty($_POST['pass'])) {
            echo '<script>
            alert("Vui lòng điền đầy đủ thông tin");
            window.location= "index.php?act=singup";
            </script>';
            exit; // Dừng việc thực thi tiếp tục nếu có trường trống
        }
    
        // Kiểm tra tính hợp lệ của tên người dùng (không có dấu và khoảng trắng)
        if (preg_match('/[^a-zA-Z0-9]/', $_POST['user'])) {
            echo '<script>
            alert("Tên không được chứa dấu và khoảng trắng");
            window.location= "index.php?act=singup";
            </script>';
            exit;
        }
    
        // Kiểm tra tính hợp lệ của email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<script>
            alert("Email không hợp lệ");
            window.location= "index.php?act=singup";
            </script>';
            exit;
        }
    
        // Kiểm tra tính hợp lệ của số điện thoại
        if (!preg_match("/^[0-9]{10}$/", $_POST['phonenumber'])) {
            echo '<script>
            alert("Số điện thoại không hợp lệ");
            window.location= "index.php?act=singup";
            </script>';
            exit;
        }
    
        // Kiểm tra tính hợp lệ của mật khẩu (ví dụ: ít nhất 8 ký tự, bao gồm ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt)
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST['pass'])) {
            echo '<script>
            alert("Mật khẩu không hợp lệ");
            window.location= "index.php?act=singup";
            </script>';
            exit;
        }
        if (is_array($check)) {
            echo '<script>
            alert("Tài khoản đã tồn tại");
            window.location= " index.php?act=singup ";
            </script>';
        } else {
            insert_taikhoan($email, $user, $pass, $phone);
            echo '<script>
            alert("Tài khoản đã tạo thành công");
            window.location= " index.php?act=login ";
            </script>';
        }
    
       }
    require_once "view/user/singin.php";
}
function quenMatkhau()
{
    require_once "view/user/forgotPassword.php";
}

function chiTietKhachHang() {

    if (isset($_GET['msg']) == "xoathanhcong") {
        echo "Xoá thành công";
    }
    require_once "view/user/profile.php";
}

function hienThiLichSuMuaHang() {

    require_once "view/user/history.php";
}

function hienThiDiaChiKhachHang() {

    require_once "view/user/address.php";
}

function themDiaChiKhachHang() {

    require_once "view/user/addAddress.php";
}

function capNhatDiaChiKhachHang() {

    require_once "view/user/editAddress.php";
}

function xoaDiaChiKhachHang() {

    $sql = "DELETE FROM dia_chi_nguoi_dung WHERE `dia_chi_nguoi_dung`.`id` = " . $_GET['id'];
    pdo_execute($sql);
    header('location: index.php?act=profile&msg=xoathanhcong');
}

function timkiem()
{
    $category_id = $_GET['category_id'] ?? "";
    $product_name = $_GET['product_name'] ?? "";
    $search_result = get_item_by_category_or_name($category_id, $product_name);

    require_once "view/store.php";
}

function hienThiLichSuDatHang() {
    
    require_once "view/user/orderLog.php";
}

function hienThiChiTietDonHang() {

    require_once "view/user/orderDetail.php";
}

function xoaKhoiGioHang() {

    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
        $sql = "DELETE FROM gio_hang WHERE id = ?";
        pdo_execute($sql, $item_id);
        header("location: index.php?act=cart");
    } else {
        header("location: index.php?act=cart");
    }
}

function huyDonHang() {

    $sql = "UPDATE `orders` SET `trang_thai` = 'Huỷ đơn hàng' WHERE `orders`.`order_id` = ?";
    pdo_execute($sql, $_GET['id']);
}

function hienThiTrangHoTro() {
    
    require_once "view/non/contact.php";
}
require_once "view/header.php";
// Phần điều hướng chính
if (isset($_GET['act'])) {
    $hanhDong = $_GET['act'];
    xuLyHanhDong($hanhDong);
} else {
    $product = show_product();
    require_once "view/home.php";
}
require_once "view/footer.php";


