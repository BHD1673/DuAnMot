<?php
function insert_taikhoan($email,$user , $pass) {
    $sql="insert into user(email,fullname,password) values('$email','$user','$pass')";
    pdo_execute($sql);
    
}
?>