<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $variant_type = $_POST["variant_type"];
    $desc = $_POST["desc"];

    $errors = validateForm($variant_type, $desc);

    if (empty($errors)) {
        add_product_variant_category($_GET['id'], $variant_type, $desc);
        $_SESSION['msg']['danhmucbienthe'] = "Thêm danh mục biến thể thành công";
        header('LOCATION: admin.php?act=danhmucbienthe&id=' . $_GET['id']);
        exit();
    }
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
}

?>
<form method="POST" class="needs-validation" novalidate>
  <div class="form-group">
    <label for="product_id">Product ID:</label>
    <input type="text" class="form-control" id="product_id" name="product_id" value="<?= $_GET['id'] ?>" disabled>
    <input type="hidden" name="product_id" value="<?= $_GET['id'] ?>">
    <div class="invalid-feedback">
     Vui lòng kiểm tra lại
    </div>
  </div>
  <div class="form-group">
    <label for="variant_type">Loại biến thể:</label>
    <input type="text" class="form-control" id="variant_type" name="variant_type" required>
    <div class="invalid-feedback">
      Vui lòng đưa ra một cái tên chính xác hơn
    </div>
  </div>
  <div class="form-group">
    <label for="desc">Mô tả:</label>
    <input type="text" class="form-control" id="desc" name="desc" required>
    <div class="invalid-feedback">
      Vui lòng thêm mô tả
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
