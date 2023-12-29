<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Xin lỗi, file của bạn quá to";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        echo "Xin lỗi, chỉ file JPG, JPEG, và PNG là được phép";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        echo "Xin lỗi, đã có lỗi khi đăng file lên";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " đã được đăng thành công";
            echo '<br><img src="' . $targetFile . '" alt="Uploaded Image">';
        } else {
            echo "Xin lỗi, đã có vấn đề trục trặc khi tải file của bạn lên";
        }
    }
}
?>
