<?php
session_start();

include "user/model/login.php";
include "user/model/pdo.php";
include "user/model/product.php";

$category = category();

include "user/view/header.php";
// Phần điều hướng chính
    if (isset($_GET['act'])) {
            $hanhDong = $_GET['act'];
            xuLyHanhDong($hanhDong);
        } else {
            include "user/view/home.php";
        }
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
                case 'search_category':
                    timkiem();
                    break;
                }
            }

    function hienthisanpham(){
        require "user/view/allsp.php";
    }
    function chitietsanpham(){
        require "user/view/detailproduct.php";
    }
    function hoadonSp(){
        require "user/view/checkout.php";
    }
    function dangNhap(){
        if(isset($_POST['submit'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $errow = check_login($user, $pass);
            if(!is_array($errow)){
                echo '<script>
                alert("Sai tên và mật khẩu");
                window.location= " http://localhost:81/duan4/index.php?act=login ";
                </script>';
                }else{
                $_SESSION['user'] = $errow;
                var_dump($errow);
                echo '<script>
                alert("Đăng Nhập Thành Công");
                window.location= " http://localhost:81/duan4/index.php ";
                </script>';
                }
        }else{
        require "user/view/user/login.php";
        }
        }
    function gioHang(){
        require "user/view/cart.php";
    }
    function dangKy(){
        if(isset($_POST['submit'])){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $phone = $_POST['phonenumber'];
            $pass = $_POST['pass'];
            $check = check_taikhoan($email,$phone);
            if(is_array($check)){
            echo '<script>
            alert("Tài khoản đã tồn tại");
            window.location= " http://localhost:81/duan4/index.php?act=singup ";
            </script>';
            }else{
            insert_taikhoan($email,$user,$pass,$phone);
            echo '<script>
            alert("Tài khoản đã tạo thành công");
            window.location= " http://localhost:81/duan4/index.php?act=login ";
            </script>';
            }
            
            require "user/view/user/login.php";
        }
        require "user/view/user/singin.php";
        
    }
    function quenMatkhau(){
        require "user/view/user/forgotPassword.php";
    }
    function timkiem(){
        if(isset($_POST['search'])){
            $id_category = $_POST['category_id'];
            if($id_category = 0 ){
                $product_category = load_all_products();
            }else {
               $product_category =  seach_product_category($id); 
            }
            require "user/view/store.php";

            
        }
    }
include "user/view/footer.php";
?>
