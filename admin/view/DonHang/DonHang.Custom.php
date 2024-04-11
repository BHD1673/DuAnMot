<?php
$id = $_GET['id'];
$sql = "SELECT oi.item_id, oi.item_name, oi.item_variant, oi.item_price, oi.item_quantity, oi.item_total_price
    FROM order_items oi
    JOIN orders o ON oi.order_id = o.order_id
    WHERE o.order_id = $id;";

$orderValue = pdo_query($sql);

$getAdressQuery = "SELECT o.*, dcn.* 
FROM order_items oi
JOIN orders o ON oi.order_id = o.order_id
JOIN dia_chi_nguoi_dung dcn ON o.id_dia_chi_nguoi_dung = dcn.id
WHERE oi.order_id = $id;
";
$addressValue = pdo_query_one($getAdressQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["status"]) && !empty($_POST["status"])) {
        $order_id = $_GET["id"];
        $status = $_POST["status"];
        
        try {
            // Update the order status in the database
            $sql = "UPDATE orders SET trang_thai = ? WHERE order_id = ?";
            pdo_execute($sql, $status, $order_id);
            
            echo "<script>alert('Trạng thái đơn đã được cập nhật thành công.');</script>";
            header('location: admin.php?act=donhang');
        } catch(PDOException $e) {
            echo "<script>alert('Đã xảy ra lỗi khi cập nhật trạng thái đơn.');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng chọn trạng thái đơn.');</script>";
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action method="POST">
                <div class="form-group">
                    <label for="id"><h1>Cập nhật trạng thái đơn</h1></label>
                    <select name="status" id="id" class="form-control">
                        <option value="">Chọn trạng thái đơn</option>
                        <option value="Đơn đã được gửi đi">Đơn đã được gửi đi</option>
                        <option value="Đã thanh toán">Đã thanh toán đơn</option>
                        <option value="Huỷ đơn">Đơn đã bị huỷ</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h3> &nbsp;<b class="text-danger">Đơn hàng được gửi từ :</b></h3>
                                <p class="text-muted m-l-5">26 An Trai, Hà Nội
                                </p>
                            </address>
                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <h3>Tới,</h3>
                                <h4 class="font-bold"><?php echo $addressValue['ten_nguoi_nhan'] ?></h4>
                                <p class="text-muted m-l-5">
                                    <?php
                                    echo $addressValue['dia_chi'];
                                    ?>

                                </p>
                                <p class="m-t-30"><b>Hóa đơn tạo lúc :</b> <i class="fa fa-calendar"></i> <?php echo $addressValue['tao_vao_luc'] ?></p>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Chi tiết</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Giá tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderValue as $item) : ?>
                                        <tr>
                                            <td><?= $item['item_name'] ?></td>
                                            <td><?= $item['item_variant'] ?></td>
                                            <td><?= $item['item_price'] ?></td>
                                            <td><?= $item['item_quantity'] ?></td>
                                            <td id="total-quantity"><?= $item['item_total_price'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <h3><b>Tổng đơn hàng :</b> <span id="total-sum-up"></span> VNĐ</h3>
                        </div>
                        <div class="clearfix"><h4>Trạng thái đơn hàng : <?php echo $addressValue['trang_thai']; ?></h4></div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var totalQuantityElements = document.querySelectorAll("#total-quantity");
        var totalSum = 0;

        totalQuantityElements.forEach(function(element) {
            totalSum += parseFloat(element.textContent);
        });

        var totalSumUpDiv = document.getElementById("total-sum-up");
        totalSumUpDiv.textContent =+ totalSum;
    });
</script>
