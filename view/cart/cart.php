<?php

$cartItems = getCartValue();
// pre_dump($cart);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['quantity']) && isset($_POST['item_id'])) {

        $item_id = $_POST['item_id'];
        $quantity_change = $_POST['quantity'] == '+' ? 1 : -1; 

        try {
            $conn = pdo_get_connection();
            $sql = "UPDATE gio_hang SET so_luong = so_luong + ? WHERE id = ?";
            pdo_execute($sql, $quantity_change, $item_id);
        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();
        } finally {
            unset($conn);
        }
    }
}

?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Biến thể</th>
                <th>Giá trị một sản phẩm</th>
                <th>Tổng giá trị sản phẩm</th>
                <th>Số lượng</th>
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
                    <td class="total-price"><?php echo $item['total_price_with_quantity']; ?></td>
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
                    <td>
                        <a href="delete_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">Xoá</a>
                        <a href="item_detail.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Về trang chi tiết sản phẩm</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <div class="total-cart-value"></div>
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