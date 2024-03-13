<?php 

$array = get_variant($_GET['id']);

?>

<div class="container mt-5">
    <h2>Product Variants</h2>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Variant Type</th>
            <th>Variant Value</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array as $item) : ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['product_id']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['variant_type']; ?></td>
                <td><?php echo $item['variant_value']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td>
                    <img src="<?php echo $item['image']; ?>" alt="Product Image" style="width: 100px;">
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="admin.php?act=xoabienthe&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xoá</a>
                        <a href="admin.php?act=suabienthe&id=<?php echo $item['id']; ?>" class="btn btn-warning">Sửa</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

  </div>
