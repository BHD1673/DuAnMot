<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php include "admin/view/head.php"; ?>
<body>
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
    <div id="main-wrapper" data-sidebartype="full">
        <?php 
        include "admin/view/topbar.php";
        include "admin/view/leftSidebar.php";

        include "admin/view/mainPage.php";

        // if (isset($_GET['act'])) {
        //     $hanhDong = $_GET['act'];
        //     xuLyHanhDong($hanhDong);
        // } else {
        //     hienThiTrangChu();
        // }

        ?>
    </div>
    <?php include "admin/view/hidden.php"; ?>
    <div class="flotTip" style="display: none; position: absolute;"></div>
</body>
</html>