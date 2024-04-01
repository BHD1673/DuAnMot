<?php
ob_start();
session_start();

include "model/login.php";
include "model/pdo.php";
include "model/product.php";
include "model/cart.php";
$category = category();

function pre_dump($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function create_guest_session() {
    if (!isset($_SESSION['guest_id'])) {
        $guest_id = uniqid('guest_');
        $_SESSION['guest_id'] = $guest_id;
    }
}

create_guest_session();

if (isset($_SESSION['user']) && $_SESSION['user']['id'] !== null) {
    // If user is logged in, assign $_SESSION['user']['id'] to $_SESSION['user_identify']
    $_SESSION['user_identify'] = $_SESSION['user']['id'];
} else {
    // If user is not logged in, assign guest_id to $_SESSION['user_identify']
    $_SESSION['user_identify'] = $_SESSION['guest_id'];
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
        function xuLyHanhDong($hanhDong) {
            switch ($hanhDong) {
                case 'unsetLoginValue':
                    echo "<pre>";
                    var_dump($_SESSION);
                    echo "</pre>";
                    unset($_SESSION['user']);
                    $_SESSION['msg']['logout'] = "Bạn đã đăng xuất";
                    header("LOCATION: index.php");
                    break;
                case 'product':
                    hienthisanpham();
                    break;
                case 'detailProduct':
                    chitietsanpham();
                    break;
                case 'checkout':
                    hoadonSp();
                    break;
                case 'cart':
                    gioHang();
                    break;
                case 'login':
                    dangNhap();
                    break;
                case 'singup':
                    dangKy();
                    break;
                case 'forgot':
                    quenMatkhau();
                    break;
                case 'search_category':
                    timkiem();
                    break;
                case 'dump':
                    // Kiểm tra cái header xem nó có bị vướng với cái include nào không tránh trường hợp dính vào nhau rồi lôi nhau ra đánh
                    echo "ăklfjalwjfawl";
                    break;
                }
            }

    function hienthisanpham(){
        $product = show_product();
        require_once "view/allsp.php";
    }
    function chitietsanpham(){
        require_once "view/detailproduct.php";
    }
    function hoadonSp(){
        require_once "view/checkout.php";
    }
    function dangNhap(){
        if(isset($_POST['submit'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $errow = check_login($user, $pass);
            if(!is_array($errow)){
                 $_SESSION['msg']['login'] = "Đăng nhập thất bại, có vấn đề, vui lòng kiểm tra lại";
                 header('LOCATION: index.php?act=login');
                }else{
                $_SESSION['user'] = $errow;
                var_dump($errow);
                $_SESSION['msg']['login'] = "Đăng nhập thành công";
                header("LOCATION: index.php");
                    
                }
        }else{
        require_once "view/user/login.php";
        }
    }
    function gioHang(){
        require_once "view/cart/cart.php";
    }
    function dangKy(){
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
                // Assuming insert_taikhoan() is a function defined elsewhere
                insert_taikhoan($email, $username, $password, $phoneNumber);
                $_SESSION['msg']['register'] = 'Đăng ký tài khoản thành công';
                header("Location: index.php?act=login");
                exit(); // Always exit after a header redirect
            } else {
                $_SESSION['errors'] = $errors; // Store errors in session
                header("Location: index.php?act=singup");
                exit();
            }
        }
        require_once "view/user/singin.php";
    }
    function quenMatkhau(){
        require_once "view/user/forgotPassword.php";
    }

    function timkiem(){
        $category_id = $_GET['category_id'] ?? "";
        $search_result = get_item_by_category($category_id);

        require_once "view/store.php";
    }


require_once "view/footer.php";
?>
