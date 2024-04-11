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
        $errow = check_login($user, $pass);
        if (!is_array($errow)) {
            $_SESSION['msg']['login'] = "Đăng nhập thất bại, có vấn đề, vui lòng kiểm tra lại";
            header('LOCATION: index.php?act=login');
        } else {
            $_SESSION['user'] = $errow;
            var_dump($errow);
            $_SESSION['msg']['login'] = "Đăng nhập thành công";
            header("LOCATION: index.php");
        }
    } else {
        require_once "view/user/login.php";
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();

        if (empty($_POST["user"])) {
            $errors["user"] = "Username is required";
        } else {
            $username = $_POST["user"];
        }

        if (empty($_POST["email"])) {
            $errors["email"] = "Email is required";
        } else {
            $email = $_POST["email"];
        }

        if (empty($_POST["pass"])) {
            $errors["pass"] = "Password is required";
        } else {
            $password = $_POST["pass"];
        }

        if (empty($_POST["phonenumber"])) {
            $errors["phonenumber"] = "Phone number is required";
        } else {
            $phoneNumber = $_POST["phonenumber"];
        }

        if (empty($errors)) {
            insert_taikhoan($email, $username, $password, $phoneNumber);
            $_SESSION['msg']['register'] = 'Đăng ký tài khoản thành công';
            header("Location: index.php?act=login");
            exit();
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: index.php?act=singup");
            exit();
        }
    }
    require_once "view/user/singin.php";
}
function quenMatkhau()
{
    require_once "view/user/forgotPassword.php";
}

function chiTietKhachHang() {

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

    require_once "view/user/updateAddress.php";
}

function xoaDiaChiKhachHang() {

    // Riêng mấy cái xoá này không cần phải require vào làm gì
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


