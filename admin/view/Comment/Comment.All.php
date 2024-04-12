<?php 

$commentValue = get_all_comments();

?>

<div class="container mt-5">
    <h2>Quản lý comment</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Người Comment</th>
          <th>Tên Sản Phẩm</th>
          <th>Nội dung</th>
          <th>Thời gian tạo</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($commentValue as $item): ?>
          <tr>
            <td><?php echo $item['nguoi_comment']; ?></td>
            <td><?php echo $item['ten_san_pham']; ?></td>
            <td><?php echo $item['comment']; ?></td>
            <td><?php echo $item['created_at']; ?></td>
            <td><a href="admin.php?act=xoacomment&id=<?php echo $item['comment_id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa comment này?')">Xoá comment</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
