<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      
    </style>
</head>
<body>
            <H1 style="text-align: center;">Dang Ky Tai Khoan</H1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-9">
    <form class="row g-3" action="index.php?act=login" method="post">
          <div class="col-md-6">
            <label for="inputAddress" class="form-label">User Name</label>
            <input type="text" class="form-control" name="user" id="inputAddress" placeholder="UserName">
          </div>
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="email chính của bạn">
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" name="pass" id="inputPassword4" placeholder="NHập đủ chữ hoa,chữ thường,số,và 1 ký tự đặc biệt">
          </div>
          <!-- <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress2" name="address" placeholder="Vị trí giao hàng chi tiêt">
          </div> -->
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Phone</label>
            <input type="number" class="form-control" name="phonenumber" id="inputCity" placeholder="Số điện thoại chính của bạn">
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
            <button type="submit" class="btn btn-primary" onclick = "return confirm('Bạn đã đăng ký thành công')" name="submit">Sign in</button>
          </div>
        </form>
            </div>
        </div>
    </div>
</body>
</html>