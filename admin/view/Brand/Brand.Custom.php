<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $brand = viewBrandCustom($id);
}


?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2>Danh mục sản phẩm theo brand</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả ngắn gọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Tên sản phẩm</td>
                        <td>Có thể để phần này limit kí tự</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Thông tin Brand</h2>
            <form method="post">
                <div class="form-group">
                    <label for="id_brand">Brand ID:</label>
                    <input type="disable" class="form-control" id="disabledInput" name="brandName" value="<?php echo $brand['id_brand']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="brandName">Tên Brand:</label>
                    <input type="text" class="form-control" id="brandName" name="brandName" value="<?php echo $brand['ten_brand']; ?>">
                </div>
                <div class="form-group">
                    <label for="brandDescription">Mô tả :</label>
                    <div id="editor" style="height: 200px;"></div>
                    <input type="hidden" id="hiddenInput" name="hiddenInputName" value="">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
  // Use PHP echo to insert the content into the JavaScript code
  var contentFromDatabase = <?php echo json_encode($brand['mo_ta_brand']); ?>;

  var quill = new Quill('#editor', {
    theme: 'snow'
  });

  // Set the initial value of the Quill editor
  quill.clipboard.dangerouslyPasteHTML(contentFromDatabase);
  document.getElementById('hiddenInput').value = contentFromDatabase;
</script>