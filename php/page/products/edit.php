<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/ProductCategory.php");
$categories = ProductCategory::getAll();

include_once ("class/Product.php");
$product = Product::get($_GET["id"]);

$category_options = "";
foreach ($categories as $category) {
  $selected = $product["product_category_id"] == $category["id"] ? " selected " : "";
  $category_options .= "<option value='" . $category["id"] . "' " . $selected . ">" . $category["name"] . "</option>";
}
$enabled = $product["is_active"] ? " checked " : "";

echo <<<EOD

<form action="index.php?page=products&action=list" method="POST">
    <h2>Редактировать продукт</h2>

    <input type="hidden" name="id" value="{$product["id"]}">

    <div class="input-group fluid">
      <label for="name" style="width: 120px;">Название</label>
      <input autofocus type="text" required value="{$product["name"]}" name="name" id="name" placeholder="Карамельный">
    </div>

    <div class="input-group fluid align-top">
      <label for="description" style="width: 120px;">Описание</label>
      <textarea id="description" name="description">{$product["description"]}</textarea>
    </div>

    <div class="input-group fluid">
      <label for="product_category_id" style="width: 120px;">Категория</label>
      <select id="product_category_id" name="product_category_id">
        {$category_options}
      </select>
    </div>

    <div class="input-group fluid">
      <label for="sort_order" style="width: 120px;">Порядок</label>
      <input type="number" required value="{$product["sort_order"]}" min="0" step="1" name="sort_order" id="sort_order" placeholder="0">
    </div>

    <div class="input-group fluid">
      <label for="image_path" style="width: 120px;">Изображение</label>
      <input type="text" required value="{$product["image_path"]}" name="image_path" id="image_path" placeholder="ice-cream.png">
    </div>

    <div class="input-group fluid">
      <label for="video_url" style="width: 120px;">Видео</label>
      <input type="text" value="{$product["video_url"]}" name="video_url" id="video_url" placeholder="https://youtube.com/...">
    </div>

    <div class="input-group fluid">
      <label for="unit" style="width: 120px;">Ед. измерения</label>
      <input type="text" required value="{$product["unit"]}" name="unit" id="unit" placeholder="кг">
    </div>

    <div class="input-group fluid">
      <label for="quantity" style="width: 120px;">На складе</label>
      <input type="number" required value="{$product["quantity"]}" min="0" step="0.01" name="quantity" id="quantity" placeholder="0">
    </div>

    <div class="input-group fluid">
      <label for="price" style="width: 120px;">Цена (Br)</label>
      <input type="number" required value="{$product["price"]}" min="0" step="0.01" name="price" id="price" placeholder="25">
    </div>

    <div class="input-group">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="is_active" value="1" name="is_active" tabindex="0" {$enabled}>
      <label for="is_active">Показывать на сайте</label>
    </div>


    <div class="input-group fluid">
      <button class="primary" type="submit">Сохранить</button>
      <a class="button" href="index.php?page=products&action=list">Назад</a>
    </div>
</form>

EOD;
