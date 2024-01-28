<?php 

//////////////////////////////////////////////////////////////
// Category
/////////////////////////////////////////////////////////////
function insertCategory($categoryName, $categoryDescription) {
    $sql = "INSERT INTO loaisanpham (ten_loai_san_pham, mo_ta) VALUES (?, ?)";    
    return pdo_execute($sql, $categoryName, $categoryDescription);
}

function viewCategory() {
    $sql = "SELECT * FROM loaisanpham";
    return pdo_query($sql);
}

function viewCategoryOne($id) {
    $sql = "SELECT * FROM loaisanpham WHERE id_loai_san_pham = ?";
    return pdo_query_one($sql, $id);
}

function updateCategory($id, $newData) {
    $setClause = implode(', ', array_map(function($column) {
        return "$column = ?";
    }, array_keys($newData)));

    $sql = "UPDATE loaisanpham SET $setClause WHERE id_loai_san_pham = ?";
    $params = array_merge(array_values($newData), [$id]);

    pdo_execute($sql, ...$params);
}
function deleteCategory($categoryID) {
    $sql = "DELETE FROM `loaisanpham` WHERE id_loai_san_pham = ?";
    return pdo_execute($sql, $categoryID);
}

//////////////////////////////////////////////////////////////
// Item
/////////////////////////////////////////////////////////////

function insertItem($itemName, $itemBrand, $itemCategory, $itemSmallSellPrice, $itemBigSellPrice) {
    $sql = "INSERT INTO `sanpham`(
        `ten_san_pham`,
        `gia_ban_le`,
        `gia_ban_buon`,
        `gia_nhap_hang`,
        `so_luong`,
        `mo_ta`,
        `id_loai_san_pham`,
        `id_brand`,
        `nam_san_xuat`,
        `ngay_tao`,
        `ngay_cap_nhat`
    )
    VALUES(
        '[value-2]',
        '[value-3]',
        '[value-4]',
        '[value-5]',
        '[value-6]',
        '[value-7]',
        '[value-8]',
        '[value-9]',
        '[value-10]',
        '[value-11]',
        '[value-12]',
        '[value-13]'
    )";
    return pdo_execute($sql, $itemName, $itemBrand, $itemCategory, $itemSmallSellPrice, $itemBigSellPrice);
    
}

?>