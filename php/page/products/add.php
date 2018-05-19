<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/ProductCategory.php");
$categories = ProductCategory::getAll();

$category_options = "";
foreach ($categories as $category) {
  $category_options .= "<option value='" . $category["id"] . "'>" . $category["name"] . "</option>";
}

echo <<<EOD

<form action="index.php?page=products&action=list" method="POST">
    <h2>Новый продукт</h2>

    <div class="input-group fluid">
      <label for="name" style="width: 120px;">Название</label>
      <input autofocus type="text" required value="" name="name" id="name" placeholder="Карамельный">
    </div>

    <div class="input-group fluid align-top">
      <label for="description" style="width: 120px;">Описание</label>
      <textarea id="description" name="description"></textarea>
    </div>

    <div class="input-group fluid">
      <label for="product_category_id" style="width: 120px;">Категория</label>
      <select id="product_category_id" name="product_category_id">
        {$category_options}
      </select>
    </div>

    <div class="input-group fluid">
      <label for="sort_order" style="width: 120px;">Порядок</label>
      <input type="number" required value="100" min="0" step="1" name="sort_order" id="sort_order" placeholder="0">
    </div>

    <div class="input-group fluid">
      <label for="image_path" style="width: 120px;">Изображение</label>
      <input type="text" required value="" name="image_path" id="image_path" placeholder="ice-cream.png">
    </div>

    <div class="input-group fluid">
      <label for="video_url" style="width: 120px;">Видео</label>
      <input type="text" name="video_url" id="video_url" placeholder="https://youtube.com/...">
    </div>

    <div class="input-group fluid">
      <label for="unit" style="width: 120px;">Ед. измерения</label>
      <input type="text" required value="кг" name="unit" id="unit" placeholder="кг">
    </div>

    <div class="input-group fluid">
      <label for="quantity" style="width: 120px;">На складе</label>
      <input type="number" required value="" min="0" step="0.01" name="quantity" id="quantity" placeholder="0">
    </div>

    <div class="input-group fluid">
      <label for="price" style="width: 120px;">Цена (Br)</label>
      <input type="number" required value="" min="0" step="0.01" name="price" id="price" placeholder="25">
    </div>

    <div class="input-group">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="is_active" value="1" name="is_active" tabindex="0" checked>
      <label for="is_active">Показывать на сайте</label>
    </div>


    <div class="input-group fluid">
      <button class="primary" type="submit">Добавить</button>
      <a class="button" href="index.php?page=products&action=list">Назад</a>
    </div>
</form>

EOD;
