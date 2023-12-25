<?php
$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 50, 'quantity' => 10, 'description' => 'Description 1', 'category' => 'Category 1', 'brand' => 'Brand 1', 'color' => 'Red', 'year' => 2022, 'created_at' => '2023-01-01', 'updated_at' => '2023-01-05'],
    ['id' => 2, 'name' => 'Product 2', 'price' => 75, 'quantity' => 8, 'description' => 'Description 2', 'category' => 'Category 2', 'brand' => 'Brand 2', 'color' => 'Blue', 'year' => 2021, 'created_at' => '2023-01-02', 'updated_at' => '2023-01-04'],
    // Add more product data as needed
];
?>
<div class="container mt-5">
  <h2>Danh sách sản phẩm</h2>
  
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
        <button type="button" class="btn btn-primary">Thêm mới sản phẩm</button>
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
        <th>Số lượng</th>
        <th>Miêu tả</th>
        <th>Tên danh mục</th>
        <th>Tên nhãn hiệu</th>
        <th>Màu sắc</th>
        <th>Năm sản xuất</th>
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
                <input type="checkbox" class="custom-control-input" id="customCheckProduct<?php echo $product['id']; ?>">
                <label class="custom-control-label" for="customCheckProduct<?php echo $product['id']; ?>"></label>
            </div>
        </td>
        <td><?php echo $product['id']; ?></td>
        <td><?php echo $product['name']; ?></td>
        <td>$<?php echo $product['price']; ?></td>
        <td><?php echo $product['quantity']; ?></td>
        <td><?php echo $product['description']; ?></td>
        <td><?php echo $product['category']; ?></td>
        <td><?php echo $product['brand']; ?></td>
        <td><?php echo $product['color']; ?></td>
        <td><?php echo $product['year']; ?></td>
        <td><?php echo $product['created_at']; ?></td>
        <td><?php echo $product['updated_at']; ?></td>
        <td>
            <!-- Add your action buttons here -->
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-danger">Delete</button>
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
