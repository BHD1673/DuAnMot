
<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $variant_name = $_POST['variant_name'];

    $sql = "INSERT INTO bien_the (ten_bien_the) VALUES ('$variant_name')";
    pdo_execute($sql);
    header("Location: admin.php?act=bienthe");

}


?>

<div class="container mt-5">
    <h2 class="mb-4">Thêm biến thể mới</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-3">
                <label class="form-label" for="variant_name">Tên biến thể</label>
                <input type="text" class="form-control" id="variant_name" name="variant_name">
            </div>
            <!-- <div class="form-group col-md-3">
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
            </div> -->
        </div>
        <button type="submit" class="btn btn-primary">Thêm biến thể</button>
        <a href="admin.php?act=bienthe" class="btn btn-secondary">Quay trở lại danh sách biến thể</a>
    </form>
</div>