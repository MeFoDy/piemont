<?php
define("is-INDEX-page", true);

ob_start();

if (isset($_GET["action"]) && strtolower($_GET["action"]) == "logout") {
    logout();
}

$target = "./page/orders/orders.php";

if (isset($_GET["page"])) {
    switch (strtolower($_GET["page"])) {
        case "login" :
            $target = "./page/login/login.php";
            break;
        case "products" :
            $target = "./page/products/products.php";
            break;
        case "categories" :
            $target = "./page/categories/categories.php";
            break;
        case "orders" :
            $target = "./page/orders/orders.php";
            break;
    }
}

include_once ("config.php");
include_once ("db_connect.php");

if ($target != "./page/login/login.php") {
    include_once ("login_check.php");
}

include_once ("header.php");

include_once ($target);

include_once ("footer.php");

ob_end_flush();



function logout()
{
    clearUserSession();
    header("Location: index.php?page=login");
    exit();
}

function clearUserSession()
{
    $time = time() - 1000;
    setcookie("login", "z", $time);
    setcookie("session_hash", "z", $time);
}

function setUserSession($login, $hash)
{
    $time = time() + 60 * 17;
    setcookie("login", strtolower($login), $time);
    setcookie("session_hash", $hash, $time);
}
