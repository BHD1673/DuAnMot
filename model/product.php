<?php
function category()
{
    $sql =  "SELECT * from danh_muc";
    return pdo_query($sql);
}
function seach_product_category($id)
{
    $sql = "SELECT * from san_pham WHERE id_danh_muc = $id";
    return pdo_query($sql);
}
function load_all_products()
{
    $sql = "SELECT * FROM san_pham";
    return pdo_query($sql);
}
function show_product()
{
    $sql = "SELECT sp.id AS product_id, sp.ten_san_pham AS product_name, dm.ten_danh_muc AS category_name, sp.gia_co_ban AS product_price, MAX(spbt.image) AS product_image FROM san_pham sp INNER JOIN danh_muc dm ON sp.id_danh_muc = dm.id LEFT JOIN san_pham_bien_the spbt ON sp.id = spbt.id_san_pham GROUP BY sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban;";
    return pdo_query($sql);
}

//TODO: REFACTOR THIS STUPID CODE
function get_item_by_category_or_name($id, $name)
{
    if (!$id && !$name) {
        // nếu người dùng không chọn gì hết, chạy tất cả sản phẩm
        $sql = "SELECT 
            sp.id AS product_id, 
            sp.ten_san_pham AS product_name, 
            dm.ten_danh_muc AS category_name, 
            sp.gia_co_ban AS product_price, 
            MAX(spbt.image) AS product_image 
        FROM 
            san_pham sp 
        INNER JOIN 
            danh_muc dm ON sp.id_danh_muc = dm.id 
        LEFT JOIN 
            san_pham_bien_the spbt ON sp.id = spbt.id_san_pham 
        GROUP BY 
            sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban";
    } elseif ($id) {
        // nếu người dùng chọn id danh mục sản phẩm, chạy câu truy vấn dưới
        $sql = "SELECT 
            sp.id AS product_id, 
            sp.ten_san_pham AS product_name, 
            dm.ten_danh_muc AS category_name, 
            sp.gia_co_ban AS product_price, 
            MAX(spbt.image) AS product_image 
        FROM 
            san_pham sp 
        INNER JOIN 
            danh_muc dm ON sp.id_danh_muc = dm.id 
        LEFT JOIN 
            san_pham_bien_the spbt ON sp.id = spbt.id_san_pham 
        WHERE 
            dm.id = $id
        GROUP BY 
            sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban";
    } else {
        // nếu người dùng nhập tên sử dụng, chạy câu truy vấn dướis
        $sql = "SELECT 
            sp.id AS product_id, 
            sp.ten_san_pham AS product_name, 
            dm.ten_danh_muc AS category_name, 
            sp.gia_co_ban AS product_price, 
            MAX(spbt.image) AS product_image 
        FROM 
            san_pham sp 
        INNER JOIN 
            danh_muc dm ON sp.id_danh_muc = dm.id 
        LEFT JOIN 
            san_pham_bien_the spbt ON sp.id = spbt.id_san_pham 
        WHERE 
            sp.ten_san_pham LIKE '%$name%'
        GROUP BY 
            sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban";
    }
    
    return pdo_query($sql);
}


function getVariantsForProduct($productId)
{
    $sql = "SELECT st.id, st.ten_bien_the, GROUP_CONCAT(spbt.id, ':', spbt.gia_tri) AS variant_values
                FROM bien_the st
                LEFT JOIN san_pham_bien_the spbt ON spbt.id_bien_the = st.id
                WHERE spbt.id_san_pham = ?
                AND st.ten_bien_the IS NOT NULL
                GROUP BY st.id, st.ten_bien_the";

    $rows = pdo_query($sql, $productId);

    $variants = array();

    foreach ($rows as $row) {
        $variantId = $row["id"];
        $variantName = $row["ten_bien_the"];
        $variantValues = $row["variant_values"];

        $variants[] = array(
            "id" => $variantId,
            "ten_bien_the" => $variantName,
            "variant_values" => $variantValues
        );
    }

    return $variants;
}


function get_product_detail($id)
{
    $sql = "SELECT 
                sp.id AS product_id,
                sp.ten_san_pham AS product_name,
                dm.ten_danh_muc AS category_name,
                sp.gia_co_ban AS product_price,
                sp.mo_ta AS product_description,
                COALESCE(spb.total_quantity, 0) AS total_quantity,
                GROUP_CONCAT(spbt.id, ':', spbt.gia_tri) AS variant_values,
                GROUP_CONCAT(spbt.image) AS product_images
            FROM 
                san_pham sp
            INNER JOIN 
                danh_muc dm ON sp.id_danh_muc = dm.id
            LEFT JOIN (
                SELECT 
                    id_san_pham,
                    SUM(so_luong) AS total_quantity
                FROM 
                    san_pham_bien_the
                GROUP BY 
                    id_san_pham
            ) spb ON sp.id = spb.id_san_pham
            LEFT JOIN san_pham_bien_the spbt ON sp.id = spbt.id_san_pham
            WHERE 
                sp.id = ?
            GROUP BY 
                sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban, sp.mo_ta, spb.total_quantity";

    return pdo_query_one($sql, $id);
}