<?php
if (!defined("is-INDEX-page")) exit();

include_once ("class/Order.php");

header("Location: " . $_SERVER['REQUEST_URI']);
exit();
