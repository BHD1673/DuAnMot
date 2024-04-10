<?php
function load_comments($idsp)
{
    $sql = "SELECT comments.name, comments.comment, comments.created_at, nguoi_dung.ho_ten AS user_name
            FROM comments
            JOIN nguoi_dung ON comments.id_user = nguoi_dung.id
            WHERE comments.product_id = $idsp";
    $result = pdo_query($sql);
    return $result;
    // ????????????????
    // trả về cái gì đây em ơi ? 
}
 

function addComment($id_user, $product_id, $comment_content) {
    $sql = "INSERT INTO comments (name, comment, id_user, product_id) VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $_SESSION['user']['ho_ten'], $comment_content, $id_user, $product_id);
}
?>
