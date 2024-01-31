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
//////////////////////////////////////////////////////////////

function getAllProducts() {
    // $sql = "SELECT
    // sp.id_san_pham,
    // sp.ten_san_pham,
    // sp.gia_ban_le,
    // sp.gia_ban_buon,
    // sp.gia_nhap_hang,
    // sp.so_luong,
    // lsp.ten_loai_san_pham,
    // b.ten_brand,
    // sp.ngay_tao,
    // sp.ngay_cap_nhat
    // FROM
    //     sanpham sp
    // JOIN
    //     loaisanpham lsp ON sp.id_loai_san_pham = lsp.id_loai_san_pham
    // JOIN
    //     brand b ON sp.id_brand = b.id_brand;    
    //     ";

    $sql = "SELECT * FROM sanpham";
    return pdo_query($sql);
}

// function insertItem($itemName, $itemBrand, $itemCategory, $itemSmallSellPrice, $itemBigSellPrice) {
//     $sql = "INSERT INTO `sanpham`(
//         `ten_san_pham`,
//         `gia_ban_le`,
//         `gia_ban_buon`,
//         `gia_nhap_hang`,
//         `so_luong`,
//         `mo_ta`,
//         `id_loai_san_pham`,
//         `id_brand`,
//         `nam_san_xuat`,
//         `ngay_tao`,
//         `ngay_cap_nhat`
//     )
//     VALUES(
//         '[value-2]',
//         '[value-3]',
//         '[value-4]',
//         '[value-5]',
//         '[value-6]',
//         '[value-7]',
//         '[value-8]',
//         '[value-9]',
//         '[value-10]',
//         '[value-11]',
//         '[value-12]',
//         '[value-13]'
//     )";
//     return pdo_execute($sql, $itemName, $itemBrand, $itemCategory, $itemSmallSellPrice, $itemBigSellPrice);
    
// }

//////////////////////////////////////////////////////////////
// Brand
//////////////////////////////////////////////////////////////
function viewAllProductFollowBrand($id) {
    $sql = "SELECT
    `id_san_pham`,
    `ten_san_pham`,
    `mo_ta`,
    `gia_ban_le`
FROM
    `sanpham`
WHERE
    `id_brand` = ?";

    return pdo_query($sql, $id);
}

function insertBrand($brandName, $brandDescription) {
    $sql = "INSERT INTO `brand`(`ten_brand`, `mo_ta_brand`) VALUES (?, ?)";
    return pdo_execute($sql, $brandName, $brandDescription);
}

function viewBrand() {
    $sql = "SELECT * FROM `brand`";
    return pdo_query($sql);
}

function viewBrandCustom($id) {
    $sql = "SELECT * FROM `brand` WHERE id_brand = ?";
    return pdo_query_one($sql, $id);
}

function updateBrand($id, $newBrandName, $newBrandDescription) {
    $sql = "UPDATE `brand` SET `ten_brand` = ?, `mo_ta_brand` = ? WHERE `id_brand` = ?";
    return pdo_execute($sql, $newBrandName, $newBrandDescription, $id);
}

function deleteBrand($id) {
    $sql = "DELETE FROM `brand` WHERE `id_brand` = ?";
    return pdo_execute($sql, $id);
}