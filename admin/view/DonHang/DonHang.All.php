<?php 

$sql = "SELECT 
o.order_id,
o.id_nguoi_dung,
nd.ho_ten AS user_name,
dcn.ten_nguoi_nhan AS receiver_name,
dcn.dia_chi AS delivery_address,
o.ghi_chu,
o.trang_thai,
o.tao_vao_luc
FROM orders o
LEFT JOIN nguoi_dung nd ON o.id_nguoi_dung = nd.id
LEFT JOIN dia_chi_nguoi_dung dcn ON o.id_dia_chi_nguoi_dung = dcn.id
ORDER BY o.tao_vao_luc DESC;
";

$value = pdo_query($sql);



?>

<div class="container">
        <h2>Danh sách đơn hàng</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người nhận</th>
                    <th>Nơi nhận</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($value as $order): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['receiver_name'] ?? 'N/A'; ?></td>
                    <td><?php echo $order['delivery_address'] ?? 'N/A'; ?></td>
                    <td><?php echo $order['ghi_chu']; ?></td>
                    <td><?php echo $order['trang_thai']; ?></td>
                    <td><?php echo $order['tao_vao_luc']; ?></td>
                    <td>
                    <a href="admin.php?act=chitietdonhang&id=<?php echo $order['order_id']; ?>" class="btn btn-success">Xem chi tiết</a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>