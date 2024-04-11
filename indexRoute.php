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
        case 'donhang':
            $title = "Hoàn tất đơn hàng";
            hienThiDonHang();
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
        case 'cart':
            $title = "Giỏ hàng";
            gioHang();
            break;
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
        case 'thanhtoan':
            $title = "Nhập thông tin";
            thanhToan();
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
        case 'lichsudonhang':
            $title = "Lịch sử đặt hàng";
            hienThiLichSuDatHang();
            break;
        case 'huydonhang':
            huyDonHang();
            break;
        case 'chitietdonhang':
            $title = "Chi tiết đơn hàng";
            hienThiChiTietDonHang();
            break;
        case 'dump':
            echo "ăklfjalwjfawl";
            break;
        case 'thanhtoanthanhcong':
            datHangThanhCong();
            break;
    }
    setPageTitle($title);
}

?>