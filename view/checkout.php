<?php
$sql = "SELECT * FROM `dia_chi_nguoi_dung` WHERE id_nguoi_dung = ? AND la_dia_chi_chinh = ?";
$value = pdo_query($sql, $_SESSION['user']['id'], 1);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $order_notes = $_POST['order-notes'];
    $payment_method = $_POST['payment_method'];
	$id_dia_chi_nguoi_dung = $value[0]['id'];
	$id_nguoi_dung = $_SESSION['user']['id'];

    $order_items = $_SESSION['cartValue'];
    
    $order_id = pdo_execute(
		"INSERT INTO orders (id_nguoi_dung, id_dia_chi_nguoi_dung, ghi_chu, phuong_thuc_thanh_toan) VALUES (?, ?, ?, ?)", 
		$id_nguoi_dung, 
		$id_dia_chi_nguoi_dung, 
		$order_notes,
		$payment_method);

    foreach ($order_items as $item) {
        $item_name = $item['itemName'];
        $item_variant = $item['itemVariant'];
        $item_price = $item['itemPrice'];
        $item_quantity = $item['itemQuantity'];
        $item_total_price = $item['itemTotalPrice'];
        
        pdo_execute("INSERT INTO order_items (order_id, item_name, item_variant, item_price, item_quantity, item_total_price) VALUES (?, ?, ?, ?, ?, ?)",
                    $order_id, $item_name, $item_variant, $item_price, $item_quantity, $item_total_price);
    }
    
    header('location: index.php?act=thanhtoanthanhcong');
}



?>
<form action="" method="post">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Địa chỉ người nhận</h3>
							<?php


							?>
						</div>
						<div class="caption">
							<?php foreach ($value as $item) : ?>
								<div class="form-group">
									<input class="input" type="text" name="name" placeholder="Tên người nhận" value="<?php echo $item['ten_nguoi_nhan']; ?>" disabled>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="address" placeholder="Địa chỉ người nhận" value="<?php echo $item['dia_chi']; ?>" disabled>
								</div>
								<div class="form-group">
									<input class="input" type="tel" name="tel" placeholder="Số điện thoại người nhận" value="<?php echo $item['so_dien_thoai']; ?>" disabled>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="order-notes">
						<textarea class="input" name="order-notes" placeholder="Ghi chú cho bên vận chuyển"></textarea>
					</div>
				</div>
				<?php
				if (isset($_SESSION['cartValue'])) {
					$cartValue = $_SESSION['cartValue'];
				} else {
					$cartValue = array();
				}

				$total = 0;

				foreach ($cartValue as $item) {
					$total += (float)$item['itemTotalPrice'];
				}

				?>

				<div class="col-md-5 order-details">
					<div class="section-title text-center">
						<h3 class="title">Đơn hàng của bạn</h3>
					</div>
					<div class="order-summary">
						<div class="order-col">
							<div><strong>Sản phẩm</strong></div>
							<div><strong>Tổng</strong></div>
						</div>
						<div class="order-products">
							<?php foreach ($cartValue as $item) : ?>
								<div class="order-col">
									<div><?php echo $item['itemQuantity'] . "x " . $item['itemName']; ?></div>
									<div style="color: red;"><?php echo $item['itemVariant']; ?></div>
									<div><?php echo number_format((float)$item['itemTotalPrice'], 2); ?> VNĐ</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="order-col">
							<div><strong>Tổng</strong></div>
							<div><strong class="order-total"><?php echo number_format($total, 2); ?> VNĐ</strong></div>
						</div>
					</div>
					<div class="payment-method">
						<h4>Phương thức thanh toán</h4>
						<label><input type="radio" name="payment_method" value="COD"> Thanh toán COD</label>
					</div>
					<input type="hidden" name="order_id" value="<?php $order_id = uniqid();
																echo $order_id ?>">
					<input type="hidden" name="customer_id" value="<?php echo $_SESSION['user']['id']; ?>">
					<input type="hidden" name="shipping_id" value="<?php

																	$sql = "SELECT id FROM dia_chi_nguoi_dung WHERE id_nguoi_dung = ? AND la_dia_chi_chinh = ?";
																	$customer_id = pdo_query($sql, $_SESSION['user']['id'], 1);
																	echo $customer_id[0]['id']; ?>">
					<button class="submit primary-btn order-submit">Đặt đơn hàng</button>
				</div>

			</div>
		</div>
	</div>
</form>