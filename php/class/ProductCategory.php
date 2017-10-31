<?php
if (!defined("is-INDEX-page")) exit();

class ProductCategory
{
    const FIELDS = 'id, name, description, sort_order';
    public static function get($id)
    {
        global $mysqli;
        $ret = null;
        $stmt = mysqli_prepare($mysqli, "SELECT " . self::FIELDS . " FROM product_category WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = get_mysqli_result($stmt);
        if ($row = array_shift($result)) {
            $ret = $row;
        }
        mysqli_stmt_close($stmt);
        return $ret;
    }

    public static function getAll()
    {
        $ret = [];
        global $mysqli;
        $query = "SELECT " . self::FIELDS . " FROM product_category ORDER BY sort_order ASC";
        if (!$result = $mysqli->query($query)) {
            return $ret;
        }
        if ($result->num_rows === 0) {
            return $ret;
        }
        while ($product_category = $result->fetch_assoc()) {
            array_push($ret, $product_category);
        }
        return $ret;
    }

    public static function update($product_category)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE product_category " .
                "SET name=?, description=?, sort_order=? " .
                "WHERE id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "ssii",
            $product_category["name"],
            $product_category["description"],
            $product_category["sort_order"],
            $product_category["id"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }

    public static function add($product_category)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "INSERT INTO product_category(name, description, sort_order) " .
                "VALUES (?, ?, ?)"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $product_category["name"],
            $product_category["description"],
            $product_category["sort_order"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }
}
