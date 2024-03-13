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

function create_customer(
    $name,
    $email,
    $phone_number,
    $password,
    $role = 1,
) {
    $sql = "INSERT INTO `customer` (`name`, `email`, `phone_number`, `password`, `role`) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $email, $phone_number, $password, $role);
}

function update_customer(
    $customer_id,
    $name,
    $phone_number,
    $password,
    $role = 1,
) {
    $sql = "UPDATE `customer` SET `name` = ?, `phone_number` = ?, `password` = ?, `role` = ? WHERE `id` = ?";
    pdo_execute($sql, $name, $phone_number, $password, $role, $customer_id);
}

function delete_customer($customer_id) {
    $sql = "DELETE FROM `customer` WHERE `id` = ?";
    pdo_execute($sql, $customer_id);
}

// Product section
function get_product($id = null) {
    if ($id === null) {
        $sql = "SELECT * FROM `product`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `product` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function create_product(    
)
{
    $sql = "INSERT INTO `product` 
    (
        `name`, 
        `retail_price`, 
        `wholesale_price`, 
        `purchase_price`, 
        `quantity`, 
        `description`, 
        `category_id`, 
        `brand_id`, 
        `image`) 
    VALUES (
        'New Product', 
        '49.99', 
        '29.99', 
        '19.99', 
        10, 
        'Description of the new product', 
        1, 
        1, 
        'new_product.jpg');
    ";
    pdo_execute($sql);
}

function update_product() {
    $sql = "UPDATE `product` SET `name` = 'Updated Product Name', `retail_price` = '69.99' WHERE `id` = 1;
    ";
    pdo_execute($sql);
}

function delete_product($id) {
    $sql = "DELETE FROM `product` WHERE `id` = ?";
    pdo_execute($sql, $id);
}

// Attribute section

function get_attribute_detail($id = null) {
    if ($id === null) {
        $sql = "SELECT * FROM `product_attribute_detail`";
        return pdo_query($sql);
    } else {
        $sql = "SELECT * FROM `product_attribute_detail` WHERE `id` = ?";
        return pdo_query_one($sql, $id);
    }
}

function create_attribute_detail(
    $product_id,
    $attribute_id,
    $value
) {
    $sql = "INSERT INTO `product_attribute_detail` (`product_id`, `attribute_id`, `value`) VALUES (?, ?, ?)";
    return pdo_execute($sql, $product_id, $attribute_id, $value);
}

function update_attribute_detail(
    $id,
    $product_id,
    $attribute_id,
    $value
) {
    $sql = "UPDATE `product_attribute_detail` SET `product_id` = ?, `attribute_id` = ?, `value` = ? WHERE `id` = ?";
    return pdo_execute($sql, $product_id, $attribute_id, $value, $id);
}

function delete_attribute_detail($id) {
    $sql = "DELETE FROM `product_attribute_detail` WHERE `id` = ?";
    return pdo_execute($sql, $id);
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
    $sql = 
    "SELECT p.id AS product_id, p.name AS product_name, p.description AS product_description, p.category_id, MAX(pv.image) AS product_image, AVG(pv.price) AS average_price, SUM(pv.quantity) AS total_variant_quantity, c.id AS category_id, c.name AS category_name, p.created_at AS product_created_at, p.update_at AS product_update_at FROM product p LEFT JOIN product_variant pv ON p.id = pv.product_id LEFT JOIN category c ON p.category_id = c.id GROUP BY p.id, p.name, p.description, p.category_id, c.id, c.name, p.created_at, p.update_at;

";
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

function get_variant($id) {
    $sql = "SELECT * FROM `product_variant` WHERE `product_id` = $id;
    ";
    return pdo_query($sql);
}