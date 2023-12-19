<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Đăng nhập</h3>
        </div>
        <div class="card-body">
          <form class="needs-validation" method="post" novalidate>
            <div class="mb-3">
              <label for="username" class="form-label">Tên tài khoản :</label>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
              <div class="invalid-feedback">
                  <?php echo isset($username) ? 'Vui lòng nhập một địa chỉ email hợp lệ.' : 'Vui lòng nhập tên tài khoản.'; ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="text" class="form-control" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
              <div class="invalid-feedback">
                  <?php echo isset($password) ? 'Vui lòng nhập mật khẩu chính xác.' : 'Vui lòng nhập mật khẩu.'; ?>
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
