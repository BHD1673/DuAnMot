<?php
session_start();

include "model/login.php";
include "model/pdo.php";
include "model/product.php";
$category = category();

include "view/header.php";
// Phần điều hướng chính
    if (isset($_GET['act'])) {
            $hanhDong = $_GET['act'];
            xuLyHanhDong($hanhDong);
        } else {
            $product = show_product();
            include "view/home.php";
        }
        function xuLyHanhDong($hanhDong) {
            switch ($hanhDong) {
                case 'unset':
                    //doing something
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
                }
            }

    function hienthisanpham(){
        $product = show_product();
        require "view/allsp.php";
    }
    function chitietsanpham(){
        require "view/detailproduct.php";
    }
    function hoadonSp(){
        require "view/checkout.php";
    }
    function dangNhap(){
        if(isset($_POST['submit'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $errow = check_login($user, $pass);
            if(!is_array($errow)){
                return $_SESSION['msg']['login'] = "Đăng nhập thất bại, có vấn đề, vui lòng kiểm tra lại";
                }else{
                $_SESSION['user'] = $errow;
                var_dump($errow);
                echo '<script>
                alert("Đăng Nhập Thành Công");
                window.location= " admin.php ";
                </script>';
                }
        }else{
        require "view/user/login.php";
        }
        }
    function gioHang(){
        require "view/cart.php";
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
            
            require "view/user/login.php";
        }
        require "view/user/singin.php";
        
    }
    function quenMatkhau(){
        require "view/user/forgotPassword.php";
    }

    function timkiem(){
        $category_id = $_GET['category_id'] ?? "";
        $search_result = get_item_by_category($category_id);

        require "view/store.php";
    }


include "view/footer.php";
?>
