<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/ProductCategory.php");

$category = [
    "name" => $_POST["name"],
    "name_short" => $_POST["name_short"],
    "description" => $_POST["description"],
    "price" => $_POST["price"],
    "sort_order" => $_POST["sort_order"]
];
if (isset($_POST["id"])) {
    $category["id"] = $_POST["id"];
    ProductCategory::update($category);
}
else {
    ProductCategory::add($category);
}
header("Location: " . $_SERVER['REQUEST_URI']);
exit();
