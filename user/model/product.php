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
?>