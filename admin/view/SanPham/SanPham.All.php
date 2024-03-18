<?php

$products = get_product_by_index();

echo $_SESSION['msg']['xoadanhmuc'] ?? "";
unset($_SESSION['msg']);
?>
<div class="container-fluid">
  <h2>Danh sách sản phẩm</h2>
  <a href="admin.php?act=loaisp"><button class="btn btn-primary">Xem danh sách loại sản phẩm</button></a>
  
  <div class="container">
    <div class="form-row mb-3 justify-content-between">
      <div class="col-auto d-flex align-items-center">
        <label for="limit" class="mr-2">In ra:</label>
        <select class="form-control" id="limit">
          <option>10</option>
          <option>25</option>
          <option>50</option>
          <option>100</option>
        </select>
      </div>
      <div class="col-auto">
        <a href="admin.php?act=taosanpham"><button type="button" class="btn btn-primary">Thêm mới sản phẩm</button></a>
      </div>
    </div>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="selectAllProducts">
            <label class="custom-control-label" for="selectAllProducts"></label>
          </div>
        </th>
        <th>ID sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng sản phẩm</th>
        <th>Ảnh xem qua</th>
        <th>Danh mục sản phẩm</th>
        <th>Thêm vào lúc</th>
        <th>Cập nhật gần nhất</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
    <tr>
        <td>
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheckProduct<?php echo $product[0]; ?>">
                <label class="custom-control-label" for="customCheckProduct<?php echo $product[0]; ?>"></label>
            </div>
        </td>
        <td><?php echo $product[0]; ?></td>
        <td><?php echo $product['product_name']; ?></td>
        <td><?php echo $product['total_variant_quantity']; ?></td>
        <td><img class="img-thumbnail" style="
          max-width: 100px;
          max-height: 100px;
        
        "
         src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_image']; ?> "></td>
        <td><a href="admin.php?act=editloaisp&id=<?php echo $product['category_id'] ?? ""; ?>" class="btn btn-primary"> Chuyển đến trang danh mục <?php echo $product['category_id']; ?></a></td>
        <td><?php echo $product['product_created_at']; ?></td>
        <td><?php echo $product['product_update_at']; ?></td>
        <td>
            <!-- Phần chi tiếts sản phẩm ở đây -->
            <a href="admin.php?act=danhmucbienthe&id=<?php echo $product[0]; ?>" class="btn btn-success">Xem danh sách biến thể của sản phẩm</a>
            <a href="admin.php?act=chitietsanpham&id=<?php echo $product[0]; ?>" class="btn btn-warning">Sửa</a>
            <a href="admin.php?act=xoasanpham&id=<?php echo $product[0]; ?>" class="btn btn-danger">Xoá</a>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
  </table>

  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Lùi về trước</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Sang trang tiếp</a></li>
    </ul>
  </nav>
</div>
