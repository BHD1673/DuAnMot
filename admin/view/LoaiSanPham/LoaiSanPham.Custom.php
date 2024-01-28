<div class="container mt-5">
    <h2>Cập nhật loại danh muc</h2>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="id_loai_san_pham" value="<?php echo $category_details['id_loai_san_pham']; ?>">
        </div>
        <div class="form-group">
            <label for="new_ten_loai_san_pham">Tên:</label>
            <input type="text" class="form-control" id="new_ten_loai_san_pham" name="new_ten_loai_san_pham" value="<?php echo $category_details['ten_loai_san_pham']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_mo_ta">Mô tả:</label>
            <textarea class="form-control" id="new_mo_ta" name="new_mo_ta"><?php echo $category_details['mo_ta']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
        <a href="admin.php?act=loaisp" class="btn btn-secondary">Quay về trang danh sách danh mục</a>
        <a href="admin.php?act=sanpham" class="btn btn-secondary">Quay về trang danh sách sản phẩm</a>
    </form>
</div>