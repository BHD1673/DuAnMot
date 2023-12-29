<form method="post" enctype="multipart/form-data">
    <div class="container mt-10">
        <div class="row justify-content-between">
        <div class="col-md-8">
            <div class="border p-3">
                <h2>Thêm sản phẩm mới</h2>
                <a href="admin.php?act=sanpham">Xem danh sách sản phẩm</a>
                <div class="form-group">
                    <label for="itemName">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Đặt tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="itemBrand">Nhãn hiệu sản phẩm</label>
                    <input type="text" class="form-control" id="itemBrand" name="itemBrand" placeholder="Đặt tên nhãn hiệu">
                </div>
                <div class="form-group">
                    <label for="colorPicker">Chọn màu sắc:</label>
                    <div id="colorOptions">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="redCheckbox" value="red">
                            <label class="form-check-label" for="redCheckbox">Đỏ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="orangeCheckbox" value="orange">
                            <label class="form-check-label" for="orangeCheckbox">Cam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="yellowCheckbox" value="yellow">
                            <label class="form-check-label" for="yellowCheckbox">Vàng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="greenCheckbox" value="green">
                            <label class="form-check-label" for="greenCheckbox">Lục</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="blueCheckbox" value="blue">
                            <label class="form-check-label" for="blueCheckbox">Xanh</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="indigoCheckbox" value="indigo">
                            <label class="form-check-label" for="indigoCheckbox">Chàm</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="violetCheckbox" value="violet">
                            <label class="form-check-label" for="violetCheckbox">Tím</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="selectedColors[]" id="rgbCheckBox" value="rgb">
                            <label class="form-check-label" for="rgbCheckBox">RGB</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectedColors">Màu sắc đã chọn:</label>
                    <div id="selectedColors"></div>
                </div>
                <div class="form-group">
                    <label for="itemType">Loại sản phẩm:</label>
                    <select class="form-control" id="itemType" name="itemType">
                        <option >==Vui lòng chọn==</option>
                        <option value="card">Card đồ họa</option>
                        <option value="mouse">Chuột máy tính </option>
                        <!-- Tạo vòng lặp foreach ở đây để fetch thông tin ra  -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="itemDescription">Mô tả sản phẩm</label>
                    <div id="editor"></div>
                    <input type="hidden" name="itemDescription" id="itemDescription" value="">
                </div>
                <div class="form-group">
                    <label for="itemImage">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" id="itemImage" name="itemImage" accept="image/*" onchange="previewImage(event)">
                </div>
                
                <img id="image-preview" src="#" alt="Image Preview" style="display:none">
            </div>
        </div>
        <div class="col-md-4">
            <div class="border p-3">
            <h2>Thông tin bổ sung</h2>
                <div class="form-group">
                    <label for="itemSmallSellPrice">
                        Giá bán lẻ
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua lẻ" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemSmallSellPrice" name="itemSmallSellPrice" placeholder="Nhập giá">
                </div>
                <div class="form-group">
                    <label for="itemBigSellPrice">
                        Giá bán buôn
                        <span data-toggle="tooltip" data-placement="top" title="Giá bán cho khách hàng mua số lượng lớn" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemBigSellPrice" name="itemBigSellPrice" placeholder="Nhập giá bán buôn">
                </div>
                <div class="form-group">
                    <label for="itemBuyPrice">
                        Giá nhập hàng
                        <span data-toggle="tooltip" data-placement="top" title="Giá tự động gợi ý khi bạn tạo đơn nhập hàng từ nhà cung cấp. Bạn có thể thay đổi tùy theo giá nhập hàng thực tế" data-delay="100">
                            <strong style="cursor: help;">!</strong>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="itemBuyPrice" name="itemBuyPrice" placeholder="Nhập giá nhập hàng vào">
                </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </div>
</form>
