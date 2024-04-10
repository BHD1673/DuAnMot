<?php  
$logoutMessage = isset($_SESSION['msg']['logout']) && !empty($_SESSION['msg']['logout']) ? $_SESSION['msg']['logout'] : ""; 
unset($_SESSION['msg']['logout']);
?>
		<footer id="footer" style="margin-top: 50px">
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Về chúng tôi</h3>
								<p>Electro là website bán hàng Việt Nam</p>
								<ul class="footer-links">
									<li><i class="fa fa-map-marker"></i>26 An Trai</li>
									<li><i class="fa fa-phone"></i>+84 365 486 687</li>
									<li><i class="fa fa-envelope-o"></i>duongbhph41427@email.com</li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Thông tin</h3>
								<ul class="footer-links">
									<li><a href="#">Về chúng tôi </a></li>
									<li><a href="#">Liên hệ</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Dịch vụ</h3>
								<ul class="footer-links">
									<li><a href="index.php?act=login">Đăng nhập</a></li>
									<li><a href="index.php?act=singup">Đăng ký tài khoản</a></li>
									<!-- blud said try to get a AI EO degree, yet somehow still write the signup to sing up, sing up what ? My ass ? -->
									<li><a href="index.php?act=profile">Tài khoản của tôi</a></li>
									<li><a href="#">Xem chi tiết giỏ hàng</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
	</body>
	
</html>
