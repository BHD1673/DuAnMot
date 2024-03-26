<?php 
$orders = [
  ['id' => 1, 'customer' => 'Dương', 'quantity' => 3, 'sub_total' => 150, 'total' => 200],
  ['id' => 2, 'customer' => 'Đông 2', 'quantity' => 5, 'sub_total' => 250, 'total' => 350],
];
// Dữ liệu mẫu

?>
<div class="container mt-5">
  <h2>Đơn đặt hàng</h2>
  
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
      <button type="button" class="btn btn-primary">Tạo đơn hàng online mới</button>
      <button type="button" class="btn btn-primary">Tạo đơn hàng tại cửa hàng mới</button>
    </div>
  </div>
</div>




  <table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="selectAll">
                    <label class="custom-control-label" for="selectAll"></label>
                </div>
            </th>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Số sản phẩm</th>
            <th>Tổng tạm giá trị đơn</th>
            <th>Tổng đơn hàng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck<?php echo $order['id']; ?>">
                        <label class="custom-control-label" for="customCheck<?php echo $order['id']; ?>"></label>
                    </div>
                </td>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['customer']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <td>$<?php echo $order['sub_total']; ?></td>
                <td>$<?php echo $order['total']; ?></td>
                <td>  
                    <select class="form-control" id="limit">
                      <option>Trạng thái đơn</option> 
                      <option value="1">Đơn hàng đang được chuẩn bị</option>
                      <option value="2">Đơn hàng đang được giao</option>
                      <option value="3">Đơn hàng đã được hoàn thiện</option>
                    </select>
                    <a href="admin.php?act=chitietdon&id=<?php echo $order['id']; ?>"><br>
                        <button class="btn btn-warning">Xem chi tiết đơn</button>
                    </a>
                    <button class="btn btn-danger">Xóa đơn</button>
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