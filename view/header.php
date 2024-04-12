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
<style>
	.header-search .search-form {
    display: flex;
    align-items: center;
}

.header-search .form-select,
.header-search .form-control,
.header-search .btn {
    margin-right: 10px;
}
.search-form select.form-select {
    width: auto; /* Đặt chiều rộng tự động */
    padding: 10px; /* Khoảng cách giữa nội dung và viền */
    font-size: 10px; /* Kích thước font chữ */
    margin-right: 10px; /* Khoảng cách với phần tử tiếp theo */
	height: 35px;
}

.search-form input.form-control {
    width: 500px;
    padding: 10px; 
    font-size: 16px; 
    margin-right: 10px; 
}

</style>
<body>
	<header>
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-right">
					<?php if (isset($_SESSION['user'])) : ?>
						<?php if ($_SESSION['user']['role'] == '1') : ?>
							<li><a href="index.php?act=unsetLoginValue"><i class="fa fa-dollar"></i>Đăng Xuất</a></li>
							<li><a href="admin.php"><i class="fa fa-user"></i>Quản lý</a></li>
						<?php else : ?>
							<li><a href="index.php?act=unsetLoginValue"><i class="fa fa-dollar"></i>Đăng Xuất</a></li>
							<li><a href="index.php?act=profile"><i class="fa fa-user"></i>Chi tiết tài khoản</a></li>
						<?php endif; ?>
					<?php else : ?>
						<li><a href="index.php?act=login"><i class="fa fa-user"></i>Đăng nhập</a></li>
						<li><a href="index.php?act=singup"><i class="fa fa-user"></i>Đăng ký</a></li>
					<?php endif; ?>

					<li>
						<?php if (isset($_SESSION['user'])) : ?>
							<a href="<?php echo ($_SESSION['user']['role'] == '1') ? 'admin.php' : ''; ?>"><i class="fa fa-user-o"></i><?php echo $_SESSION['user']['ho_ten']; ?></a>
						<?php endif; ?>
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
					<div class="col-md-8">
					<div class="header-search">
					<form method="post" action="" class="search-form">
						<select class="form-select" name="category_id">
							<option value="0" selected>All_category</option>
							<?php foreach ($category as $value) : extract($value); ?>
								<option value="<?= $id ?>"><?= $ten_danh_muc ?></option>
							<?php endforeach ?>
						</select>
						<input class="form-control" placeholder="Search here" name="product_name">
						<button type="submit" class="btn btn-danger" name="search">Search</button>
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