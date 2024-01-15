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

function viewCategoryOne() {
    $sql = "SELECT * FROM loaisanpham WHERE id_loai_san_pham = '?'";
    return pdo_query_one($sql);
}

function updateCategory($categoryName, $categoryDescription) {
    $sql = "UPDATE `loaisanpham` SET `ten_loai_san_pham`='?',`mo_ta`='?' WHERE id_loai_san_pham = '?'";
    return pdo_execute($sql, $categoryName, $categoryDescription);
}

function deleteCategory($categoryID) {
    $sql = "DELETE FROM `loaisanpham` WHERE id_loai_san_pham = '?'";
    return pdo_execute($sql, $categoryID);
}


?>