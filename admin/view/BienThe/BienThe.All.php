<?php 

// $sql = "SELECT * FROM `product_variant`WHERE variant_category_id = ". $_GET['productvariantcategoryid'] . ";";
// $array = pdo_query($sql);

$sql = "SELECT * FROM bien_the";
$array = pdo_query($sql);


?>
<div class="container">
  <a href="admin.php?act=thembienthe" class="btn btn-primary">Thêm loại biến thể mới</a>
  <h2>Danh sách biến thể thuộc sản phẩm : <?php echo $_GET['id'] ?></h2>
  <table class="table">
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
            <a href="admin.php?act=giatribienthe&id=<?= $value['id'] ?>&product_id=<?= $_GET['id'] ?>" class="btn btn-primary">Xem danh sách giá trị biến thể</a>
            <a href="admin.php?act=chitietbienthe&id=<?= $value['id'] ?>&product_id=<?= $_GET['id'] ?>" class="btn btn-success">Thêm giá trị biến thể</a>
            <a href="admin.php?act=xoabienthe&id=<?= $value['id'] ?>" class="btn btn-warning">Xoá</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
// Function to display status based on class
function displayStatus() {
  var statuses = document.querySelectorAll("#status");
  console.log(statuses);

  for (var i = 0; i < statuses.length; i++) {
    var status = statuses[i];
    var statusValue = status.innerHTML;

    if (statusValue === "1") {
      status.innerHTML = "Đang hết hàng";
    } else if (statusValue === "2") {
      status.innerHTML = "Vẫn còn hàng";
    }
  }
}

// Call the function to display status
displayStatus();
</script>