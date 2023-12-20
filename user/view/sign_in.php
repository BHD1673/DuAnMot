

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
              <input type="text" class="form-control" id="username" name="username" value="<?= isset($username) ? $username : ''; ?>">
              <div class="invalid-feedback">
                <?= isset($usernameError) ? $usernameError : ''; ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="password" class="form-control" id="password" name="password" value="<?= isset($password) ? $password : ''; ?>">
              <div class="invalid-feedback">
                <?= isset($passwordError) ? $passwordError : ''; ?>
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
