<?php
if (!defined("is-INDEX-page")) exit();

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
            <th>#</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Изображение</th>
            <th>Ед. изм.</th>
            <th>Количество</th>
            <th>Цена (Byn)</th>
            <th>На сайте</th>
            <th>Действия</th>
        </tr>
    </thead>
EOD;


foreach ($products as $product) {
    $key = array_search($product["product_category_id"], array_column($categories, "id"));
    $category = $categories[$key];
    $enabled = $product["is_active"] ? "<mark class='tertiary'>да</mark>" : "<mark class='secondary'>нет</mark>";
    echo <<<EOD
    <tr>
        <td data-label="#">{$product["sort_order"]}</td>
        <td data-label="Название"><span title="{$product["description"]}">{$product["name"]}</span></td>
        <td data-label="Категория">{$category["name"]}</td>
        <td data-label="Изображение"><img class="img-scale" src="../static/images/icecream/{$product["image_path"]}" style="height:50px; margin:0;"></td>
        <td data-label="Ед. измерения">{$product["unit"]}</td>
        <td data-label="Количество">{$product["quantity"]}</td>
        <td data-label="Цена (Br)">{$product["price"]}</td>
        <td data-label="На сайте">{$enabled}</td>
        <td data-label="Действия">
            <a href="index.php?page=products&action=edit&id={$product['id']}">Редактировать</a>
        </td>
    </tr>
EOD;
}



echo "</table>";
