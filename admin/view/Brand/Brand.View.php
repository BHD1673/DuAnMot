<?php

echo $_SESSION['message']['brandUpdate'] ?? "";
echo $_SESSION['message']['insertBrand'] ?? "";
$_SESSION['message']['brandUpdate'] = "";
$_SESSION['message']['insertBrand'] = "";

?>
<div class="container mt-4">
    <h1>Danh sách các Brand</h1>
    <a href="admin.php?act=loaisp"><button class="btn btn-primary">Sang loại sản phẩm</button></a>
    <a href="admin.php?act=sanpham"><button class="btn btn-primary">Sang danh sách sản phẩm</button></a>
    <a href="admin.php?act=taobrand"><button class="btn btn-primary">Tạo loại brand mới</button></a>
    <table id="brandTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên brand</th>
                <th>Mô tả nhanh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($brandInfor as $brand) {
                $brandId = $brand['id_brand'];
                $brandName = $brand['ten_brand'];
                $brandDesc = $brand['mo_ta_brand'];
                ?>
                <tr>
                    <td><?php echo $brandId; ?></td>
                    <td><?php echo $brandName; ?></td>
                    <td><?php echo $brandDesc; ?></td>
                    <td>
                        <a href="admin.php?act=editbrand&id=<?php echo $brandId; ?>" class="btn btn-sm btn-primary">Chính sửa</a>
                        <a href="admin.php?act=deletebrand&id=<?php echo $brandId; ?>" class="btn btn-sm btn-danger">Xoá</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>