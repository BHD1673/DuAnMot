<div class="container mt-4">
    <table id="brandTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
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
                        <a href="admin.php?act=editbrand&id=<?php echo $brandId; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="admin.php?act=deletebrand&id=<?php echo $brandId; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>