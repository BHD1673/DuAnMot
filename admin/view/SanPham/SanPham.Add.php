<?php

$categories = getAllItemCategory();
$brands = getAllBrands();

?>
<div class="container">
  <h1><i class="fas fa-plus"></i> Thêm sản phẩm mới</h1>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group form-group-lg">
        <label for="name"><i class="fas fa-tag"></i> Tên sản phẩm:</label>
        <input type="text" class="form-control form-control-md" id="name" name="name" >
    </div>
    <div class="form-group">
        <label for="category_id"><i class="fas fa-tags"></i> Danh mục sản phẩm:</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id_category'] ?>"><?= $category['ten_danh_muc'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="category_id"><i class="fas fa-tags"></i> Brand:</label>
        <select class="form-control" id="category_id" name="brand_id" required>
            <option value="">Select Category</option>
            <?php foreach ($brands as $brand) : ?>
                <option value="<?= $brand['id_brand'] ?>"><?= $brand['brand_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="retail_price"><i class="fas fa-dollar-sign"></i>Giá bán lẻ:</label>
        <input type="number" class="form-control" id="retail_price" name="retail_price" step="1000" >
    </div>
    <div class="form-group">
        <label for="wholesale_price"><i class="fas fa-dollar-sign"></i> Giá bán sỉ:</label>
        <input type="number" class="form-control" id="wholesale_price" name="wholesale_price"  step="1000">
    </div>
    <div class="form-group">
        <label for="purchase_price"><i class="fas fa-dollar-sign"></i> Giá nhập hàng:</label>
        <input type="number" class="form-control" id="purchase_price" name="purchase_price"  step="1000">
    </div>
    <div class="form-group">
        <label for="quantity"><i class="fas fa-sort-numeric-up"></i> Số lượng hiện có:</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <div class="form-group">
    <label for="description"><i class="fas fa-align-left"></i> Mô tả:</label>
    <div id="editor" style="height: 300px;"></div>
    <textarea id="description" name="description" style="display: none;"></textarea> <!-- Hidden textarea for form submission -->
</div>

    <div class="form-group">
        <label for="image"><i class="fas fa-image"></i> Ảnh:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <hr>
    <h2><i class="fas fa-plus"></i> Thuộc tinh</h2>
    <div id="attributesContainer">
    </div>
    <button type="button" class="btn btn-primary" id="addAttributeBtn"><i class="fas fa-plus"></i> Thêm thuộc tính </button>
    <hr>
    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Tạo sản phẩm mới</button>
  </form>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
$(document).ready(function() {
  var attributeCount = 0;

  // Add attribute input fields dynamically
  $('#addAttributeBtn').click(function() {
    attributeCount++;
    var attributeField = `
      <div class="form-group">
        <label for="attributeName${attributeCount}"><i class="fas fa-tag"></i> Attribute Name</label>
        <input type="text" class="form-control" id="attributeName${attributeCount}" name="attributeName[]" required>
      </div>
      <div class="form-group">
        <label for="attributeValue${attributeCount}"><i class="fas fa-tag"></i> Attribute Value</label>
        <input type="text" class="form-control" id="attributeValue${attributeCount}" name="attributeValue[]" required>
      </div>
    `;
    $('#attributesContainer').append(attributeField);
  });
});
</script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow', // Choose your Quill theme: 'snow' or 'bubble'
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean'],                                         // remove formatting button
                ['link', 'image', 'video']                         // link and image, video
            ]
        },
    });

    // Save the HTML content to the hidden textarea for form submission
    quill.on('text-change', function() {
        var html = quill.root.innerHTML;
        document.getElementById('description').value = html;
    });
</script>
