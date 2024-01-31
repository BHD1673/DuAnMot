<?php
// $products = [
//     ['id' => 1, 'name' => 'Product 1', 'price' => 50, 'quantity' => 10, 'description' => 'Description 1', 'category' => 'Category 1', 'brand' => 'Brand 1', 'color' => 'Red', 'year' => 2022, 'created_at' => '2023-01-01', 'updated_at' => '2023-01-05'],
//     ['id' => 2, 'name' => 'Product 2', 'price' => 100, 'quantity' => 8, 'description' => 'Description 2', 'category' => 'Category 2', 'brand' => 'Brand 2', 'color' => 'Blue', 'year' => 2021, 'created_at' => '2023-01-02', 'updated_at' => '2023-01-04'],
//     // Data ảo
//     // Phần show sản phẩm thì chỉ cần show ý chính, vào chi tiết thì mới hiện là sản phẩm có những cái gì
// ];

$products = getAllProducts();




?>
<div class="container-fluid">
  <h2>Danh sách sản phẩm</h2>
  <a href="admin.php?act=loaisp"><button class="btn btn-primary">Sang loại sản phẩm</button></a>
  <a href="admin.php?act=brand"><button class="btn btn-primary">Sang brand sản phẩm</button></a>
  
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
        <th>Giá thành</th>
        <th>Số lượng sản phẩm</th>
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
                <input type="checkbox" class="custom-control-input" id="customCheckProduct<?php echo $product['id_san_pham']; ?>">
                <label class="custom-control-label" for="customCheckProduct<?php echo $product['id_san_pham']; ?>"></label>
            </div>
        </td>
        <td><?php echo $product['id_san_pham']; ?></td>
        <td><?php echo $product['ten_san_pham']; ?></td>
        <td><?php echo $product['gia_ban_le']; ?> VNĐ</td>
        <td><?php echo $product['so_luong']; ?></td>
        <td><?php echo $product['ngay_tao']; ?></td>
        <td><?php echo $product['ngay_cap_nhat']; ?></td>
        <td>
            <!-- Phần chi tiếts sản phẩm ở đây -->
            <a href="admin.php?act=chitietsanpham&id=<?php echo $product['id_san_pham']; ?>"><button class="btn btn-primary">Chi tiết sản phẩm</button></a>
            <button class="btn btn-danger">Xóa sản phẩm</button>
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
