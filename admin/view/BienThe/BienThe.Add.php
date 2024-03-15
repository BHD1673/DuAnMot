<div class="container mt-5">
    <h2 class="mb-4">Thêm biến thể mới</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-10">
                <label class="form-label" for="product_id">ID sản phẩm</label>
                <input type="text" class="form-control" value="<?php echo $_GET['id']; ?>" disabled>
                <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
            </div>
            <div class="form-group col-md-10">
                <label class="form-label" for="product_id">ID Biến thể</label>
                <input type="text" class="form-control" value="<?php echo $_GET['id']; ?>" disabled>
                <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="variant_value">Giá Trị Biến Thể</label>
                <input type="text" class="form-control" id="variant_value" name="variant_value">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="quantity">Số Lượng</label>
                <input type="text" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="price">Giá</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="image">Hình Ảnh</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Dữ Liệu</button>
    </form>
</div>