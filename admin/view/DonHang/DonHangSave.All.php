<?php
// $orders = [
//   ['id' => 1, 'customer' => 'Dương', 'quantity' => 3, 'sub_total' => 150, 'total' => 200],
//   ['id' => 2, 'customer' => 'Đông 2', 'quantity' => 5, 'sub_total' => 250, 'total' => 350],
// ];
// // Dữ liệu mẫu
function get_order()
{
  $sql = "SELECT
        dh.id AS don_hang_id,
        nguoi.ho_ten AS ten_nguoi_dung,
        sp.ten_san_pham AS ten_san_pham,
        GROUP_CONCAT(bt.ten_bien_the SEPARATOR ', ') AS bien_the_names,
        dh.so_luong AS so_luong_don_hang,
        dh.ten_nguoi_nhan AS ten_nguoi_nhan,
        dh.dia_chi AS dia_chi_nguoi_nhan,
        dh.so_dien_thoai AS so_dien_thoai_nguoi_nhan
      FROM
        don_hang dh
      LEFT JOIN nguoi_dung nguoi ON dh.id_nguoi_dung = nguoi.id
      LEFT JOIN san_pham_bien_the bienthe1 ON dh.id_san_pham_bien_the_1 = bienthe1.id
      LEFT JOIN san_pham_bien_the bienthe2 ON dh.id_san_pham_bien_the_2 = bienthe2.id
      LEFT JOIN san_pham_bien_the bienthe3 ON dh.id_san_pham_bien_the_3 = bienthe3.id
      LEFT JOIN san_pham_bien_the bienthe4 ON dh.id_san_pham_bien_the_4 = bienthe4.id
      LEFT JOIN san_pham_bien_the bienthe5 ON dh.id_san_pham_bien_the_5 = bienthe5.id
      LEFT JOIN bien_the bt ON bienthe1.id_bien_the = bt.id OR
                                bienthe2.id_bien_the = bt.id OR
                                bienthe3.id_bien_the = bt.id OR
                                bienthe4.id_bien_the = bt.id OR
                                bienthe5.id_bien_the = bt.id
      LEFT JOIN dia_chi_nguoi_dung dcnd ON dh.id_nguoi_dung = dcnd.id_nguoi_dung
      LEFT JOIN san_pham sp ON bienthe1.id_san_pham = sp.id OR
                                bienthe2.id_san_pham = sp.id OR
                                bienthe3.id_san_pham = sp.id OR
                                bienthe4.id_san_pham = sp.id OR
                                bienthe5.id_san_pham = sp.id
      GROUP BY dh.id;

        ";
  return pdo_query($sql);
}

$orders = get_order();

// pre_dump($orders);
// exit;

?>

<div class="container" style="padding-left: 0px; padding-right: 0px;">
  <h2>Đơn đặt hàng</h2>

  <div class="container">
    <div class="form-row mb-3 justify-content-between">
      <div class="col-auto d-flex align-items-center">
        <label for="limit" class="mr-2 form-label">In ra số lượng sản phẩm:</label>
        <select class="form-control" id="limit">
          <option>10</option>
          <option>25</option>
          <option>50</option>
          <option>100</option>
        </select>
      </div>
    </div>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID đơn hàng</th>
        <th>Tên tài khoản đặt</th>
        <th>Tên sản phẩm</th>
        <th>Biến thể</th>
        <th>Số lượng sản phẩm</th>
        <th>Tên người nhận</th>
        <th>Địa chỉ người nhận</th>
        <th>Số điện thoại người nhận</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order) : ?>
        <tr>
          <td><?php echo $order['don_hang_id']; ?></td>
          <td><?php echo $order['ten_nguoi_dung']; ?></td>
          <td><?php echo $order['ten_san_pham']; ?></td>
          <td><?php echo $order['bien_the_names']; ?></td>
          <td><?php echo $order['so_luong_don_hang']; ?></td>
          <td><?php echo $order['ten_nguoi_nhan']; ?></td>
          <td><?php echo $order['dia_chi_nguoi_nhan']; ?></td>
          <td><?php echo $order['so_dien_thoai_nguoi_nhan']; ?></td>
          <td>
            <select class="form-control" id="limit">
              <option>Trạng thái đơn</option>
              <option value="1">Đơn hàng đang được chuẩn bị</option>
              <option value="2">Đơn hàng đang được giao</option>
              <option value="3">Đơn hàng đã được hoàn thiện</option>
            </select>
            <a href="admin.php?act=chitietdon&id=<?php echo $order['don_hang_id']; ?>"><br>
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