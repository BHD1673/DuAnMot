<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $brand = viewBrandCustom($id);

    $itemListFollowBrand = viewAllProductFollowBrand($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newBrandName = $_POST['brandName'];
    $newBrandDescription = $_POST['hiddenInputName'];
    $stripBrandDescription = strip_tags($newBrandDescription);

    $brandDescriptionErrors = validateQuill($newBrandDescription);
    $brandNameErrors = validateBrandValue($newBrandName);

    if (!empty($newBrandName) && !empty($stripBrandDescription)) {
        updateBrand($id, $newBrandName, $newBrandDescription,);
        $_SESSION['message']['brandUpdate'] = "Sản phẩm sửa lại thành công";
        header("LOCATION: admin.php?act=brand");
        exit();
    } else {
        $_SESSION['message']['brandUpdate'] = "Có lỗi trong quá trình gửi dữ liệu, xin thông cảm.";
        header("LOCATION: admin.php?act=edit");
        exit();
    }

    // echo "<pre>";
    // var_dump($newBrandName);
    // var_dump($newBrandDescription); 
    // var_dump($brandDescriptionErrors);
    // var_dump($brandNameErrors);
    // echo "</pre>";
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
                        <th>Giá bán lẻ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($itemListFollowBrand as $item) : ?>
                        <tr>
                            <td><?= $item['id_san_pham'] ?></td>
                            <td><?= $item['ten_san_pham'] ?></td>
                            <td><?= $item['mo_ta'] ?></td>
                            <td><?= $item['gia_ban_le'] ?></td>
                            <td>
                                <a href="admin.php?act=chitietsanpham&id=<?= $item['id_san_pham'] ?>" class="btn btn-sm btn-success">Xem chi tiết sản phẩm</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Thông tin Brand</h2>
            <!-- This part I think I should set a js button where I just show it in here
                 But too lazy for that sooooooooooo -->
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
    var contentFromDatabase = <?php echo json_encode($brand['mo_ta_brand']); ?>;

    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        console.log('Text change detected:', quill.root.innerHTML);
        document.getElementById('hiddenInput').value = quill.root.innerHTML;
    });

    quill.clipboard.dangerouslyPasteHTML(contentFromDatabase);
    document.getElementById('hiddenInput').value = contentFromDatabase;

    // Add an event listener for the form's submit event
    document.querySelector('form').addEventListener('submit', function() {
        // Update the value of the hidden input before the form is submitted
        document.getElementById('hiddenInput').value = quill.root.innerHTML;
    });
</script>
