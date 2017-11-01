<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/Order.php");

if(isset($_GET["id"])){
    Order::remove($_GET["id"]);
}

header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
exit();
