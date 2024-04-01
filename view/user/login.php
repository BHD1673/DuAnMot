
    <style>
        /* Thêm khoảng cách giữa các dòng form */
        .mb-3 {
            margin-bottom: 30px;
            /* hoặc padding-bottom: 20px; */
            text-align: center;
        }
    </style>

    <p class="text-center"><?php if (isset($_SESSION['msg']['cart-warning'])) echo $_SESSION['msg']['cart-warning'] ?></p>
    <?php unset($_SESSION['msg']['cart-warning']); ?>

    <H1 style="text-align: center;">Đăng nhập</H1>
    <div class="container" style="width: 500px;">
        <div class="row">
            <form action="index.php?act=login" method="POST">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="user" id="formGroupExampleInput" placeholder="Tên đăng nhập" style="text-align: center;">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control" name="pass" id="formGroupExampleInput2" placeholder="Nhập mật khẩu của bạn ở đây :)" style="text-align: center;">
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" name="submit" class="btn btn-primary">Đăng nhập</button>
                    <br>
                    <h6 style="margin-top: 20px;">Bạn chưa có tài khoản? <a href="index.php?act=singup">Đăng ký ngay hôm nay !</a></h6>
                </div>

            </form>
        </div>
    </div>
