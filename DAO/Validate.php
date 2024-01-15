<?php 
// function validateFormCategoryAdd($categoryName, $categoryDescription) {
//     $errors = [];

//     // Validate Category Name
//     if (empty($categoryName)) {
//         $errors[] = "Tên danh mục không được bỏ trống.";
//     } elseif (strlen($categoryName) > 1) {
//         $errors[] = "Tên danh mục không được quá dài 225 kí tự.";
//     }

//     // Validate Category Description
//     if (empty($categoryDescription)) {
//         $errors[] = "Chi tiết danh mục không được bỏ thiếu.";
//     } elseif (strlen($categoryDescription) > 1000) {
//         $errors[] = "Chi tiết danh mục không được dài quá 1000 kí tự.";
//     }

//     return $errors;
// }

// function validateFormCategoryUpdate($categoryName, $categoryDescription) {
//     $errors = [];

//     // Validate Category Name
//     if (empty($categoryName)) {
//         $errors[] = "Tên danh mục không được bỏ trống.";
//     } elseif (strlen($categoryName) > 1) {
//         $errors[] = "Tên danh mục không được quá dài 225 kí tự.";
//     }

//     // Validate Category Description
//     if (empty($categoryDescription)) {
//         $errors[] = "Chi tiết danh mục không được bỏ thiếu.";
//     } elseif (strlen($categoryDescription) > 1) {
//         $errors[] = "Chi tiết danh mục không được dài quá 1000 kí tự.";
//     }

//     return $errors;
// }

function validateCreate($ten_loai_san_pham, $mo_ta) {
    $errors = [];

    // Validate the ten_loai_san_pham fields
    if (empty($ten_loai_san_pham)) {
        $errors[] = "Tên loại sản phẩm không được bỏ trống.";
    }

    // Validate the mo_ta fields
    if (empty($mo_ta)) {
        $errors[] = "Phần mô tả không được bỏ trống.";
    }

    return $errors;
}




// Function to display success message in Bootstrap modal
function displaySuccessModal($message, $timeout) {
    ?>
    <script>
        $(document).ready(function() {
            $("#successModalBody").html("<p><?= $message ?></p>");
            $("#successModal").modal("show");
            setTimeout(function() {
                $("#successModal").modal("hide");
            }, <?= $timeout ?>);
        });
    </script>
    <?php
}

?>