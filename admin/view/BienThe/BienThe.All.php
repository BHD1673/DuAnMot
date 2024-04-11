<?php 

$sql = "SELECT * FROM bien_the";
$array = pdo_query($sql);

$getId = $_GET['id'] ?? "";

?>
<div class="container">
  <a href="admin.php?act=thembienthe" class="btn btn-success">Thêm loại biến thể mới</a>
  <a href="admin.php?act=sanpham" class="btn btn-primary">Xem danh sách sản phẩm</a>
  <table class="table border">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên biến thể</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($array as $value): ?>
      <tr>
        <td><?= $value['id'] ?></td>
        <td><?= $value['ten_bien_the'] ?></td>
        <td>
            <a href="admin.php?act=giatribienthe&id=<?= $value['id'] ?>&product_id=<?php echo $getId; ?>" class="btn btn-primary">Chi tiết</a>
            <a href="admin.php?act=xoabienthe&id=<?= $value['id'] ?>" class="btn btn-danger">Xoá</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
