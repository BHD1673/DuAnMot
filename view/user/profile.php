<?php

// Chi tiết profile
$user = profile($_SESSION['user']['id']);

if (!isset($_SESSION['user'])) {
    $_SESSION['msg']['login'] = "Vui lòng đăng nhập";
    header('Location: index.php?act=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];
        
        switch($form_type) {
            case 'profile':
                handleProfileForm();
                break;
            case 'address':
                handleAddressForm();
                break;
            default:
                echo "Có lỗi khi gửi dữ liệu !";
        }
    }
}

function handleProfileForm() {
    $id = $_POST["uid_hidden"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $errors = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Không đúng định dạng email";
    }

    if (strlen($phone) < 9) {
        $errors[] = "Số điện thoại phải có ít nhất 9 kí tự trở lên";
    }
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        $sql = "UPDATE nguoi_dung SET ho_ten = ?, email = ?, so_dien_thoai = ? WHERE id = ?";
        pdo_execute($sql, $username, $email, $phone, $id);
        $_SESSION['msg']['profile'] = "Cập nhật thành công";
        header("location: index.php?act=profile");
    }
}

function handleAddressForm() {
    $id = $_SESSION['user']['id'];
    $choice = $_POST["la_dia_chi_chinh"];
    $sql = "UPDATE `dia_chi_nguoi_dung` SET `la_dia_chi_chinh` = ? WHERE `dia_chi_nguoi_dung`.`id` = ?";
    pdo_execute($sql, $choice, $id);
    $_SESSION['msg']['address'] = "Cập nhật thành công địa chỉ chính thành công";
    header("location: index.php?act=profile");  
}


$sql = "SELECT * FROM dia_chi_nguoi_dung WHERE id_nguoi_dung = ?";
$list = pdo_query($sql, $_SESSION['user']['id']);

?>
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .list-group-item {
        border: none;
    }

    .list-group-item strong {
        width: 200px;
        display: inline-block;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <?php
            $capnhatthongtinthanhcong = $_SESSION['msg']['profile'] ?? "";
            $capnhatluachondiachithanhcong = $_SESSION['msg']['address'] ?? "";
            echo $capnhatluachondiachithanhcong;
            echo $capnhatthongtinthanhcong;
            unset($_SESSION['msg']['address']);
            unset($_SESSION['msg']['profile']);
            ?>
            <h3>Thông tin tài khoản</h3>
            <a href="index.php?act=lichsudonhang" class="btn btn-success">Xem lịch sử đơn hàng</a>
            <form method="post">
                <input type="hidden" name="form_type" value="profile">
                <div class="form-group row">
                    <label for="uid" class="col-sm-4 col-form-label"><strong>UID:</strong></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="uid" name="uid" value="<?php echo $user['id']; ?>" disabled>
                        <input type="hidden" class="form-control" id="uid" name="uid_hidden" value="<?php echo $user['id']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label"><strong>Tên đăng nhập:</strong></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['ho_ten']; ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label"><strong>Email:</strong></label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-4 col-form-label"><strong>Số điện thoại:</strong></label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $user['so_dien_thoai']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <h3>Danh sách địa chỉ</h3>
            <a href="index.php?act=themdiachi" class="btn btn-info">Thêm địa chỉ mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Người Dùng</th>
                        <th>Tên Người Nhận</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Là Địa Chỉ Chính</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $array) { ?>
                        <tr>
                            <form id="form_<?php echo $array['id']; ?>" method="post" action>
                                <input type="hidden" name="form_type" value="address">
                                <input type="hidden" name="id" value="<?php echo $array['id']; ?>">
                                <td><?php echo $array['id']; ?></td>
                                <td><?php echo $array['id_nguoi_dung']; ?></td>
                                <td><?php echo $array['ten_nguoi_nhan']; ?></td>
                                <td><?php echo $array['so_dien_thoai']; ?></td>
                                <td><?php echo $array['dia_chi']; ?></td>
                                <td>
                                    <select name="la_dia_chi_chinh" onchange="document.getElementById('form_<?php echo $array['id']; ?>').submit();">
                                        <option value="1" <?php echo $array['la_dia_chi_chinh'] == 1 ? 'selected' : ''; ?>>Đúng</option>
                                        <option value="0" <?php echo $array['la_dia_chi_chinh'] == 0 ? 'selected' : ''; ?>>Không</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="index.php?act=xoadiachi&id=<?php echo $array['id']; ?>" class="btn btn-danger">Xóa</a>
                                    <a href="index.php?act=capnhatdiachi&id=<?php echo $array['id']; ?>" class="btn btn-primary">Sửa</a>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>