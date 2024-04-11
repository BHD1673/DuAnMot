<?php 

$sql = "SELECT * FROM nguoi_dung";
$accountList = pdo_query($sql);

?>

<div class="container">
    <h2>Danh sách tài khoản</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên tài khoản</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Role</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accountList as $record) : ?>
                <tr>
                    <td><?php echo $record['ho_ten']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td><?php echo $record['so_dien_thoai']; ?></td>
                    <td><?php echo ($record['role'] == 1) ? 'Admin' : 'Khách hàng bình thường'; ?></td>
                    <td>
                        <a href="admin.php?act=chitiettaikhoan&id=<?php echo $record['id']; ?>" class="btn btn-primary">Sửa</a>
                        <a href="admin.php?act=xoataikhoan&id=<?php echo $record['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">Xoá tài khoản</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
