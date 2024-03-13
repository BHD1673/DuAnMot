<?php 

$imagePath = "assests/upload/";
$upload_dir = "assets/upload/";


function uploadImage($imageFile) {
    // Kiểm tra nếu không có file được upload
    if(!isset($imageFile['tmp_name']) || empty($imageFile['tmp_name'])) {
        return "Không tìm thấy file.";
    }

    // Kiểm tra lỗi khi upload file
    if($imageFile['error'] !== UPLOAD_ERR_OK) {
        return "Lỗi khi upload file: " . $imageFile['error'];
    }

    // Thực hiện xử lý upload file
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($imageFile['name']);

    // Kiểm tra định dạng hình ảnh
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return "Chỉ cho phép upload các file JPG, JPEG, PNG và GIF.";
    }

    // Kiểm tra kích thước file
    if($imageFile['size'] > 500000) {
        return "File quá lớn, chỉ cho phép upload file nhỏ hơn 500KB.";
    }

    // Di chuyển file vào thư mục upload
    if(move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
        // Trả về tên file để lưu vào cơ sở dữ liệu
        return basename($imageFile['name']);
    } else {
        return "Có lỗi khi upload file.";
    }
}

?>