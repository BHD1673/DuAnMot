<?php

function get_all_san_pham_index() {
  $sql = "SELECT 
sp.id AS product_id,
sp.ten_san_pham AS product_name,
sp.gia_co_ban AS product_based_price,
sp.ngay_cap_nhat AS ngay_cap_nhat,
sp.ngay_tao AS ngay_tao,
COALESCE(SUM(spb.so_luong), 0) AS total_quantity,
MAX(spb.image) AS variant_image,
dm.id AS category_id,
dm.ten_danh_muc AS category_name
FROM 
san_pham sp
LEFT JOIN 
san_pham_bien_the spb ON sp.id = spb.id_san_pham
LEFT JOIN 
danh_muc dm ON sp.id_danh_muc = dm.id
GROUP BY 
sp.id, sp.ten_san_pham, dm.id, dm.ten_danh_muc;
";

 return pdo_query($sql);
}

$products = get_all_san_pham_index();


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
        <th>Giá cơ bản</th>
        <th>Ngày tạo</th>
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
        <td><?php echo $product['total_quantity']; ?></td>
        <td><img class="img-thumbnail" style="
          max-width: 100px;
          max-height: 100px;
        
        "
         src="uploads/<?php echo $product['variant_image']; ?>" alt="<?php echo $product['variant_image']; ?> "></td>
        <td><a href="admin.php?act=editloaisp&id=<?php echo $product['category_id'] ?? ""; ?>" class="btn btn-primary"> Chuyển đến trang danh mục <?php echo $product['category_id']; ?></a></td>
        <td><?php echo $product['product_based_price']; ?></td>
        <td><?php echo $product['ngay_tao']; ?></td>
        <td><?php echo $product['ngay_cap_nhat']; ?></td>
        <td>
            <!-- Phần chi tiếts sản phẩm ở đây -->
            <a href="admin.php?act=bienthe&id=<?php echo $product[0]; ?>" class="btn btn-success">Xem danh sách biến thể của sản phẩm</a>
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
