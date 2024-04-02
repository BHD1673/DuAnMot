<?php
function insert_taikhoan($email,$user,$pass,$phone){
    $sql="INSERT INTO `nguoi_dung` ( `ho_ten`, `email`, `so_dien_thoai`,`mat_khau`) VALUES ( '$user', '$email','$phone','$pass'); ";
    pdo_execute($sql);
}
function check_taikhoan($email,$phone){
    $sql = "SELECT * FROM `nguoi_dung` WHERE `email` = '$email' or `so_dien_thoai` = '$phone'";
    return pdo_query_one($sql);
}
function check_login($user, $pass) {
    $sql = "SELECT * FROM `nguoi_dung` WHERE `ho_ten` ='$user' and `mat_khau` ='$pass'";
    return pdo_query_one($sql);

}


function profile($id) {
    $sql = "SELECT * FROM nguoi_dung WHERE id = ?";
    return pdo_query_one($sql, $id);
}



?>