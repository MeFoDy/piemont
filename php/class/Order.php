<?php
if (!defined("is-INDEX-page")) exit();

class Order
{
    public static function getAll($withComplete = false, $withNew = true)
    {
        $ret = [];
        global $mysqli;
        $whereClause = "";
        if ($withComplete) {
            if ($withNew) {
                $whereClause = ""; // all
            }
            else {
                $whereClause = "WHERE b.is_done = TRUE"; // done only
            }
        }
        else {
            if ($withNew) {
                $whereClause = "WHERE b.is_done != TRUE";  // new only
            }
            else {
                $whereClause = "WHERE FALSE = TRUE"; // nothing :)
            }
        }
        $query = <<<EOT
        SELECT
            b.created_on as 'created_on',
            b.id as 'id',
            b.name as 'customer_name',
            b.phone as 'phone',
            b.address as 'address',
            b.comment as 'comment',
            p.name as 'product_name',
            p.unit as 'unit',
            oi.count as 'count',
            b.is_done as 'basket_is_done'
        FROM basket AS b
        RIGHT JOIN order_item AS oi ON b.id = oi.basket_id
        LEFT JOIN product AS p ON oi.product_id = p.id
        {$whereClause}
        ORDER BY created_on DESC
EOT;
        if (!$result = $mysqli->query($query)) {
            return $ret;
        }
        if ($result->num_rows === 0) {
            return $ret;
        }

        while ($order = $result->fetch_assoc()) {
            $id = $order['id'];
            if (isset($ret[$id])) {
                $ret[$id][] = $order;
            }
            else {
                $ret[$id] = array($order);
            }
        }
        return $ret;
    }

    public static function confirm($basket_id)
    {
        global $mysqli;
        /**
         *  Set basket done
         * */
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE basket SET is_done = TRUE WHERE id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "i",
            $basket_id
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);

        /**
         *  Set order_items done
         * */
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE order_item SET is_done = TRUE WHERE basket_id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "i",
            $basket_id
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);


        /**
         * Count decreasing
         * */
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE product AS p RIGHT JOIN order_item AS oi ON oi.product_id=p.id SET quantity = quantity - oi.count  WHERE oi.basket_id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "i",
            $basket_id
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }
}
