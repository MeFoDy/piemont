<?php

echo <<<EOD

<form>
    <h2>Редактировать продукт</h2>

    <div class="input-group fluid">
      <label for="name" style="width: 100px;">Username</label>
      <input type="email" value="" id="name" placeholder="username">
    </div>


    <div class="input-group fluid">
      <button class="primary">Сохранить</button>
      <a class="button" href="index.php?page=products&action=list">Назад</a>
    </div>
</form>

EOD;
