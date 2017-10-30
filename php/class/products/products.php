<?php
$action = "list";
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
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
