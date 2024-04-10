<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['quantity'])) {
        // Update quantity of items in the cart
        $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : null;
        $quantityChange = $_POST['quantity'] === '+' ? 1 : ($_POST['quantity'] === '-' ? -1 : 0); // Determine if quantity should be incremented or decremented

        if($itemId !== null && $quantityChange !== 0 && isset($_SESSION['cartValue'][$itemId])) {
            $_SESSION['cartValue'][$itemId]['so_luong'] += $quantityChange;
            // Calculate new total price for the item
            $_SESSION['cartValue'][$itemId]['total_price_with_quantity'] = $_SESSION['cartValue'][$itemId]['so_luong'] * $_SESSION['cartValue'][$itemId]['item_total_price'];
        }
    }
    // JSON string received via POST
    $jsonData = isset($_POST['itemsData']) ? $_POST['itemsData'] : null;

    // Decode JSON string into an associative array
    $data = json_decode($jsonData, true);

    $_SESSION['cartValue'] = $data;
    header("Location: index.php?act=donhang");
}
?>

<div class="container">
    <h1 style="color: red;">Giỏ hàng</h1>
    <form action="" method="POST" id="checkoutForm">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Biến thể</th>
                    <th>Giá trị một sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng giá trị sản phẩm</th>
                    <th>Chọn đơn hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item) : ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['ten_san_pham']; ?></td>
                        <td><?php echo $item['attributes']; ?></td>
                        <td><?php echo $item['item_total_price']; ?></td>
                        <td>
                            <form action="" method="POST">
                                <div class="input-group">
                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                    <button class="btn btn-secondary quantity-input" type="submit" name="quantity" value="-">-</button>
                                    <input type="text" class="form-control" name="quantity" value="<?php echo $item['so_luong']; ?>">
                                    <button class="btn btn-secondary quantity-input" type="submit" name="quantity" value="+">+</button>
                                </div>
                            </form>
                        </td>
                        <td class="total-price"><?php echo $item['total_price_with_quantity']; ?></td>
                        <td><input type="checkbox" name="order_items[]" value="<?php echo $item['id']; ?>"></td> <!-- Add checkbox -->
                        <td>
                            <a href="index.php?act=xoakhoigiohang&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xoá</a>
                            <a href="index.php?act=detailProduct&id=<?php echo $item['id']; ?>" class="btn btn-primary">Về trang chi tiết sản phẩm</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <label for="select-all">Chọn tất cả</label>
        <input type="checkbox" id="select-all" onchange="toggleCheckboxes()">
        <p class="total-cart-value">Tổng giá trị đơn hàng: </p>
        <input type="hidden" id="selectedItemsInput" name="selectedItemsInput">
        <button type="button" class="btn btn-upload btn-success">Thanh toán đơn hàng</button>
    </form>
</div>

<script>
    function toggleCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var selectAllCheckbox = document.getElementById('select-all');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll('input[name="order_items[]"]');
        const totalCartValue = document.querySelector('.total-cart-value');
        const submitButton = document.querySelector('.btn-upload');
        let selectedProducts = [];



        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedProducts.push(checkbox.value);
            }
            checkbox.addEventListener('change', function() {
                const itemId = this.value;
                const isChecked = this.checked;

                if (isChecked) {
                    selectedProducts.push(itemId);
                    console.log('Item with ID ' + itemId + ' is checked.');
                } else {
                    const index = selectedProducts.indexOf(itemId);
                    if (index !== -1) {
                        selectedProducts.splice(index, 1);
                        console.log('Item with ID ' + itemId + ' is unchecked.');
                    }
                }

                updateTotalCartValue();
            });
        });

        function updateTotalCartValue() {
            let totalValue = 0;
            selectedProducts.forEach(function(itemId) {
                const itemRow = document.querySelector('input[name="order_items[]"][value="' + itemId + '"]').closest('tr');
                const itemTotalPrice = parseFloat(itemRow.querySelector('.total-price').textContent);
                totalValue += itemTotalPrice;
            });

            totalCartValue.textContent = 'Tổng giá trị đơn hàng: ' + totalValue.toFixed(2);
            console.log('Total cart value updated to: ' + totalValue.toFixed(2));
        }

        updateTotalCartValue(); // Initial calculation when the page loads

        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (selectedProducts.length === 0) {
                alert('Vui lòng chọn ít nhất một sản phẩm khi bạn muốn thanh toán sản phẩm');
                return; // Prevent form submission if no item is selected
            }
            submitForm();
        });

        function submitForm() {
            const formData = new FormData();
            const itemsData = [];
            const allItems = document.querySelectorAll('input[name="order_items[]"]');

            allItems.forEach(function(item) {
                const itemId = item.value;
                const itemRow = item.closest('tr');
                const itemName = itemRow.querySelector('td:nth-child(2)').textContent;
                const itemVariant = itemRow.querySelector('td:nth-child(3)').textContent;
                const itemPrice = itemRow.querySelector('td:nth-child(4)').textContent;
                const itemQuantity = itemRow.querySelector('input[name="quantity"]').value;
                const itemTotalPrice = itemRow.querySelector('.total-price').textContent;

                itemsData.push({
                    itemId: itemId,
                    itemName: itemName,
                    itemVariant: itemVariant,
                    itemPrice: itemPrice,
                    itemQuantity: itemQuantity,
                    itemTotalPrice: itemTotalPrice
                });
            });

            formData.append('itemsData', JSON.stringify(itemsData));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?act=cart', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        // Redirect to index.php?act=donhang after successful form submission
                        window.location.href = 'index.php?act=donhang';
                    } else {
                        console.error('Error occurred during form submission.');
                    }
                }
            };
            xhr.send(formData);
        }
    });
</script>