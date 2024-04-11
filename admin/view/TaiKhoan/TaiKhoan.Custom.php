<?php 

$sql = "SELECT * FROM nguoi_dung WHERE id = ?";

$tai_khoan = pdo_query_one($sql, $_SESSION['user']['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $role_choice = $_POST['role_choice'];
    $sql = "UPDATE nguoi_dung SET role = ? WHERE id = ?";
    pdo_execute($sql, $role_choice, $tai_khoan['id']);
    header("Location: admin.php?act=taikhoan");

    pre_dump($_POST);
}
?>

<div class="container">
    <h2>Thông tin tài khoản</h2>
    <form method="POST" action="">
        <div class="form-group row">
            <label for="ho_ten" class="col-sm-2 col-form-label">Tên tài khoản</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ho_ten" value="<?php echo $tai_khoan['ho_ten']; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" value="<?php echo $tai_khoan['email']; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="so_dien_thoai" class="col-sm-2 col-form-label">Số điện thoại liên hệ</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="so_dien_thoai" value="<?php echo $tai_khoan['so_dien_thoai']; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select name="role_choice" id="" class="form-control">
                    <option value="0">Bỏ quyền admin</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Cập nhật</button>
    </form>
</div>