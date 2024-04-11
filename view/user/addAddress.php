<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dia_chi = $_POST['dia_chi'];

    $errors = [];

    if (empty($ten_nguoi_nhan)) {
        $errors[] = "Phải nhập tên người nhận";
    }

    if (empty($so_dien_thoai)) {
        $errors[] = "Phải nhập số điện thoại";
    } elseif (strlen($so_dien_thoai) < 10) {
        $errors[] = "Số điện thoại phải có ít nhất 10 ký tự";
    } elseif (!preg_match('/^\d{4}\d*$/', $so_dien_thoai)) {
        $errors[] = "Số điện thoại không hợp lệ";
    }

    if (empty($dia_chi)) {
        $errors[] = "Phải nhập địa chỉ";
    } elseif (strlen($dia_chi) > 255) {
        $errors[] = "Địa chỉ không được vượt quá 255 ký tự";
    }

    if (empty($errors)) {

        $sql = "INSERT INTO dia_chi_nguoi_dung (id_nguoi_dung, ten_nguoi_nhan, so_dien_thoai, dia_chi) VALUES (?, ?, ?, ?)";
        pdo_execute($sql, $_SESSION['user']['id'],  $ten_nguoi_nhan, $so_dien_thoai, $dia_chi);
        echo "<script>alert('Thêm địa chỉ mới thành công!');</script>";
        header("location: index.php?act=profile");

    } else {
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }
}


?>
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Thêm địa chỉ mới</h2>
        <form action="" method="POST">
          <div class="form-group">
            <label for="ten_nguoi_nhan">Tên Người Nhận:</label>
            <input type="text" class="form-control" id="ten_nguoi_nhan" name="ten_nguoi_nhan" >
          </div>
          <div class="form-group">
            <label for="so_dien_thoai">Số Điện Thoại:</label>
            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" >
          </div>
          <div class="form-group">
            <label for="dia_chi">Địa Chỉ:</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" >
          </div>
          <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
      </div>
    </div>
  </div>