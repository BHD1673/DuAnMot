<?php
$sql = "DELETE FROM gio_hang WHERE id_nguoi_dung = " . $_SESSION['user']['id'];
pdo_execute($sql);

unset($_SESSION['cartValue']);
?>
<div class="container">
    <div class="row">
        <img src="img/thanhtoanthanhcong.png" alt="" >
        <p class="text-center">Đặt hàng thành công</p>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        window.location.href = "index.php?act=lichsudonhang";
    }, 5000); // 5000 milliseconds = 5 seconds
});
</script>