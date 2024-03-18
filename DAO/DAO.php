<?php

// Tất cả các query ở đây sẽ chỉ mang tính chất chung chung.
// More custom will have to be create and write in the model folder in the future.

// Attribute section
function get_attribute($id = null)
{
    if ($id === null) {
        $sql = "SELECT * FROM `attribute`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `attribute` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function create_attribute($name)
{
    $sql = "INSERT INTO `attribute` (`name`) VALUES (?)";
    pdo_execute($sql, $name);
}

function update_attribute($id, $name)
{
    $sql = "UPDATE `attribute` SET `name` = ? WHERE `id` = ?";
    pdo_execute($sql, $name, $id);
}

function delete_attribute($id)
{
    $sql = "DELETE FROM `attribute` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Brand section
function create_brand($name, $description)
{
    $sql = "INSERT INTO `brand` (`name`, `description`) VALUES (?, ?)";
    pdo_execute($sql, $name, $description);
}

function get_brand($id = null)
{
    if ($id === null) {
        $sql = "SELECT * FROM `brand`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `brand` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function get_item_follow_brand($id)
{
    if ($id === null) {
        echo "Error";
    } else {
        $sql = "SELECT * FROM `products` WHERE `brand_id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function update_brand($id, $name, $description)
{
    $sql = "UPDATE `brand` SET `name` = ?, `description` = ? WHERE `id` = ?";
    pdo_execute($sql, $name, $description, $id);
}

function delete_brand($id)
{
    $sql = "DELETE FROM `brand` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Category section
function get_category($id = null)
{
    if ($id === null) {
        $sql = "SELECT * FROM `category`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `category` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function create_category($name, $description)
{
    $sql = "INSERT INTO `category` (`name`, `description`) VALUES (?, ?)";
    pdo_execute($sql, $name, $description);
}

function update_category($id, $name, $description)
{
    $sql = "UPDATE `category` SET `name` = ?, `description` = ? WHERE `id` = ?";
    pdo_execute($sql, $name, $description, $id);
}

function delete_category($id)
{
    $sql = "DELETE FROM `category` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Invoice section
function get_invoice($id = null)
{
    if ($id === null) {
        $sql = "SELECT * FROM `invoice`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `invoice` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function create_invoice(
    $customer_id, 
    $total_price, 
    $product_group, 
    $price_group, 
    $status = 1)
{
    $sql = "INSERT INTO `invoice` (`customer_id`, `total_price`, `product_group`, `price_group`, `status`) VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $customer_id, $total_price, $product_group, $price_group, $status);
}

function update_invoice(
    $id, 
    $customer_id, 
    $total_price, 
    $product_group, 
    $price_group, 
    $status = 1)
{
    $sql = "UPDATE `invoice` SET `customer_id` = ?, `total_price` = ?, `product_group` = ?, `price_group` = ?, `status` = ? WHERE `id` = ?";
    pdo_execute($sql, $customer_id, $total_price, $product_group, $price_group, $status, $id);
}

function delete_invoice($id)
{
    $sql = "DELETE FROM `invoice` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Cart session
function get_cart($id = null) {
    if ($id === null) {
        $sql = "SELECT * FROM `cart`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT *
        FROM cart_session
        WHERE customer_id = ?;";
        return pdo_query_one($sql, $id);
    }
}

function add_to_cart($product_id, $quantity) {
    $sql =
    "INSERT INTO cart_session 
    (id, 
    customer_id, 
    product_id, 
    quantity, 
    product_price)
    VALUES (
        ?, 
        ?, 
        ?, 
        ?, 
        '149.990');
    ";
    pdo_execute($sql, $product_id, $quantity);
}

function update_cart($id, $quantity) {
    $sql = "UPDATE `cart_session` SET `quantity` = ? WHERE `id` = ?";
    pdo_execute($sql, $quantity, $id);
}

function delete_cart($id) {
    $sql = "DELETE FROM `cart_session` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Customer 
function get_customer($id = null) {
    if ($id === null) {
        $sql = "SELECT * FROM `customer`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `customer` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}


//TODO: Write based function for the address table and maybe user bank information
//TODO: Also write about the article page and some more idk.

// Everything new are have to write under this line.


function get_product_by_category($id) {
    $sql = "SELECT * FROM `product` WHERE `category_id` = ?";
    return pdo_query_one($sql, $id);
}

function get_comment_by_product($id) {
    $sql = "SELECT * FROM `comment` WHERE `product_id` = ?";
    return pdo_query_one($sql, $id);
}

// Từ cái phần copy của thiện

function insert_taikhoan($email,$user,$pass,$phone){
    $sql="INSERT INTO `nguoi_dung` ( `ho_ten`, `email`, `so_dien_thoai`,`mat_khau`) VALUES ( '$user', '$email','$phone','$pass'); ";
    pdo_execute($sql);
}
function login($user,$pass) {
    $sql="SELECT * FROM `nguoi_dung` WHERE ho_ten='$user' and mat_khau='$pass'";
    $taikhoan = pdo_query_one($sql);

    if ($taikhoan != false) {
        $_SESSION['user'] = $user;
    } else {
        return "Thông tin tài khoản sai";
    }

}


function get_product_by_index() {
    $sql = "SELECT
    p.id AS product_id,
    p.name AS product_name,
    p.category_id as category_id,

    COALESCE(SUM(pv.quantity),0) AS total_variant_quantity,
    MAX(pv.imageurl) AS product_image,
    p.created_at AS product_created_at,
    p.update_at AS product_update_at
FROM
    product p
LEFT JOIN product_variant_category pvc ON
    p.id = pvc.product_id
LEFT JOIN product_variant pv ON
    pvc.id = pv.variant_category_id
GROUP BY
    p.id
ORDER BY
    p.id;
    ";
    //$sql = "SELECT * FROM product";
    return pdo_query($sql);
}

function fetch_product_variants() {
    $sql = "SELECT * FROM product_variant";
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->query($sql);
        $variants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $variants;
    } catch(PDOException $e) {
        throw $e;
    }
}

function get_variant_category($id) {
    $sql = "SELECT * FROM `product_variant_category` WHERE product_id = $id;";
    return pdo_query($sql);
}

function add_product_variant_category($product_id, $variant_type, $description) {
    $sql = "INSERT INTO `product_variant_category` (`product_id`, `variant_type`, `desc`) VALUES (?, ?, ?);";
    return pdo_execute($sql, $product_id, $variant_type, $description);
}

function get_variant($id) {
    $sql = "SELECT * FROM `product_variant` WHERE id = $id;";
}