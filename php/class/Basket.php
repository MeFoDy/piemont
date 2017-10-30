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
                "VALUES ('', ?, ?, ?, ?, now(), false)"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
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
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
        /**
         * WARNING: Possible race condition.. :( 
         * */
        return self::getLast()['id'];
    }
    
    public static function getLast()
    {
        $ret = null;
        global $mysqli;
        $query = "SELECT * FROM basket ORDER BY id DESC LIMIT 1";
        if (!$result = $mysqli->query($query)) {
            return $ret;
        }
        if ($result->num_rows === 0) {
            return $ret;
        }
        return $result->fetch_assoc();
    }
    
}
