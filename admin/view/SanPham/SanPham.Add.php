<?php

$categories = get_category();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['category_id']) && isset($_POST['description'])) {
        $name = htmlspecialchars($_POST['name']);
        $category_id = intval($_POST['category_id']);
        $description = htmlspecialchars($_POST['description']);

        if (empty($name)) {
            $errors[] = "Name is required.";
        }
        if ($category_id <= 0) {
            $errors[] = "Please select a valid category.";
        }
        if (empty($description)) {
            $errors[] = "Description is required.";
        }

        if (empty($errors)) {
            $sql = "INSERT INTO product (name, category_id, description) VALUES (?, ?, ?)";
            pdo_execute($sql, $name, $category_id, $description);
            $_SESSION['msg']['taosanphammoi'] = "Thêm sản phẩm mới thành công";
            header('LOCATION: admin.php?act=sanpham');
            exit();
        }
    } else {
        $errors[] = "All fields are required.";
    }
}
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
    <h1><i class="fas fa-plus"></i> Thêm sản phẩm mới</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group form-group-lg">
            <label for="name"><i class="fas fa-tag"></i> Tên sản phẩm:</label>
            <input type="text" class="form-control form-control-md" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="category_id"><i class="fas fa-tags"></i> Danh mục sản phẩm:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description"><i class="fas fa-align-left"></i> Mô tả:</label>
            <div id="editor" style="height: 300px;"></div>
            <textarea id="description" name="description" style="display: none;"></textarea>
        </div>
        <hr>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Tạo sản phẩm mới</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>





<script>
    var quill = new Quill('#editor', {
        theme: 'snow', // Choose your Quill theme: 'snow' or 'bubble'
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

                ['clean'], // remove formatting button
                ['link', 'image', 'video'] // link and image, video
            ]
        },
    });

    // Save the HTML content to the hidden textarea for form submission
    quill.on('text-change', function() {
        var html = quill.root.innerHTML;
        document.getElementById('description').value = html;
    });
</script>