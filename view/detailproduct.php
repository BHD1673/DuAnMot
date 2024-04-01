<?php
$id = $_GET['id_sp'];

function get_product_detail($id)
{
    $sql = "SELECT 
                sp.id AS product_id,
                sp.ten_san_pham AS product_name,
                dm.ten_danh_muc AS category_name,
                sp.gia_co_ban AS product_price,
                sp.mo_ta AS product_description,
                COALESCE(spb.total_quantity, 0) AS total_quantity,
                GROUP_CONCAT(spbt.id, ':', spbt.gia_tri) AS variant_values,
                GROUP_CONCAT(spbt.image) AS product_images
            FROM 
                san_pham sp
            INNER JOIN 
                danh_muc dm ON sp.id_danh_muc = dm.id
            LEFT JOIN (
                SELECT 
                    id_san_pham,
                    SUM(so_luong) AS total_quantity
                FROM 
                    san_pham_bien_the
                GROUP BY 
                    id_san_pham
            ) spb ON sp.id = spb.id_san_pham
            LEFT JOIN san_pham_bien_the spbt ON sp.id = spbt.id_san_pham
            WHERE 
                sp.id = ?
            GROUP BY 
                sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban, sp.mo_ta, spb.total_quantity";

    return pdo_query_one($sql, $id);
}

function getVariantsForProduct($productId)
{
    $sql = "SELECT st.id, st.ten_bien_the, GROUP_CONCAT(spbt.id, ':', spbt.gia_tri) AS variant_values
            FROM bien_the st
            LEFT JOIN san_pham_bien_the spbt ON spbt.id_bien_the = st.id
            WHERE spbt.id_san_pham = ?
            AND st.ten_bien_the IS NOT NULL
            GROUP BY st.id, st.ten_bien_the";

    $rows = pdo_query($sql, $productId);

    $variants = array();

    foreach ($rows as $row) {
        $variantId = $row["id"];
        $variantName = $row["ten_bien_the"];
        $variantValues = $row["variant_values"];

        $variants[] = array(
            "id" => $variantId,
            "ten_bien_the" => $variantName,
            "variant_values" => $variantValues
        );
    }

    return $variants;
}

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
}


// pre_dump($value);
// // session_destroy();
?>
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<?php
					$image_paths = explode(',', $value['product_images']);
					// Display the first image as the main image
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
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2 col-md-pull-5">
				<div id="product-imgs">
					<?php
					// Display the rest of the images as thumbnails
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
			<!-- /Product thumb imgs -->



			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name"><?= $value['product_name'] ?></h2>
					<div>
						<h3 class="product-price"><?= $value['product_price'] ?></h3>
						<!-- <span class="product-available">In Stock</span> -->
					</div>
					<p><?= $value['category_name'] ?></p>

					<!-- HTML form -->
					<form method="post">
						<!-- Product ID field (hidden) -->
						<input type="hidden" name="product_id" value="<?= $_GET['id_sp'] ?>"> <!-- Replace '1' with actual product ID -->

						<!-- Product Options -->
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

						<!-- End Product Options -->

						<!-- Quantity field -->
						<div class="add-to-cart">
							<div class="qty-label">
								Qty
								<div class="input-number">
									<input type="number" name="quantity">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							<!-- Add to cart button -->
							<button type="submit" name="add_to_cart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
						</div>
					</form>
				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php 
									$description = pdo_query_one("SELECT san_pham.mo_ta FROM `san_pham` WHERE `id` = $id");
									echo $description['mo_ta'];
									?></p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
										</ul>
										<ul class="reviews-pagination">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form">
											<input class="input" type="text" placeholder="Your Name">
											<input class="input" type="email" placeholder="Your Email">
											<textarea class="input" placeholder="Your Review"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
												</div>
											</div>
											<button class="primary-btn">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>

			<!-- product -->
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<div class="product-img">
						<img src="./img/product01.png" alt="">
						<div class="product-label">
							<span class="sale">-30%</span>
						</div>
					</div>
					<div class="product-body">
						<p class="product-category">Category</p>
						<h3 class="product-name"><a href="#">product name goes here</a></h3>
						<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
						<div class="product-rating">
						</div>
						<div class="product-btns">
							<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
							<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
							<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
						</div>
					</div>
					<div class="add-to-cart">
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>
				</div>
			</div>
			<!-- /product -->

			<!-- product -->
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<div class="product-img">
						<img src="./img/product02.png" alt="">
						<div class="product-label">
							<span class="new">NEW</span>
						</div>
					</div>
					<div class="product-body">
						<p class="product-category">Category</p>
						<h3 class="product-name"><a href="#">product name goes here</a></h3>
						<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-btns">
							<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
							<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
							<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
						</div>
					</div>
					<div class="add-to-cart">
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>
				</div>
			</div>
			<!-- /product -->

			<div class="clearfix visible-sm visible-xs"></div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->