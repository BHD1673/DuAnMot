<?php 

$array = get_variant_category($_GET['id']);

?>

<div class="container mt-5">
    <h2>Biến thể sản phẩm của sản phẩm <?= $_GET['id'] ?></h2>
    <a href="admin.php?act=sanpham" class="btn btn-secondary">Quay về trang danh sách sản phẩm</a>
    <a href="admin.php?act=themdanhmucbienthe&id=<?= $_GET['id'] ?>" class="btn btn-primary">Thêm biến thể mới</a>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên biến thể</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array as $item) : ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['variant_type']; ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="admin.php?act=xoadanhmucbienthe&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xoá</a>
                        <a href="admin.php?act=bienthe&productid=<?php echo $_GET['id'] ?>&productvariantcategoryid=<?php echo $item['id']; ?>" class="btn btn-success">Xem chi tiết</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

  </div>
