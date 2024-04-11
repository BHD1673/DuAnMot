<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Danh sách sản phẩm</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<?php
										foreach ($product as $pro):

											extract($pro);
										?>
										<div class="product">
										<div class="product-img" style="width: 200px; height: 200px;">
											<img src="uploads/<?= $pro['product_image'] ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
										</div>

											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name" style="width: 200px; height: 100px;"><a href="index.php?act=detailProduct&id_sp=<?php echo $pro['product_id'] ?>""><?php echo $pro['product_name'] ?></a></h3>
												<h4 class="product-price"><?php echo $pro['product_price'] ?></h4>
											</div>
										</div>
										<?php endforeach?>
										<!-- product -->
										
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	