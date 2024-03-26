<?php
    function category(){
        $sql =  "SELECT * from danh_muc";
        return pdo_query($sql);
    }
    function seach_product_category($id){
        $sql = "SELECT * from san_pham WHERE id_danh_muc = $id";
        return pdo_query($sql);
    }
    function load_all_products(){
        $sql = "SELECT * FROM san_pham";
        return pdo_query($sql);
    }
    function show_product(){
        $sql = "SELECT sp.id AS product_id, sp.ten_san_pham AS product_name, dm.ten_danh_muc AS category_name, sp.gia_co_ban AS product_price, MAX(spbt.image) AS product_image FROM san_pham sp INNER JOIN danh_muc dm ON sp.id_danh_muc = dm.id LEFT JOIN san_pham_bien_the spbt ON sp.id = spbt.id_san_pham GROUP BY sp.id, sp.ten_san_pham, dm.ten_danh_muc, sp.gia_co_ban;";
        return pdo_query($sql);
    }

    //TODO: REFACTOR THIS STUPID CODE
    function get_item_by_category($id){
        if (!$id) {
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
            return pdo_query($sql);
        } else {
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
            return pdo_query($sql);
        }
    }
?>