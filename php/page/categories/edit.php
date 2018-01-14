<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/ProductCategory.php");
$category = ProductCategory::get($_GET["id"]);

echo <<<EOD

<form action="index.php?page=categories&action=list" method="POST">
    <h2>Редактировать категорию</h2>

    <input type="hidden" name="id" value="{$category["id"]}">

    <div class="input-group fluid">
      <label for="name" style="width: 100px;">Название</label>
      <input type="text" required value="{$category["name"]}" name="name" id="name" placeholder="Десерты замороженные 'Премиум'">
    </div>

    <div class="input-group fluid">
      <label for="name_short" style="width: 100px;">Имя</label>
      <input autofocus type="text" required value="{$category["name_short"]}" name="name_short" id="name_short" placeholder="Премиум">
    </div>

    <div class="input-group fluid align-top">
      <label for="description" style="width: 100px;">Описание</label>
      <textarea id="description" name="description">{$category["description"]}</textarea>
    </div>

    <div class="input-group fluid">
      <label for="price" style="width: 100px;">Цена</label>
      <input type="text" required value="{$category["price"]}" name="price" id="price" placeholder="1 руб 75 коп">
    </div>

    <div class="input-group fluid">
      <label for="sort_order" style="width: 100px;">Порядок</label>
      <input type="number" min="0" step="1" required value="{$category["sort_order"]}" name="sort_order" id="sort_order" placeholder="0">
    </div>


    <div class="input-group fluid">
      <button class="primary" type="submit">Сохранить</button>
      <a class="button" href="index.php?page=categories&action=list">Назад</a>
    </div>
</form>

EOD;
