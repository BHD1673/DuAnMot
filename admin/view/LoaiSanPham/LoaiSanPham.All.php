<body>

<?php 

$rows = get_danh_muc();

// echo "<pre>";
// var_dump($row);
// echo "</pre>";

if (isset($_SESSION['msg'])) {
    if(isset($_SESSION['msg']['danhmuc']) && $_SESSION['msg']['danhmuc'] !== '') {
        echo "<p style='color: red;'>" . $_SESSION['msg']['danhmuc'] . "</p>";
    } else {
        foreach ($_SESSION['msg'] as $key => $value) {
            if($key !== 'danhmuc') {
                echo "<p style='color: red;'>" . $value . "</p>";
            }
        }
    }
    unset($_SESSION['msg']);
}



?>
<div class="container mt-5">
    <h2>Danh sách loại sản phẩm</h2>
    <a href="admin.php?act=sanpham" class="btn btn-secondary">Quay về trang sản phẩm</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên loại</th>
                <th>Mô tả</th>
                <!-- <th>Ngày tạo</th> -->
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['ten_danh_muc'] ?></td>
                    <td><?php echo $row['mo_ta'] ?? ""; ?></td>
                    <!-- <td><?php //echo $row['created_at'] ?? ""; ?></td> -->
                    <td>
                        <a href='admin.php?act=editloaisp&id=<?= $row['id'] ?>' class="btn btn-info btn-sm">Xem chi tiết sản phẩm</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                            <input type='submit' name='delete' value='Xóa' class='btn btn-danger btn-sm' onclick='return confirm("Bạn đã chắc chưa ?");'>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="modal" id="successModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bạn đã tạo thành công!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="successModalBody">
                </div>

            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        Tạo loại sản phẩm mới
    </button>
    <div class="modal" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tạo loại sản phẩm mới</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="ten_loai_san_pham">Tên loại:</label>
                            <input type="text" class="form-control" name="ten_loai_san_pham" required>
                        </div>
                        <div class="form-group">
                            <label for="mo_ta">Mô tả :</label>
                            <input type="text" class="form-control" name="mo_ta">
                        </div>
                        <button type="submit" class="btn btn-primary" name="create">Tạo</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng form</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    if (typeof successMessage !== 'undefined') {
        alert(successMessage);
    }
</script>