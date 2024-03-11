-- Tăng số lượng sản phẩm trong bảng product
UPDATE product
SET quantity = quantity + 1
WHERE id = [ID của sản phẩm cần tăng số lượng];

-- Giảm số lượng sản phẩm trong bảng product
UPDATE product
SET quantity = quantity - 1
WHERE id = [ID của sản phẩm cần giảm số lượng];

