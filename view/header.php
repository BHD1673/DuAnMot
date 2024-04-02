<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Web Electro Việt Nam</title>
	<meta name="description" content="Electro is your one-stop shop for high-quality laptops. Browse our wide selection of laptops from top brands at competitive prices.">
	<meta name="keywords" content="Electro, laptops, computers, electronics, technology, shop, online shop, pc, tshirt">
	<meta name="author" content="Electro Việt">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="7 days">
	<meta name="og:title" content="Electro - Your Destination for Quality Laptops">
	<meta name="og:description" content="Electro is your one-stop shop for high-quality laptops. Browse our wide selection of laptops from top brands at competitive prices.">
	<meta name="og:image" content="url_to_your_image.jpg">
	<meta name="og:url" content="https://www.example.com">
	<meta name="og:type" content="website">
	<meta name="twitter:title" content="Electro - Your Destination for Quality Laptops">
	<meta name="twitter:description" content="Electro is your one-stop shop for high-quality laptops. Browse our wide selection of laptops from top brands at competitive prices.">

	<title>Electr0 Việt Nam</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/cart.css" />
</head>

<body>
	<header>
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="admin.php"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
					<li><a href="admin.php"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
					<li><a href="admin.php"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
				</ul>
				<ul class="header-links pull-right">
					<?php
					if (isset($_SESSION['user'])) {
						if ($_SESSION['user']['role'] == '1') {
							echo '<li><a href="index.php?act=unsetLoginValue"><i class="fa fa-dollar"></i>Đăng Xuất</a></li>';
						} else if ($_SESSION['user']['role'] == '0') {
							echo '<li><a href="index.php?act=unsetLoginValue"><i class="fa fa-dollar"></i>Đăng Xuất</a></li>';
							echo '<li><a href="index.php?act=profile"><i class="fa fa-user"></i>Chi tiết tài khoản</a></li>';
						}
					}

					if (empty($_SESSION['user'])) {
						echo '<li><a href="index.php?act=login"><i class="fa fa-user"></i>Đăng nhập</a></li>';
						echo '<li><a href="index.php?act=singup"><i class="fa fa-user"></i>Đăng ký</a></li>';
					}
					?>


					<li>
						<?php
						if (isset($_SESSION['user'])) {
							if ($_SESSION['user']['role'] == '1') {
								echo '<a href="admin.php"><i class="fa fa-user-o"></i>' . $_SESSION['user']['ho_ten'] . '</a>';
							} else {
								echo '<a href="admin.php"><i class="fa fa-user-o"></i>' . $_SESSION['user']['ho_ten'] . '</a>';
							}
						}
						?>
					</li>

				</ul>
			</div>
		</div>
		<div id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="header-logo">
							<a href="index.php" class="logo">
								<img src="./img/logo.png" alt="">
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="header-search">
							<form method="post" action="">
								<select class="input-select" name="category_id">
									<option value="0" selected>
										All_category
									</option>
									<?php
									foreach ($category as $value) :
										extract($value);
									?>
										<option value="<?= $id ?>"><?= $ten_danh_muc ?> </option>
									<?php endforeach ?>
								</select>
								<input class="input" placeholder="Search here" name="product_name"> <!-- Added name attribute here -->
								<button class="search-btn" name="search">Search</button>
							</form>
						</div>
					</div>
					<script>
						document.addEventListener("DOMContentLoaded", function() {
							const form = document.querySelector("form");

							form.addEventListener("submit", function(event) {
								event.preventDefault();

								const categorySelect = document.querySelector("select[name='category_id']");
								const searchText = document.querySelector("input[name='product_name']").value.trim();

								if (searchText) {
									window.location.href = `index.php?act=search&product_name=${searchText}`;
								} else {
									const selectedCategoryId = categorySelect.value;
									window.location.href = `index.php?act=search&category_id=${selectedCategoryId}`;
								}
							});
						});
					</script>
					<div class="col-md-3 clearfix">
						<div class="header-ctn">

							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="index.php?act=">
									<i class="fa fa-shopping-cart"></i>
									<span>Giỏ hàng của bạn</span>
									<div class="qty">3</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<div class="product-widget">
											<div class="product-img">
												<img src="./img/product01.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>

										<div class="product-widget">
											<div class="product-img">
												<img src="./img/product02.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>
									</div>
									<div class="cart-summary">
										<small>3 Item(s) selected</small>
										<h5>SUBTOTAL: $2940.00</h5>
									</div>
									<div class="cart-btns">
										<a href="#">View Cart</a>
										<a href="index.php?act=cart">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>

							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>

						</div>
					</div>

				</div>

			</div>
		</div>
	</header>
	<nav id="navigation">
		<div class="container">
			<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav text-center ">
					<li><a href="index.php">Trang chủ</a></li>
					<li><a href="index.php?act=search">Danh sách sản phẩm</a></li>
					<li><a href="index.php?act=support">Hỗ trợ</a></li>
					<li><a href="index.php?act=aboutus">Về chúng tôi</a></li>
					<li><a href="index.php?act=contact">Liên hệ</a></li>
					<li><a href="index.php?act=cart">Giỏ hàng</a></li>
				</ul>
			</div>
		</div>
	</nav>
	</div>