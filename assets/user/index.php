<?php
session_start();
include "model/login.php";
include "view/header.php";
    if(isset($_GET['act'])&&($_GET['act']!="")){
        $act=$_GET['act'];
        switch($act){
            case "sanpham":
                include "view/allsp.php";
                break;
            case "dangky":
                    if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        $user = $_POST['user'];
                        insert_taikhoan($email, $user, $pass);
                    }
                    include "view/user/singin.php";
                    break;
                    

            }
    }else{
        include "view/home.php";
    }

include "view/footer.php";
?>