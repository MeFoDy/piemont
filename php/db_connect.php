<?php
if (!defined("is-INDEX-page")) exit();

$mysqli = mysqli_connect($config["db"]["host"], $config["db"]["user"], $config["db"]["password"], $config["db"]["database"]);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
mysqli_set_charset($mysqli, "utf8");


// when mysqlnd is disabled on server
// https://stackoverflow.com/a/30551477/5596125
function get_mysqli_result($stmt)
{
    $result = array();
    $stmt->store_result();
    for ($i = 0; $i < $stmt->num_rows; $i++) {
        $metadata = $stmt->result_metadata();
        $params = array();
        while ($field = $metadata->fetch_field()) {
            $params[] = &$result[$i][$field->name];
        }
        call_user_func_array(array($stmt, 'bind_result'), $params);
        $stmt->fetch();
    }
    return $result;
}
