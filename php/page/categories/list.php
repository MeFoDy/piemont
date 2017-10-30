<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/ProductCategory.php");
$categories = ProductCategory::getAll();

echo <<<EOD
<h2>Список категорий</h2>
<a class="button" href="index.php?page=categories&action=add">Добавить</a>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
    </thead>
EOD;


foreach ($categories as $category) {
    echo <<<EOD
    <tr>
        <td data-label="#">{$category["sort_order"]}</td>
        <td data-label="Название">{$category["name"]}</td>
        <td data-label="Описание">{$category["description"]}</td>
        <td data-label="Действия">
            <a href="index.php?page=categories&action=edit&id={$category['id']}">Редактировать</a>
        </td>
    </tr>
EOD;
}



echo "</table>";
