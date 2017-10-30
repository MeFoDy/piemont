<?php
if (!defined("is-INDEX-page")) exit();

$mysqli = mysqli_connect($config["db"]["host"], $config["db"]["user"], $config["db"]["password"], $config["db"]["database"]);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
mysqli_set_charset($mysqli, "utf8");
