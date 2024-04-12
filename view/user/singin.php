<?php 

?>
<?php 
// Display errors if any
if(isset($_SESSION['errors'])) {
    foreach($_SESSION['errors'] as $error) {
        echo "<p>Error: $error</p>";
    }
    unset($_SESSION['errors']); // Clear errors after displaying
}
?>
<H1 style="text-align: center;">Đăng ký tài khoản</H1>
<br>
<div class="container">
  <div class="row">
    <div class="col-9">
      <form class="row g-3" method="post" novalidate>
        <div class="col-md-6">
          <label for="inputAddress" class="form-label">User Name</label>
          <input type="text" class="form-control" name="user" id="inputAddress" placeholder="Tên đăng nhập không cách không dấu">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" name="pass" id="inputPassword4" placeholder="Mật khẩu">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Phone</label>
          <input type="number" class="form-control" name="phonenumber" id="inputCity" placeholder="Số điện thoại của bạn">
        </div>
        <div class="col-md-8">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Check me out
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
        </div>
      </form>
    </div>
  </div>
</div>