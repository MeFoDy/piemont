<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/Order.php");

if(isset($_GET["id"])){
    Order::confirm($_GET["id"]);
}

include_once("page/orders/list.php");