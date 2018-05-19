<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/Product.php");

$product = [
    "name" => $_POST["name"],
    "description" => $_POST["description"],
    "product_category_id" => $_POST["product_category_id"],
    "sort_order" => $_POST["sort_order"],
    "image_path" => $_POST["image_path"],
    "unit" => $_POST["unit"],
    "quantity" => $_POST["quantity"],
    "price" => $_POST["price"],
    "video_url" => $_POST["video_url"],
    "updated_by" => $_POST["updated_by"] || $user["name"],
    "is_active" => $_POST["is_active"],
];
if (isset($_POST["id"])) {
    $product["id"] = $_POST["id"];
    Product::update($product);
}
else {
    Product::add($product);
}
header("Location: " . $_SERVER['REQUEST_URI']);
exit();
