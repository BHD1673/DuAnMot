<?php

function validateCreate($ten_loai_san_pham, $mo_ta){
    $errors = [];

    if (empty($ten_loai_san_pham)) {
        $errors[] = "Tên loại sản phẩm không được bỏ trống.";
    }

    if (empty($mo_ta)) {
        $errors[] = "Phần mô tả không được bỏ trống.";
    }

    return $errors;
}

function validateCreateNewItem(
    $itemName,
    $itemBrand,
    $itemCategory,
    $itemSmallSellPrice,
    $itemBigSellPrice,
    $itemBuyPrice
) {
    $errors = [];

    if (empty($itemName) ||
        empty($itemBrand) ||
        empty($itemCategory) ||
        empty($itemSmallSellPrice) ||
        empty($itemBigSellPrice) ||
        empty($itemBuyPrice)
    ) {
        return $errors[] = "Không được bỏ trống các trường này";
    }

    // Tên sản phẩm phải ít nhất 5 ký tự
    if (strlen($itemName) < 5) {
        $errors[] = "Tên sản phẩm phải nhiều hơn 5 ký tự";
    }

    // Loại sản phẩm phải là số, đảm bảo người dùng không can thiệp vào chế độ phát triển
    if (!is_numeric($itemCategory)) {
        $errors[] = "Loại sản phẩm phải có giá trị là số, bạn đang can thiệp không liên quan đến dữ liệu";
    }

    // Giá sản phẩm phải là số, có thể chuyển đổi thành float sau này
    if (!is_numeric($itemSmallSellPrice) || !is_numeric($itemBigSellPrice) || !is_numeric($itemBuyPrice)) {
        $errors[] = "Giá nhập vào phải là số, vui lòng nhập lại";
    }

    // Giá sản phẩm phải lớn hơn hoặc bằng 0
    if ($itemSmallSellPrice < 0 || $itemBigSellPrice < 0 || $itemBuyPrice < 0) {
        $errors[] = "Giá sản phẩm phải là số không âm";
    }

    return $errors;
}

function validateImageFile($file)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];

    $errors = [];

    if ($fileSize == 0) {
        return $errors[] = "File trống.";
    }

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        $errors[] = "Bạn đang đăng không phải là file ảnh, vui lòng chỉ được đăng file theo định dạng sau: " . implode(', ', $allowedExtensions);
    }

    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedMimeTypes)) {
        $errors[] = "Không phải định dạng file ảnh: " . implode(', ', $allowedMimeTypes);
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Lỗi không thể tải ảnh lên: " . $file['error'];
    }

    if (empty($errors)) {
        $destination = 'assets/uploads/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    }

    return $errors;
}

function validateQuill($inputValue)
{
    $errors = [];
    // Bỏ phần HTML ra khỏi biến
    $plainInputValue = strip_tags($inputValue);

    if (empty($plainInputValue)) {
        return $errors[] = "Phần mô tả không được bỏ trống.";
    }

    if (strlen($plainInputValue) < 5) {
        $errors[] = "Phần mô tả phải nhiều hơn 5 ký tự";
    }

    return $errors;
}

function validateBrandValue($inputValue) {
    $errors = [];

    if (empty($inputValue)) {
        return $errors[] = "Không được bỏ trống tên Brand";
    }

    if (strlen($inputValue) < 5) {
        $errors[] = "Tên brand phải nhiều hơn 5 ký tự";
    }

    return $errors;
    
}

function validateForm($variant_type, $desc) {
    $errors = array();

    if (empty($variant_type)) {
        $errors['variant_type'] = "Vui lòng đưa ra một cái tên chính xác hơn";
    }

    if (empty($desc)) {
        $errors['desc'] = "Vui lòng thêm mô tả";
    }

    return $errors;
}