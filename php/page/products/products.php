<?php
if (!defined("is-INDEX-page")) exit();

if (isset($_POST["name"])) {
    include_once ("process.php");
}

$action = "list";
if (isset($_GET["action"])) {
    switch (strtolower($_GET["action"])) {
        case "list" :
            $action = "list";
            break;
        case "add" :
            $action = "add";
            break;
        case "edit" :
            $action = "edit";
            break;
    }
}

include_once ($action . ".php");
