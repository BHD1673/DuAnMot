<?php

$categories = get_danh_muc();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['category_id']) && isset($_POST['description'])) {
        $name = htmlspecialchars($_POST['name']);
        $category_id = intval($_POST['category_id']);
        $description = htmlspecialchars($_POST['description']);
        $default_price = intval($_POST['default_price']);

        if (empty($name)) {
            $errors[] = "Phải nhập tên";
        }
        if ($category_id <= 0) {
            $errors[] = "Bui lòng nhập vào một danh mục hợp lệ";
        }
        if (empty($description)) {
            $errors[] = "Phải nhập mô tả.";
        }

        if (empty($default_price)) {
            $errors[] = "Phải nhập giá sản phẩm";
        }

        if (empty($errors)) {
            $sql = "INSERT INTO san_pham (ten_san_pham, mo_ta, id_danh_muc, gia_co_ban) VALUES (?, ?, ?, ?)";
            pdo_execute($sql, $name, $description, $category_id, $default_price);
            $_SESSION['msg']['taosanphammoi'] = "Thêm sản phẩm mới thành công";
            header('LOCATION: admin.php?act=sanpham');
            exit();
        }
    } else {
        $errors[] = "Không đucojw bỏ trống";
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
            <label for="default_price" class="form-label">Giá sản phẩm: </label>
            <input type="number" name="default_price" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id"><i class="fas fa-tags"></i> Danh mục sản phẩm:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['ten_danh_muc'] ?></option>
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