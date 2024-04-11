		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- STORE -->
					<div id="store" class="col-md-10">
						<!-- store products -->
						<div class="row">
							<?php foreach ($search_result as $product) : ?>
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img" style="width: 200px; height: 150px;">
											<img src="uploads/<?= $product['product_image'] ?>" alt="">
											<div class="product-label">
												<!-- <span class="sale">-30%</span>
											<span class="new">NEW</span> -->
											</div>
										</div>
										<div class="product-body">
											<p class="product-category"><?= $product['category_name'] ?></p>
											<h3 class="product-name" style="width: 200px; height: 100px;"><a href="index.php?act=detailProduct&id_sp=<?= $product['product_id'] ?>"><?= $product['product_name'] ?></a></h3>
											<h4 class="product-price">$<?= $product['product_price'] ?>.00 <del class="product-old-price">$990.00</del></h4>
										</div>
										<div class="add-to-cart">
											<a href="index.php?act=detailProduct&id_sp=<?= $product['product_id'] ?>" class="add-to-cart-btn">
												<i class="fa fa-shopping-cart"></i>Xem chi tiết sản phẩm
											</a>
										</div>


									</div>
								</div>
							<?php endforeach; ?>

							<div class="clearfix visible-sm visible-xs"></div>
							<!-- /product -->
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<!-- <div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div> -->
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->