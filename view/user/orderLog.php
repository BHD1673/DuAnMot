<?php

function getAllOrderLogs($user_id)
{
  $sql = "SELECT 
o.id_nguoi_dung,
o.order_id,
o.ghi_chu,
o.phuong_thuc_thanh_toan,
o.trang_thai,
o.tao_vao_luc,
d.ten_nguoi_nhan,
d.so_dien_thoai,
d.dia_chi,
SUM(oi.item_total_price) AS total_order_price
FROM 
orders o
INNER JOIN 
order_items oi ON o.order_id = oi.order_id
LEFT JOIN 
dia_chi_nguoi_dung d ON o.id_dia_chi_nguoi_dung = d.id
WHERE 
o.id_nguoi_dung = ?
GROUP BY 
o.order_id;
";

  return pdo_query($sql, $user_id);
}

$orderList = getAllOrderLogs($_SESSION['user']['id']);

?>

<div class="container">
  <h2>Danh sách đơn hàng</h2>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID đơn đặt hàng</th>
          <th>Ghi Chú</th>
          <th>Phương Thức Thanh Toán</th>
          <th>Tên Người Nhận</th>
          <th>Số Điện Thoại</th>
          <th>Địa Chỉ</th>
          <th>Tổng giá trị đơn hàng</th>
          <th>Trạng Thái</th>
          <th>Tạo Vào Lúc</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($orderList)) : ?>
          <tr>
            <td colspan="10">Bạn chưa có đơn hàng nào</td>
          </tr>
        <?php else : ?>
          <?php foreach ($orderList as $item) : ?>
            <tr>
              <td><?= $item['order_id'] ?></td>
              <td><?= $item['ghi_chu'] ?></td>
              <td><?= $item['phuong_thuc_thanh_toan'] ?></td>
              <td><?= $item['ten_nguoi_nhan'] ?></td>
              <td><?= $item['so_dien_thoai'] ?></td>
              <td><?= $item['dia_chi'] ?></td>
              <td><?= $item['total_order_price'] ?> VNĐ</td>
              <td><?= $item['trang_thai'] ?></td>
              <td><?= $item['tao_vao_luc'] ?></td>
              <td>
                <a href="index.php?act=chitietdonhang&id=<?= $item['order_id'] ?>" class="btn btn-info btn-sm">Xem chi tiết đơn đặt</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>

      </tbody>
    </table>
  </div>
</div>