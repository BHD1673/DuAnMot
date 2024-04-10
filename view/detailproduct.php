<?php
$id = $_GET['id_sp'];

$variants = getVariantsForProduct($id);
$value = get_product_detail($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["add_to_cart"])) {
		$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
		$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

		$variant_values = isset($_POST['variant_values']) ? $_POST['variant_values'] : array();

		$variant_values = array_slice($variant_values, 0, 5);
		$variant_values = array_pad($variant_values, 5, null);

		$user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

		try {
			// Check if the product already exists in the user's cart
			$existing_product = pdo_query_one("SELECT * FROM gio_hang WHERE id_nguoi_dung = ? AND id_san_pham_bien_the_1 = ?", $user_id, $variant_values[0]);

			if ($existing_product) {
				// Update quantity if the product already exists
				$new_quantity = $existing_product['so_luong'] + $quantity;
				$affected_rows = pdo_execute("UPDATE gio_hang SET so_luong = ? WHERE id_nguoi_dung = ? AND id_san_pham_bien_the_1 = ?", $new_quantity, $user_id, $variant_values[0]);

				echo "Cập nhật số lượng sản phẩm trong giỏ hàng thành công";
			} else {
				// Insert new product if it doesn't exist
				$affected_rows = pdo_execute("INSERT INTO gio_hang (id_nguoi_dung, session_guest, id_san_pham_bien_the_1, id_san_pham_bien_the_2, id_san_pham_bien_the_3, id_san_pham_bien_the_4, id_san_pham_bien_the_5, so_luong) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", $user_id, $_SESSION['guest_id'], $variant_values[0], $variant_values[1], $variant_values[2], $variant_values[3], $variant_values[4], $quantity);

				echo "Thêm sản phẩm vào giỏ hàng thành công";
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	if (isset($_POST["submit-comment"])) {
		$product_id = $_POST["product_id"];
		$content = $_POST["content"];

		if (empty($content)) {
			echo "Vui lòng nhập nội dung bình luận";
		}

		$user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

		addComment($user_id, $product_id, $content);
		echo '<script>
			alert("Thêm Bình Luận Thành Công");
		</script>';
		header("location: index.php?act=detailProduct&id_sp=$id");
	}
}

// if (!isset($_SESSION['user'])) {
// 	echo '<script>
// 	alert("Ban can phai dang nhap");
// 	window.location= "index.php?act=login";

// </script>';

// }


// pre_dump($value);
// // session_destroy();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<?php
					$image_paths = explode(',', $value['product_images']);
					if (!empty($image_paths)) {
					?>
						<div class="product-preview">
							<img src="uploads/<?= trim($image_paths[0]) ?>" alt="">
						</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-2 col-md-pull-5">
				<div id="product-imgs">
					<?php
					for ($i = 1; $i < count($image_paths); $i++) {
					?>
						<div class="product-preview">
							<img src="uploads/<?= trim($image_paths[$i]) ?>" alt="">
						</div>
					<?php
					}
					?>
				</div>
			</div>

			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name"><?= $value['product_name'] ?></h2>
					<div>
						<h3 class="product-price"> Giá: <?= $value['product_price'] ?> VNĐ </h3>
					</div>
					<p>Thuộc danh mục: <?= $value['category_name'] ?></p>

					<form method="post">
						<input type="hidden" name="product_id" value="<?= $_GET['id_sp'] ?>">
						<div class="product-options">
							<?php
							if (empty($variants)) {
								echo '<p>No variants found for the product.</p>';
							} else {
								echo '<div class="product-options">';
								foreach ($variants as $variant) {
									echo '<label>' . $variant['ten_bien_the'] . '<select name="variant_values[' . $variant['id'] . ']" class="input-select">';
									if (!empty($variant['variant_values'])) {
										$values = explode(',', $variant['variant_values']);
										foreach ($values as $value) {
											$pair = explode(':', $value);
											$variantId = $pair[0];
											$variantValue = $pair[1];
											echo '<option value="' . $variantId . '">' . $variantValue . '</option>';
										}
									}
									echo '</select></label>';
								}
								echo '</div>';
							}
							?>

						</div>
						<div class="add-to-cart">
							<div class="qty-label">
								Số lượng sản phẩm
								<div class="input-number">
									<input type="number" name="quantity" value="1">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							<button type="submit" name="add_to_cart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<div id="product-tab">
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Mô tả sản phẩm</a></li>
						<li><a data-toggle="tab" href="#tab3">Comment về sản phẩm</a></li>
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php
										$description = pdo_query_one("SELECT san_pham.mo_ta FROM `san_pham` WHERE `id` = $id");
										$decoded_description = html_entity_decode($description['mo_ta']);
										echo $decoded_description;

										?></p>
								</div>
							</div>
						</div>
						<div id="tab3" class="tab-pane fade in">
							<div class="container mt-5">
								<div class="row">
									<div class="col-md-6">
										<div id="reviews">
											<div class="card">
												<div class="card-body">
													<h3 class="card-title">Đánh giá sản phẩm</h3>
													<form action="" method="post">
														<?php
														$product_id = isset($_GET['id_sp']) ? $_GET['id_sp'] : '';
														?>
														<input type="hidden" name="product_id" value="<?= $product_id ?>">

														<div class="form-group">
															<?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['ho_ten'])) : ?>
																<label for="username">Tài khoản:</label>
																<p><?= htmlspecialchars($_SESSION['user']['ho_ten']) ?></p>

																<div class="form-group">
																	<label for="content">Nội dung bình luận:</label>
																	<textarea name="content" class="form-control" rows="4" style="max-width: 500px" placeholder="Nhập nội dung bình luận"></textarea>
																</div>

																<button type="submit" class="btn btn-primary" name="submit-comment">Thêm Bình Luận</button>
															<?php else : ?>
																<p>Bạn cần <a href="index.php?act=login">đăng nhập</a> để đánh giá.</p>
															<?php endif; ?>
														</div>
													</form>

												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Các Đánh Giá Trước Đó</h5>
												<!-- Hiển thị các bình luận -->
												<?php foreach ($list_comments as $comment) : ?>
													<div class="card mb-3">
														<div class="card-body">
															<h6 class="card-subtitle mb-2 text-muted"><?php echo $comment['user_name']; ?></h6>
															<p class="card-text"><?php echo $comment['comment']; ?></p>
															<p class="card-text"><small class="text-muted"><?php echo $comment['created_at']; ?></small></p>
														</div>
													</div>
												<?php endforeach; ?>
												<!-- Thêm các phần tử comment cần thiết cho các bình luận khác -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>