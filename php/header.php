<?php
if (!defined("is-INDEX-page")) exit();
?><!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Piemont - admin</title>
    <link rel="stylesheet" href="./styles/mini-default.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php if($isLoggedIn) {?>
    <header class="sticky">
        <label for="drawer-checkbox" class="button drawer-toggle"></label>
        <a href="index.php?page=orders" class="button hidden-sm">Заказы</a>
        <a href="index.php?page=products" class="button hidden-sm">Продукты</a>
        <a href="index.php?page=categories" class="button hidden-sm">Категории</a>
        <a href="index.php?page=login&action=logout" class="button" style="float:right;">Выйти</a>
    </header>
    <input type="checkbox" id="drawer-checkbox">
    <nav class="drawer hidden-md hidden-lg">
        <label for="drawer-checkbox" class="close"></label>
        <h4>
            <a href="index.php?page=orders">Заказы</a>
        </h4>
        <h4>
            <a href="index.php?page=products">Продукты</a>
        </h4>
        <h4>
            <a href="index.php?page=categories">Категории</a>
        </h4>
        <br>
        <h4>
            <a href="index.php?action=logout">Выйти</a>
        </h4>
    </nav>
    <?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
                <br>
