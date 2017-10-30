<?php
include_once ("class/Product.php");
$products = Product::getAll();

include_once ("class/ProductCategory.php");
$categories = ProductCategory::getAll();

echo <<<EOD
<h2>Список продуктов</h2>
<a class="button" href="index.php?page=products&action=add">Добавить</a>
<table>
    <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Путь к изображению</th>
            <th>Ед. измерения</th>
            <th>Количество</th>
            <th>Включено</th>
        </tr>
    </thead>
EOD;


foreach ($products as $product) {
    $key = array_search($product["product_category_id"], array_column($userdb, 'uid'));
    echo <<<EOD
    <tr>
        <td>${$product["name"]}</td>
        <td>${$product["description"]}</td>
        <td>${$product["image_path"]}</td>
        <td>${$product["unit"]}</td>
        <td>${$product["quantity"]}</td>
        <td>${$product["is_active"]}</td>
    </tr>
EOD;
}



echo "</table>";
