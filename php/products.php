<?php

define("is-INDEX-page", true);

include_once ("config.php");
include_once ("db_connect.php");

include_once ("./class/ProductCategory.php");
include_once ("./class/Product.php");

$categories = ProductCategory::getAll();
foreach ($categories as $key => $category) {
    $products = Product::getByCategory($category["id"]);
    $categories[$key]["products"] = [];
    foreach ($products as $k => $product) {
      if ($product["is_active"]) {
        array_push($categories[$key]["products"], $product);
      }
    }
}

header('Content-type: application/json');
echo json_encode($categories, JSON_UNESCAPED_UNICODE);
