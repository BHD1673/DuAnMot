<body>
<div class="container mt-5">
    <h2>Danh sách loại sản phẩm</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên loại</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= $row['id_loai_san_pham'] ?></td>
                    <td><?= $row['ten_loai_san_pham'] ?></td>
                    <td><?= $row['mo_ta'] ?></td>
                    <td>
                        <a href='admin.php?act=editloaisp&id=<?= $row['id_loai_san_pham'] ?>' class="btn btn-info btn-sm">Cập nhật</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='id_loai_san_pham' value='<?= $row['id_loai_san_pham'] ?>'>
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