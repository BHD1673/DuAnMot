<?php
session_start();
require_once 'DAO/PDO.php';
require_once "DAO/DAO.php";

// Chi them ten mien voi ham tuong ung o day, khong them gi khac
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
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
        }
    }


function hienthisanpham(){
    require_once "user/view/allsp.php";
}
function chitietsanpham(){
    require_once "user/view/detailproduct.php";
}
function hoadonSp(){
    require_once "user/view/checkout.php";
}
function dangNhap(){
    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $email = $_POST['email'];
        $phone = $_POST['phonenumber'];
        $pass = $_POST['pass'];
        insert_taikhoan($email,$user,$pass,$phone);
    }
    require_once "user/view/user/login.php";
}
function gioHang(){
    require_once "user/view/cart.php";
}
function dangKy(){
    
    require_once "user/view/user/singin.php";
}
function quenMatkhau(){
    require_once "user/view/user/forgotPassword.php";
}



require_once "user/view/header.php";
// Phần điều hướng chính
if (isset($_GET['act'])) {
        $hanhDong = $_GET['act'];
        xuLyHanhDong($hanhDong);
} else {
    include "user/view/home.php";
}
require_once "user/view/footer.php";

