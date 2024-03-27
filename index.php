<?php
ob_start();
session_start();

require_once "model/login.php";
require_once "model/pdo.php";
require_once "model/product.php";
$category = category();

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
                    //doing something
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
                return $_SESSION['msg']['login'] = "Đăng nhập thất bại, có vấn đề, vui lòng kiểm tra lại";
                }else{
                $_SESSION['user'] = $errow;
                var_dump($errow);
                echo '<script>
                alert("Đăng Nhập Thành Công");
                window.location= " admin.php ";HEADER MY ASS THE FUCK YOU THINK ?
                thằng admin lồn nào đang ở trang bình thường tự nhiên muốn sang admin luôn ?
                </script>';
                }
        }else{
        require_once "view/user/login.php";
        }
        }
    function gioHang(){
        require_once "view/cart.php";
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
            // Nhìn nó có dở hơi không ?
            // Mà đã thế nó còn là link localhost mới hay 
            echo '<script>
            alert("Tài khoản đã tạo thành công");
            window.location= " http://localhost:81/duan4/index.php?act=login ";
            </script>';
            }
            
            require_once "view/user/login.php";
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
