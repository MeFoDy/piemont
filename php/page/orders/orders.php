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
        case "confirm":
            $action = "confirm";
            break;
        case "remove":
            $action = "remove";
            break;
    }
}

include_once ($action . ".php");
