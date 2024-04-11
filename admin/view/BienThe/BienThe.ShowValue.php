<?php 

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$variant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Build the SQL query
if ($product_id && !$variant_id) {
  // If only product_id is provided, display all variant values for that product
  $sql = "SELECT san_pham.id AS product_id,
          san_pham.ten_san_pham AS product_name,
          bien_the.id AS variant_id,
          bien_the.ten_bien_the AS variant_name,
          san_pham_bien_the.gia_tri AS variant_value
          FROM san_pham
          JOIN san_pham_bien_the ON san_pham.id = san_pham_bien_the.id_san_pham
          JOIN bien_the ON san_pham_bien_the.id_bien_the = bien_the.id
          WHERE san_pham_bien_the.id_san_pham = $product_id;";
} elseif (!$product_id && $variant_id) {
  // If only variant_id is provided, display all variant values for that variant
  $sql = "SELECT san_pham.id AS product_id,
          san_pham.ten_san_pham AS product_name,
          bien_the.id AS variant_id,
          bien_the.ten_bien_the AS variant_name,
          san_pham_bien_the.gia_tri AS variant_value
          FROM san_pham
          JOIN san_pham_bien_the ON san_pham.id = san_pham_bien_the.id_san_pham
          JOIN bien_the ON san_pham_bien_the.id_bien_the = bien_the.id
          WHERE san_pham_bien_the.id_bien_the = $variant_id;";
} elseif ($product_id && $variant_id) {
  // If both product_id and variant_id are provided, display the specific variant value for that product
  $sql = "SELECT san_pham.id AS product_id,
          san_pham.ten_san_pham AS product_name,
          bien_the.id AS variant_id,
          bien_the.ten_bien_the AS variant_name,
          san_pham_bien_the.gia_tri AS variant_value
          FROM san_pham
          JOIN san_pham_bien_the ON san_pham.id = san_pham_bien_the.id_san_pham
          JOIN bien_the ON san_pham_bien_the.id_bien_the = bien_the.id
          WHERE san_pham_bien_the.id_san_pham = $product_id
          AND san_pham_bien_the.id_bien_the = $variant_id;";
} else {
  // If both product_id and variant_id are not provided, display all variant values
  $sql = "SELECT san_pham.id AS product_id,
          san_pham.ten_san_pham AS product_name,
          bien_the.id AS variant_id,
          bien_the.ten_bien_the AS variant_name,
          san_pham_bien_the.gia_tri AS variant_value
          FROM san_pham
          JOIN san_pham_bien_the ON san_pham.id = san_pham_bien_the.id_san_pham
          JOIN bien_the ON san_pham_bien_the.id_bien_the = bien_the.id;";
}


$array = @pdo_query($sql);

?>

<div class="container mt-5">
    <a href="admin.php?act=bienthe" class="btn btn-secondary">Quay trước</a>
    <a href="admin.php?act=chitietbienthe&id=<?php echo $_GET['id']; ?>&product_id=<?php echo $_GET['product_id']; ?>" class="btn btn-primary">Thêm giá trị biến thể mới</a>
    <h2>Giá trị của biến thể: <span style="font-weight: bold; color: blue;"><?php echo isset($array[0]['variant_name']) ? $array[0]['variant_name'] : ''; ?></span></h2>
    <table class="table">
      <thead>
        <tr>
          <th>Tên sản phẩm</th>
          <th>Giá trị biến thể</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($array as $data): ?>
        <tr>
          <td><?php echo $data['product_name']; ?></td>
          <td><?php echo $data['variant_value']; ?></td>
          <td>
            <a href="admin.php?act=editgiatribienthe&action=edit&id=<?php echo $data['variant_id']; ?>'" class="btn btn-primary">Sửa</a>
            <a href="admin.php?act=xoagiatribienthe&action=delete&id='<?php echo $data['variant_id']; ?>'" class="btn btn-danger">Xóa</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
