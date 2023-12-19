<?php
session_start();
ob_start();
include "global.php";
include "user/view/head.php";
?>
<body>
<?php 

// Header trang bao gồm thanh nav với vài thứ linh tinh
include "user/view/header.php";

// Phần điều hướng sản phẩm chính
if (isset($_GET['act'])) {
    $hanhDong = $_GET['act'];
    xuLyHanhDong($hanhDong);
} else {
    hienThiTrangChu();
}

// Bao gồm phần cuối trang
include "user/view/footer.php";
include "user/view/hidden.php";
?>
</body>
<?php 
// Hàm để xử lý điều hướng hành động
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case 'danhsachsanpham':
            hienThiDanhSachSanPham();
            break;
        case 'chitietsanpham':
            hienThiChiTietSanPham();
            break;
        case 'dangxuat':
            dangXuatNguoiDung();
            break;
        case 'dangnhap':
            dangNhapNguoiDung();
            break;
        case 'dangky':
            dangKyNguoiDung();
            break;
        case 'quenmatkhau':
            quenMatKhau();
            break;
        case 'chitiettaikhoan':
            chitiettaikhoan();
            break;
        case 'capnhatthongtin':
            capNhatThongTinCaNhan();
            break;
        case 'hoadon':
            hienThiHoaDon();
            break;
        case 'gioithieu':
            gioiThieu();
            break;
        case 'baiviet':
            baiViet();
            break;
        default:
            hienThiTrangChu();
            break;
    }
}
function hienThiTrangChu() {
    include "user/view/section1.php";
    include "user/view/section2.php";
    include "user/view/section3.php";
    include "user/view/section4.php";
    include "user/view/section5.php";
    include "user/view/section6.php";
    include "user/view/newletter.php";
}


function dangNhapNguoiDung() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Nhận giá trị từ form
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Thực hiện validate
        if (empty($username) || empty($password)) {
            echo "Vui lòng nhập đầy đủ tên tài khoản và mật khẩu.";
        } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            echo "Vui lòng nhập đúng định dạng email";
        } else {
            // Xử lý phần xác nhận sau khi validate thành công ở đây
            
            // Cái này là dữ liệu giả
            $validUsername = "your_username";
            $validPassword = "your_password";
    
            // Xử lý mật khẩu kỹ hơn
            if ($username === $validUsername && password_verify($password, $validPassword)) {
                echo "Đăng nhập thành công!";
            } else {
                echo "Tên tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại.";
            }
        }
    }
    include "user/view/sign_in.php";
}


function chiTietTaiKhoan() {
    // if (isset($_POST['capnhat'])) {
    //     $user = trim($_POST['user']);
    //     $email = trim($_POST['email']);
    //     $address = trim($_POST['address']);
    //     $tel = $_POST['tel'];
    //     $date = $_POST['ngaysinh'];
    //     $id = $_POST['id'];

        // update_taikhoan($user, $email, $address, $id, $tel, $date);
        // $_SESSION['user'] = getUserByUsernameAndEmail($user, $email);
    //     header('Location:index.php?act=thongtintk');
    // }
}




//Cái này chắc không cần giải thích :v 
function hienThiChiTietSanPham() {
    // include "stearm/chiTietSanPham.php";
}

//unset thế này toác hết cả site đấy :v
//Hiệp xem sửa lại chỗ này
function dangXuatNguoiDung() {
    // session_unset['log-in'];
    // header('Location: index.php');
}



function dangNhapNguoiDungs() {
    // if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
    //     $user = $_POST['user'];
    //     $pass = $_POST['pass'];
    //     $checkuser = checkuser($user, $pass);
    //     if (is_array($checkuser)) {
    //         $_SESSION['user'] = $checkuser;

    //         // Kiểm tra vai trò
    //         if ($checkuser['Role'] == 1) {
    //             // Nếu vai trò là 1 (admin), chuyển hướng đến trang quản trị admin
    //             echo "<script>
    //                 window.location.href='admin.php';
    //             </script>";
    //         } else {
    //             // Nếu vai trò là người dùng thông thường, chuyển hướng đến trang chính
    //             echo "<script>
    //                 window.location.href='index.php';
    //             </script>";
    //         }
    //     } else {
    //         $thongbao = "Tài khoản không tồn tại";
    //     }
    // }
    // include "view/user/singup.php";
}


function hienThiDanhSachSanPham() {
    include "user/view/allsp.php";
}

function dangKyNguoiDung() {
    // if (isset($_POST['dangky']) && ($_POST['dangky'])) {
    //     $email = $_POST['email'];
    //     $pass = $_POST['pass'];
    //     $user = $_POST['user'];
    //     insert_taikhoan($email, $user, $pass);
    // }
    // include "view/user/singup.php";
}

function quenMatKhau() {
    // if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
    //     $email = $_POST['email'];

    //     $checkemail = checkemail($email);
    //     if (is_array($checkemail)) {
    //         $thongbao = "Mật khẩu của bạn là: " . $checkemail['MatKhau'];
    //     } else {
    //         $thongbao = "Email này không tồn tại";
    //     }
    // }
    // include "view/user/forgot.php";
}

function capNhatThongTinCaNhan() {
    // Triển khai logic cập nhật thông tin cá nhân
}

function xacNhanThongTin() {
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Kiểm tra xem các trường dữ liệu đã được gửi từ biểu mẫu hay chưa
    //     if (isset($_POST['book']) && isset($_POST['book'])) {
    //         $name = $_POST['visitor_name'];
    //         $email = $_POST['visitor_email'];
    //         $phone = $_POST['visitor_phone'];
    //         $dateIn = $_POST['DateIn'];
    //         $dateOut = $_POST['DateOut'];

    //         // Gọi hàm để thêm dữ liệu vào cơ sở dữ liệu
    //         // insertData($checkin, $checkout, $name, $email,$phone);
    //     } else {
    //         echo "Bạn đang viết sai.";
    //     }
    // }
    // include "stearm/checkout.php";
}

function hienThiHoaDon() {}

//Về chúng tôi
function aboutUs() {
    include "view/review.php";
}

//Thông tin chung về cửa hàng
function infor() {}

//Chính sách đổi trả
function rule() {}

function baiViet() {}

function gioiThieu() {}

?>
