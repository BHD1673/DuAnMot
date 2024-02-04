<?php
$categorySelect = viewCategory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $createErrors = validateCreate($_POST['ten_loai_san_pham'], $_POST['mo_ta']);
    $createNewItemErrors = validateCreateNewItem(
        $_POST['itemName'],
        $_POST['itemBrand'],
        $_POST['itemCategory'],
        $_POST['itemSmallSellPrice'],
        $_POST['itemBigSellPrice'],
        $_POST['itemBuyPrice']
    );
    $imageFileErrors = validateImageFile($_FILES['itemImage']);
    $quillErrors = validateQuill($_POST['quill_content']);

    // echo '<pre>';
    // var_dump($createNewItemErrors);
    // var_dump($quillErrors);
    // var_dump($imageFileErrors);
    // echo '</pre>';

    if (!empty($createNewItemErrors) && !empty($quillErrors) && !empty($imageFileErrors)) {
        insertItem(
            $_POST['itemName'],
            $_POST['itemBrand'],
            $_POST['itemCategory'],
            $_POST['itemSmallSellPrice'],
            $_POST['itemBigSellPrice'],
            $_POST['itemBuyPrice']
        );

        $_SESSION['message']['createNewItem'] = "Bạn đã tạo mới sản phẩm thành công";
        header("LOCATION: admin.php?act=sanpham");
        exit();
    }
}


?>

<form method="post" enctype="multipart/form-data">
    <div class="container mt-10">
        <div class="row justify-content-between">
        <div class="col-md-8">
            <div class="border p-3">
                <h2>Thêm sản phẩm mới</h2>
                <a href="admin.php?act=sanpham" class="btn btn-primary">Xem danh sách sản phẩm</a>
                <div class="form-group">
                    <label for="itemName">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Đặt tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="itemBrand">Nhãn hiệu sản phẩm</label>
                    <input type="text" class="form-control" id="itemBrand" name="itemBrand" placeholder="Đặt tên nhãn hiệu">
                </div>
                <div class="form-group">
                    <label for="itemCategory">Loại sản phẩm:</label>
                    <select class="form-control" id="itemCategory" name="itemCategory">
                        <option value="#">-- Chọn loại --</option>
                        <?php
                        foreach ($categorySelect as $category) :
                            $categoryId = $category['id_loai_san_pham'];
                            $categoryName = $category['ten_loai_san_pham'];
                        ?>
                            <option value="<?= $categoryId ?>"><?= $categoryName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editor">Mô tả sản phẩm</label>
                    <div id="editor" style="height: 200px;"></div>
                    <input type="hidden" name="quill_content" id="quill_content" />
                </div>
                <div class="form-group">
                    <label for="itemImage">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" id="itemImage" name="itemImage" accept="image/*" onchange="previewImage(event)">
                </div>
                
                <img id="image-preview" src="#" alt="Image Preview" style="display:none">
            </div>
        </div>
        <div class="col-md-4">
            <div class="border p-3">
            <h2>Thông tin bổ sung</h2>
                <div class="form-group">
                    <label for="itemSmallSellPrice">
                        Giá bán lẻ
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua lẻ" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemSmallSellPrice" name="itemSmallSellPrice" placeholder="Nhập giá">
                </div>
                <div class="form-group">
                    <label for="itemBigSellPrice">
                        Giá bán buôn
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua số lượng lớn" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemBigSellPrice" name="itemBigSellPrice" placeholder="Nhập giá bán buôn">
                </div>
                <div class="form-group">
                    <label for="itemBuyPrice">
                        Giá nhập hàng
                        <span data-toggle="tooltip" data-placement="top" title="Giá tự động gợi ý khi bạn tạo đơn nhập hàng từ nhà cung cấp. Bạn có thể thay đổi tùy theo giá nhập hàng thực tế" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemBuyPrice" name="itemBuyPrice" placeholder="Nhập giá nhập hàng vào">
                </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </div>
</form>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
    });

    // Add an event listener to capture changes in the Quill editor
    quill.on('text-change', function() {
        // Get the HTML content from the Quill editor
        var quillContent = quill.root.innerHTML;

        // Log the content to the console
        console.log('Quill Content:', quillContent);

        // Update the hidden input field with the Quill content
        document.getElementById('quill_content').value = quillContent;
    });
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
