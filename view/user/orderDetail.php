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
?>
<div class="container-fluid col-12">
    <div class="row">
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
                        <div class="text-right">
                            <a class="btn btn-danger" href="index.php?act=huydonhang&idDonHang="> Huỷ đơn hàng ? </a>
                        </div>
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
