<?php

$categories = get_category();
// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if all required fields are filled
//     if (isset($_POST['name']) && isset($_POST['category_id']) && isset($_POST['description'])) {
//         // Retrieve form data
//         $name = $_POST['name'];
//         $category_id = $_POST['category_id'];
//         $description = $_POST['description'];
        
//         // Process other form fields like attributes, prices, quantities, and images
//         $attributes = array(); // Array to store attributes
        
//         // Loop through attribute fields
//         if (isset($_POST['attributeName']) && isset($_POST['attributeValue'])) {
//             $attributeNames = $_POST['attributeName'];
//             $attributeValues = $_POST['attributeValue'];
//             $prices = $_POST['price']; // Retrieve prices
//             $quantities = $_POST['quantity']; // Retrieve quantities
//             $numAttributes = count($attributeNames);
            
//             // Iterate through all attributes
//             for ($i = 0; $i < $numAttributes; $i++) {
//                 $attributeName = $attributeNames[$i];
//                 $attributeValue = $attributeValues[$i];
//                 $price = $prices[$i]; // Get corresponding price
//                 $quantity = $quantities[$i]; // Get corresponding quantity
                
//                 // Store attribute in the attributes array
//                 $attributes[] = array(
//                     'name' => $attributeName,
//                     'value' => $attributeValue,
//                     'price' => $price,
//                     'quantity' => $quantity
//                 );
//             }
//         }
        
//         // Handle file upload for images
//         $uploadedFiles = array(); // Array to store uploaded file paths
//         $uploadDir = 'uploads/'; // Directory to store uploaded files

//         foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
//             $file_name = $_FILES['image']['name'][$key];
//             $file_tmp = $_FILES['image']['tmp_name'][$key];
//             $file_type = $_FILES['image']['type'][$key];
            
//             // Check if file type is valid (optional)
//             // You can add more validation here
            
//             $file_path = $uploadDir . $file_name;
            
//             // Move uploaded file to the desired directory
//             if (move_uploaded_file($file_tmp, $file_path)) {
//                 $uploadedFiles[] = $file_path;
//             } else {
//                 // Handle file upload error
//                 echo "Failed to upload file: $file_name";
//             }
//         }
        
//         // Now $uploadedFiles array contains the paths of uploaded files
        
//         // Insert the product into the database or perform other operations
        
//         // Echo out the values
//         echo "Product Name: $name<br>";
//         echo "Category ID: $category_id<br>";
//         echo "Description: .". htmlentities($description) ."<br>";
//         echo "Attributes:<br>";
//         foreach ($attributes as $attribute) {
//             echo "Attribute Name: " . $attribute['name'] . "<br>";
//             echo "Attribute Value: " . $attribute['value'] . "<br>";
//             echo "Price: " . $attribute['price'] . "<br>";
//             echo "Quantity: " . $attribute['quantity'] . "<br>";
//         }
//         echo "Image URLs:<br>";
//         foreach ($uploadedFiles as $file_path) {
//             echo "$file_path<br>";
//         }
        
//         // Redirect to a success page or display a success message
//         // echo "Product added successfully!";
//     } else {
//         // Handle missing required fields
//         echo "Please fill all the required fields.";
//     }
// }.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['category_id'], $_POST['description'], $_POST['attributeName'], $_POST['attributeValue'], $_POST['price'], $_POST['quantity'], $_FILES['image']['tmp_name'])) {

        // Retrieve form data
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $attributeNames = $_POST['attributeName'];
        $attributeValues = $_POST['attributeValue'];
        $prices = $_POST['price'];
        $quantities = $_POST['quantity'];
        $images_tmp = $_FILES['image']['tmp_name'];

        // Insert product into the product table
        $conn = pdo_get_connection();
        $conn->beginTransaction();

        try {
            // Insert product details
            $stmt = $conn->prepare("INSERT INTO product (name, description, category_id) VALUES (:name, :description, :category_id)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();

            // Retrieve the product_id of the newly inserted product
            $product_id = $conn->lastInsertId();

            // Insert product variants
            $stmt = $conn->prepare("INSERT INTO product_variant (product_id, quantity, variant_type, variant_value, price, image) VALUES (:product_id, :quantity, :variant_type, :variant_value, :price, :image)");

            // Insert each variant
            for ($i = 0; $i < count($attributeNames); $i++) {
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':quantity', $quantities[$i]);
                $stmt->bindParam(':variant_type', $attributeNames[$i]);
                $stmt->bindParam(':variant_value', $attributeValues[$i]);
                $stmt->bindParam(':price', $prices[$i]);
                
                // Upload image and get the path
                $uploadDir = 'uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['image']['name'][$i]);
                $file_path = $uploadDir . $fileName;

                if (move_uploaded_file($images_tmp[$i], $file_path)) {
                    // Image uploaded successfully, bind its path to the statement
                    $stmt->bindParam(':image', $file_path);
                } else {
                    throw new Exception("Failed to upload image: " . $_FILES['image']['name'][$i]);
                }

                // Execute the statement
                $stmt->execute();
            }

            // Commit the transaction
            $conn->commit();
            
            echo "Product added successfully!";
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill all the required fields.";
    }
}

?>
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
            <textarea id="description" name="description" style="display: none;"></textarea> <!-- Hidden textarea for form submission -->
        </div>
        <hr>
        <h2><i class="fas fa-plus"></i> Thuộc tinh</h2>
        <div id="attributesContainer">
        </div>
        <button type="button" class="btn btn-primary" id="addAttributeBtn"><i class="fas fa-plus"></i> Thêm thuộc tính </button>        <hr>
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
        var attributeField =
            `
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Giá biến thể :</label>
                    <input type="number" class="form-control" id="price${attributeCount}" name="price[]" step="1000">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="quantity"><i class="fas fa-sort-numeric-up"></i> Số lượng hiện có:</label>
                    <input type="number" class="form-control" id="quantity${attributeCount}" name="quantity[]" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="image${attributeCount}"><i class="fas fa-image"></i> Ảnh:</label>
                    <input type="file" class="form-control" id="image${attributeCount}" name="image[]" multiple>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="attributeName${attributeCount}"><i class="fas fa-tag"></i> Tên biến thể</label>
                    <input type="text" class="form-control" id="attributeName${attributeCount}" name="attributeName[]" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="attributeValue${attributeCount}"><i class="fas fa-tag"></i> Giá trị biến thể</label>
                    <input type="text" class="form-control" id="attributeValue${attributeCount}" name="attributeValue[]" required>
                </div>
            </div>
        </div>
        <hr>
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