<?php 

$array = [
  "some value" => "some other value"
]



?>
<div class="container">
  <h2>Sản phẩm thuộc danh mục</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Giá trị biến thể</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Hình ảnh sản phẩm</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($array as $value): ?>
      <tr>
        <td></td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td><img class="img-thumbnail" src="https://via.placeholder.com/640x480.png/00ffee?text=lovesosa" alt="Image 1"></td>
        <td id="status">1</td>
        <td>
            <a href="admin.php?act=chitietbienthe" class="btn btn-success">Xem chi tiết biến thể</a>
            <a href="admin.php?act=xoabienthe" class="btn btn-warning">Xoá biến thể</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td>29</td>
        <td>2</td>
        <td>2</td>
        <td>2</td>
        <td><img class="img-thumbnail"  src="https://via.placeholder.com/640x480.png/00ffee?text=lovesosa" alt="Image 2"></td>
        <td id="status">2</td>
        <td>
            <a href="admin.php?act=chitietbienthe" class="btn btn-success">Xem chi tiết biến thể</a>
            <a href="admin.php?act=xoabienthe" class="btn btn-warning">Xoá biến thể</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<script>
// Function to display status based on class
function displayStatus() {
  var statuses = document.querySelectorAll("#status");
  console.log(statuses);

  for (var i = 0; i < statuses.length; i++) {
    var status = statuses[i];
    var statusValue = status.innerHTML;

    if (statusValue === "1") {
      status.innerHTML = "Pending";
    } else if (statusValue === "2") {
      status.innerHTML = "Success";
    }
  }
}

// Call the function to display status
displayStatus();
</script>