<?php
if (!defined("is-INDEX-page")) exit();

class Basket
{
    const FIELDS = 'id, name, phone, address, comment, created_on, is_done';

    public static function add($basket)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "INSERT INTO basket(". self::FIELDS . ") " .
                "VALUES (0, ?, ?, ?, ?, now(), false)"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
            return false;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $basket["name"],
            $basket["phone"],
            $basket["address"],
            $basket["comment"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        mysqli_stmt_close($stmt);
        return mysqli_insert_id($mysqli);
    }
}
