<?php 
function register_user($email, $password, $dob, $sex, $profile_image_path) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password, dob, sex, profile_image) 
            VALUES (?, ?, ?, ?, ?)";

    pdo_execute($sql, $email, $hashed_password, $dob, $sex, $profile_image_path);
}

function login($username, $password) {
    $sql = "SELECT * FROM taikhoan WHERE Email = ? AND Password = ?";
    return pdo_query($sql, $username, $password);
}

function forgotPassword($username) {
    
}

?>