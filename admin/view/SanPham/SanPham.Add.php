<form>
    <div class="container mt-10">
        <div class="row justify-content-between">
        <div class="col-md-8">
            <div class="border p-3">
            <h2>Thêm sản phẩm mới</h2>
                <div class="form-group">
                <label for="itemName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="itemName" placeholder="Đặt tên sản phẩm">
                </div>
                <div class="form-group">
                <label for="itemName">Nhãn hiệu sản phẩm</label>
                <input type="text" class="form-control" id="itemName" placeholder="Đặt tên nhãn hiệu">
                </div>
                <div class="form-group">
                    <label for="itemName">Loại sản phẩm:</label>
                    <select class="form-control" id="itemName">
                        <option value="option1">Lựa chọn 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="form-group">
                <label for="itemDescription">Mô tả sản phẩm</label>
                <div id="editor"></div>
                <input type="hidden" name="itemDescription" id="itemDescription" value="">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border p-3">
            <h2>Thông tin bổ sung</h2>
    
                <div class="form-group">
                    <label for="categoryName">
                        Giá bán lẻ
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua lẻ" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Nhập giá">
                </div>
                <div class="form-group">
                    <label for="categoryName">
                        Giá bán buôn
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua số lượng lớn" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Nhập giá bán buôn">
                </div>
                <div class="form-group">
                    <label for="categoryName">
                        Giá nhập hàng
                        <span data-toggle="tooltip" data-placement="top" title="Giá tự động gợi ý khi bạn tạo đơn nhập hàng từ nhà cung cấp. Bạn có thể thay đổi tùy theo giá nhập hàng thực tế" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Nhập giá nhập hàng vào">
                </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </div>
</form>
<script>
  var quill = new Quill('#editor', {
    theme: 'snow',
    style: 'height: 1000px;',
  });

  // Update the hidden input value when the Quill content changes
  quill.on('text-change', function() {
    document.getElementById('itemDescription').value = quill.root.innerHTML;
  });
</script>
