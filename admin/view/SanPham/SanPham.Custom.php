<?php 
$categories = get_category();

$productValue = get_product($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "UPDATE product SET name = ?, category_id = ?, description = ? WHERE id = ?";
    pdo_execute($sql, $_POST['name'], $_POST['category_id'], $_POST['description'], $_GET['id']);
    header("Location: admin.php?act=sanpham");
}
?>
<div class="container">
<form method="POST" enctype="multipart/form-data">
    <h1><i class="fas fa-edit"></i> Cập nhật sản phẩm</h1>
    <div class="row">
        <div class="col">
            <a href="admin.php?act=danhmucbienthe&id=<?= $_GET['id'] ?>" class="btn btn-primary">Xem biến thể của sản phẩm</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Cập nhật</button>
            <a href="admin.php?act=sanpham" class="btn btn-secondary"><i class="fas fa-times"></i> Quay về trang danh sách</a>
        </div>
    </div>

        <div class="form-group">
            <label for="name"><i class="fas fa-tag"></i> Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $productValue['name'] ?>">
        </div>
        <div class="form-group">
            <label for="category_id"><i class="fas fa-tags"></i> Danh mục sản phẩm:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Chọn danh mục</option>
                <?php foreach ($categories as $category) : ?>
                    <?php $selected = ($category['id'] == $productValue['category_id']) ? 'selected' : ''; ?>
                    <option value="<?= $category['id'] ?>" <?= $selected ?>><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description"><i class="fas fa-align-left"></i> Mô tả:</label>
            <div id="editor" style="height: 300px;"></div>
            <textarea id="description" name="description" style="display: none;"></textarea>
        </div>



    </form>
</div>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Quill.js -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


<script>
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link', 'image', 'video']
            ]
        },
    });

    // Set the initial content of Quill editor to the value of the description
    var descriptionValue = <?= json_encode($productValue['description']) ?>;
    quill.root.innerHTML = descriptionValue;

    // Save the HTML content to the hidden textarea for form submission
    quill.on('text-change', function () {
        var html = quill.root.innerHTML;
        document.getElementById('description').value = html;
    });
</script>