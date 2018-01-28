<?php
if (!defined("is-INDEX-page")) exit();

class Product
{
    const FIELDS = 'id, name, description, sort_order, product_category_id, price, image_path, unit, quantity, updated_by, updated_on, is_active';

    public static function get($id)
    {
        $ret = null;
        global $mysqli;
        $stmt = mysqli_prepare($mysqli, "SELECT " . self::FIELDS . " FROM product WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = get_mysqli_result($stmt);
        if ($row = array_shift($result)) {
            $ret = $row;
        }
        mysqli_stmt_close($stmt);
        return $ret;
    }

    public static function getByCategory($category_id)
    {
        $ret = [];
        global $mysqli;
        $stmt = mysqli_prepare($mysqli, "SELECT " . self::FIELDS . " FROM product WHERE product_category_id=? ORDER BY sort_order ASC");
        mysqli_stmt_bind_param($stmt, 'i', $category_id);
        mysqli_stmt_execute($stmt);
        $result = get_mysqli_result($stmt);
        while ($row = array_shift($result)) {
            array_push($ret, $row);
        }
        mysqli_stmt_close($stmt);
        return $ret;
    }

    public static function getAll()
    {
        $ret = [];
        global $mysqli;
        $query = "SELECT " . self::FIELDS . " FROM product ORDER BY product_category_id ASC, sort_order ASC";
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

    public static function getActive()
    {
        $ret = [];
        global $mysqli;
        $query = "SELECT " . self::FIELDS . " FROM product WHERE is_active=TRUE ORDER BY sort_order ASC";
        if (!$result = $mysqli->query($query)) {
            return $ret;
        }
        if ($result->num_rows === 0) {
            return $ret;
        }
        while ($product = $result->fetch_assoc()) {
            array_push($ret, $product);
        }
        return $ret;
    }

    public static function update($product)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE product " .
                "SET name=?, description=?, product_category_id=?, sort_order=?, image_path=?, unit=?, quantity=?, price=?, updated_by=?, updated_on=now(), is_active=? " .
                "WHERE id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "ssiissddssi",
            $product["name"],
            $product["description"],
            $product["product_category_id"],
            $product["sort_order"],
            $product["image_path"],
            $product["unit"],
            $product["quantity"],
            $product["price"],
            $product["updated_by"],
            $product["is_active"],
            $product["id"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }

    public static function add($product)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "INSERT INTO product(name, description, product_category_id, sort_order, image_path, unit, quantity, price, updated_by, updated_on, is_active) " .
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "ssiissddss",
            $product["name"],
            $product["description"],
            $product["product_category_id"],
            $product["sort_order"],
            $product["image_path"],
            $product["unit"],
            $product["quantity"],
            $product["price"],
            $product["updated_by"],
            $product["is_active"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }
}
