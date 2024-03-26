<?php 

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$variant_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Build the SQL query
$sql = "SELECT san_pham.id AS product_id,
        san_pham.ten_san_pham AS product_name,
        bien_the.id AS variant_id,
        bien_the.ten_bien_the AS variant_name,
        san_pham_bien_the.gia_tri AS variant_value
        FROM san_pham
        JOIN san_pham_bien_the ON san_pham.id = san_pham_bien_the.id_san_pham
        JOIN bien_the ON san_pham_bien_the.id_bien_the = bien_the.id
        WHERE san_pham.id = $variant_id AND bien_the.id = $product_id;";

$array = pdo_query($sql);

?>

<div class="container mt-5">
    <h2>Giá trị của biến thể</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>ID biến thể</th>
          <th>Tên biến thể </th>
          <th>Giá trị biến thể</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($array as $data): ?>
        <tr>
          <td><?php echo $data['product_id']; ?></td>
          <td><?php echo $data['product_name']; ?></td>
          <td><?php echo $data['variant_id']; ?></td>
          <td><?php echo $data['variant_name']; ?></td>
          <td><?php echo $data['variant_value']; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
