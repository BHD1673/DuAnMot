<?php
$sql = "SELECT * FROM dia_chi_nguoi_dung WHERE id_nguoi_dung = ?";
$list = pdo_query($sql, 2);

// pre_dump($list);
// exit;

$data = getCartValue();
$totalPrice = 0; // Initialize total price variable
foreach ($data as $item) {
    $itemTotal = (int)$item['item_total_price'];
    $quantity = (int)$item['so_luong'];
    $totalPrice += $itemTotal * $quantity;
}

function validateForm($data) {
    $errors = array();

    if (!isset($data['total_price']) || !is_numeric($data['total_price']) || $data['total_price'] <= 0) {
        $errors[] = "Total price must be a valid number greater than zero.";
    }

    if (!isset($data['payment']) || empty($data['payment'])) {
        $errors[] = "Payment method must be selected.";
    }

    if (!isset($data['terms_agreement']) || $data['terms_agreement'] != 'on') {
        $errors[] = "You must agree to the terms and conditions.";
    }

    if (isset($data['products'])) {
        foreach ($data['products'] as $key => $product) {
            if (!isset($data['quantities'][$key]) || !isset($data['item_prices'][$key])) {
                $errors[] = "Invalid product data.";
                break;
            }
            if (!is_numeric($data['quantities'][$key]) || $data['quantities'][$key] <= 0) {
                $errors[] = "Quantity for product $product must be a valid number greater than zero.";
            }
            if (!is_numeric($data['item_prices'][$key]) || $data['item_prices'][$key] <= 0) {
                $errors[] = "Item price for product $product must be a valid number greater than zero.";
            }
        }
    }
    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = validateForm($_POST);

    if (empty($errors)) {
        $totalPrice = $_POST['total_price'];
        $paymentMethod = $_POST['payment'];
        $termsAgreement = isset($_POST['terms_agreement']) ? 1 : 0;
        $sql = "INSERT INTO orders (total_price, payment_method, terms_agreement) VALUES (?, ?, ?)";
        pdo_execute($sql, $totalPrice, $paymentMethod, $termsAgreement);

        $pdo = pdo_get_connection();
        $orderId = $pdo->lastInsertId();

        if (isset($_POST['products'])) {
            foreach ($_POST['products'] as $key => $product) {
                $productName = $product;
                $quantity = $_POST['quantities'][$key];
                $itemPrice = $_POST['item_prices'][$key];

                $stmt = $pdo->prepare("INSERT INTO order_products (order_id, product_name, quantity, item_price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$orderId, $productName, $quantity, $itemPrice]);
            }
        }
        header("Location: index.php?act=thanhtoanthanhcong");
        exit();
    }
}




?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5" style=" padding-right: 10px;">
                <div class="billing-details">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên Người Nhận</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $array) { ?>
                                <tr>
                                    <td><?php echo $array['ten_nguoi_nhan']; ?></td>
                                    <td><?php echo $array['so_dien_thoai']; ?></td>
                                    <td><?php echo $array['dia_chi']; ?></td>
                                    <td>
                                        <form id="form_<?php echo $array['id']; ?>" method="post" action="">
                                            <input type="hidden" name="form_type" value="address">
                                            <input type="hidden" name="id" value="<?php echo $array['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Chọn địa chỉ này</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="" method="post">
                <div class="col-md-5 order-details" style="padding-left: 93px;">
                    <div class="section-title text-center">
                        <h3 class="title">Đơn hàng của bạn</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>Tên sản phẩm</strong></div>
                            <div><strong>Giá trị</strong></div>
                        </div>
                        <?php foreach ($data as $item) : ?>
                            <div class="order-products">
                                <div class="order-col">
                                    <div><?= $item['so_luong'] ?>x <?= $item['ten_san_pham'] ?></div>
                                    <div><?= number_format($item['item_total_price'] * $item['so_luong'], 0, ',', '.') ?> VNĐ</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>Tổng giá trị</strong></div>
                            <div><strong class="order-total"><?= number_format($totalPrice, 0, ',', '.') ?> VNĐ</strong></div>
                        </div>
                        <!-- Hidden input fields to include product data and total price -->
                        <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                        <?php foreach ($data as $item) : ?>
                            <input type="hidden" name="products[]" value="<?= $item['ten_san_pham'] ?>">
                            <input type="hidden" name="quantities[]" value="<?= $item['so_luong'] ?>">
                            <input type="hidden" name="item_prices[]" value="<?= $item['item_total_price'] ?>">
                        <?php endforeach; ?>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" value="cash_on_delivery">
                            <label for="payment-1">
                                <span></span>
                                Thanh toán khi nhận hàng
                            </label>
                            <div class="caption">
                                <p>Bạn phải đồng ý rằng sẽ phải thanh toán khi nhận hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" name="terms_agreement">
                        <label for="terms">
                            <span></span>
                            Tôi đã đọc và đồng ý với các<a href="#"> điều kiện</a>
                        </label>
                    </div>
                    <button type="submit" class="primary-btn order-submit">Đặt đơn hàng</button>
                </div>
            </form>


        </div>

    </div>

</div>

</div>