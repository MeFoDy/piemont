<?php
if (!defined("is-INDEX-page")) exit();
?>
<form method="POST" action="index.php">
    <fieldset>
        <div class="input-group fluid">
            <label for="login" style="width: 80px;">Логин</label>
            <input type="text" id="login" name="login" placeholder="Username">
        </div>
        <div class="input-group fluid">
            <label for="password" style="width: 80px;">Пароль</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="input-group fluid">
            <button class="primary">Войти</button>
        </div>
    </fieldset>
</form>
