<?php 


function getCartValue() {
    $sql = 'SELECT 
    id, 
    ten_san_pham, 
    attributes, 
    item_total_price,
    item_total_price * so_luong AS total_price_with_quantity,
    so_luong
FROM (
    SELECT 
        gio_hang.id, 
        san_pham.ten_san_pham, 
        GROUP_CONCAT(san_pham_bien_the.gia_tri SEPARATOR ", ") AS attributes,
        (SUM(san_pham_bien_the.gia_bien_the) + san_pham.gia_co_ban) AS item_total_price,
        gio_hang.so_luong
    FROM 
        gio_hang
    JOIN 
        san_pham_bien_the 
        ON gio_hang.id_san_pham_bien_the_1 = san_pham_bien_the.id
        OR gio_hang.id_san_pham_bien_the_2 = san_pham_bien_the.id
        OR gio_hang.id_san_pham_bien_the_3 = san_pham_bien_the.id
        OR gio_hang.id_san_pham_bien_the_4 = san_pham_bien_the.id
        OR gio_hang.id_san_pham_bien_the_5 = san_pham_bien_the.id
    JOIN 
        san_pham 
        ON san_pham_bien_the.id_san_pham = san_pham.id
    WHERE 
        gio_hang.id_nguoi_dung = ' . $_SESSION['user']['id'] . '
    GROUP BY 
        gio_hang.id, san_pham.id
) AS subquery;
';


    return pdo_query($sql);
}

