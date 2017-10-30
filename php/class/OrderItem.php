<?php
if (!defined("is-INDEX-page")) exit();

class OrderItem
{
    const FIELDS = 'id, product_id, basket_id, count, is_done';

   public static function add($item, $basket_id)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "INSERT INTO order_item(". self::FIELDS . ") " .
                "VALUES ('', ?, ?, ?, false)"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "iid",
            $item["product_id"],
            $basket_id,
            $item["count"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }
}
