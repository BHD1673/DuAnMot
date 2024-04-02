<?php 
function xuLyHanhDong($hanhDong)
{
    $title = "";
    switch ($hanhDong) {
        case 'unsetLoginValue':
            echo "<pre>";
            var_dump($_SESSION);
            echo "</pre>";
            unset($_SESSION['user']);
            $_SESSION['msg']['logout'] = "Bạn đã đăng xuất";
            header("LOCATION: index.php");
            break;
        case 'xoakhoigiohang':
            xoaKhoiGioHang();
            break;
        case 'product':
            $title = "Danh sách sản phẩm";
            hienthisanpham();
            break;
        case 'detailProduct':
            $title = "Chi tiết sản phẩm";
            chitietsanpham();
            break;
        case 'checkout':
            hoadonSp();
            break;
        case 'cart':
            $title = "Giỏ hàng";
            gioHang();
            break;
            //////////////////////////
        case 'profile':
            $title = "Chi tiết tài khoản";
            chiTietKhachHang();
            break;
        case 'lichsumuahang':
            hienThiLichSuMuaHang();
            break;
        case 'diachikhachhang':
            hienThiDiaChiKhachHang();
            break;
        case 'themdiachi':
            themDiaChiKhachHang();
            break;
        case 'xoadiachi':
            xoaDiaChiKhachHang();
            break;
        case 'capnhatdiachi':
            capNhatDiaChiKhachHang();
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
        case 'search':
            $title = "Tìm kiếm";
            timkiem();
            break;
        case 'dump':
            echo "ăklfjalwjfawl";
            break;
    }
    setPageTitle($title);
}

?>