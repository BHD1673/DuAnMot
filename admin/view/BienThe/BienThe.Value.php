<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_san_pham = $_POST['id_san_pham'];
    $id_bien_the = $_POST['id_bien_the'];
    $gia_tri = $_POST['gia_tri'];
    $so_luong = $_POST['so_luong'];

    // Check if file is uploaded successfully
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        // Specify the directory where you want to save the uploaded file
        $upload_dir = "uploads/";
        // Move the uploaded file to the specified directory
        move_uploaded_file($file_tmp, $upload_dir . $file_name);

        $sql = "INSERT INTO `san_pham_bien_the` (`id_san_pham`, `id_bien_the`, `gia_tri`, `image`, `so_luong`) VALUES (?, ?, ?, ?, ?);";
        pdo_execute($sql, $id_san_pham, $id_bien_the, $gia_tri, $file_name, $so_luong);
        
        header('LOCATION: admin.php?act=sanpham');


    } else {
        echo "Lỗi khi up file.";
    }

}
?>

<form method="post" class="mt-4" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_san_pham">ID Sản phẩm:</label>
        <input type="text" class="form-control" id="id_san_pham" name="id_san_pham" placeholder="<?php echo $_GET['product_id'] ?>" disabled>
        <input type="hidden" class="form-control" id="id_san_pham" name="id_san_pham" value="<?= $_GET['product_id'] ?>">
    </div>
    <div class="form-group">
        <label for="id_bien_the">ID Biến thể:</label>
        <input type="text" class="form-control" id="id_bien_the" name="id_bien_the" placeholder="<?php echo $_GET['id'] ?>" disabled>
        <input type="hidden" class="form-control" id="id_bien_the" name="id_bien_the" value="<?= $_GET['id'] ?>">
    </div>
    <div class="form-group">
        <label for="gia_tri">Gia Tri:</label>
        <input type="text" class="form-control" id="gia_tri" name="gia_tri">
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="so_luong">So Luong:</label>
        <input type="text" class="form-control" id="so_luong" name="so_luong">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
