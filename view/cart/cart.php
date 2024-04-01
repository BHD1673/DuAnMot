<?php



?>
<div class="container">
    <h1 style="color: red;">Giỏ hàng</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Biến thể</th>
                <th>Giá trị một sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng giá trị sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item) : ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['ten_san_pham']; ?></td>
                    <td><?php echo $item['attributes']; ?></td>
                    <td><?php echo $item['item_total_price']; ?></td>
                    <td>
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                <button class="btn btn-secondary quantity-input" type="submit" name="quantity" value="-">-</button>
                                <input type="text" class="form-control" name="quantity" value="<?php echo $item['so_luong']; ?>">
                                <button class="btn btn-secondary quantity-input" type="submit" name="quantity" value="+">+</button>
                            </div>
                        </form>
                    </td>
                    <td class="total-price"><?php echo $item['total_price_with_quantity']; ?></td>
                    <td>
                        <a href="index.php?act=thanhtoan&id=<?php echo $item['id']; ?>" class="btn btn-success">Thanh toán sản phẩm</a>
                        <a href="index.php?act=xoakhoigiohang&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xoá</a>
                        <a href="index.php?act=detailProduct&id=<?php echo $item['id']; ?>" class="btn btn-primary">Về trang chi tiết sản phẩm</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <h3><div class="total-cart-value"></div></h1>
            <a href="index.php?act=thanhtoantong" class="btn btn-success" style="    display: flex;
    justify-content: center;">Thanh toán tất cả</a>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var totalPrices = document.querySelectorAll('.total-price');

        var total = 0;
        totalPrices.forEach(function(price) {
            var value = parseFloat(price.textContent);
            total += value;
        });

        var totalCartValueElement = document.querySelector('.total-cart-value');
        totalCartValueElement.textContent = "Tổng giá trị giỏ hàng: " + total.toLocaleString() + " VNĐ";
    });
</script>