<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Thêm khoảng cách giữa các dòng form */
        .mb-3 {
            margin-bottom: 30px; /* hoặc padding-bottom: 20px; */
            text-align: center;
        }
    </style>
</head>
<body>
    <H1 style="text-align: center;">Dang Nhap</H1>
    <div class="container" style="width: 500px;">
        <div class="row">
            <div class="col-12">
            <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label" style="">Ten Dang Nhap</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ten Dang Nhap" style="text-align: center;">
            </div>
            <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Mat Khau</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Mat Khau" style="text-align: center;">
            </div>
            </div>
        </div>
        <div class="col-md-12" style="text-align: center;"  >
    <button type="submit" class="btn btn-primary">Sign in</button>
    <br>
    <h6 style="margin-top: 20px;">Bạn chưa có tài khoản? <a href="index.php?act=singup">Đăng ký ngay</a></h6>
  </div>
    </div>

</body>
</html>