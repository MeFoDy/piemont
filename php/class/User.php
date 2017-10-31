<?php
if (!defined("is-INDEX-page")) exit();

class User
{
    public static function get($username)
    {
        $ret = null;
        global $mysqli;
        $username = strtolower($username);
        $stmt = mysqli_prepare($mysqli, "SELECT * FROM user WHERE username=?");
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = get_mysqli_result($stmt);
        if ($row = array_shift($result)) {
            $ret = $row;
        }
        mysqli_stmt_close($stmt);
        return $ret;
    }

    public static function updateHashLifetime($user)
    {
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE user SET cookie_time=now() WHERE id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "i",
            $user["id"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
    }

    public static function updateHash($user)
    {
        $newHash = crypt($user["username"]);
        global $mysqli;
        if (! ($stmt = mysqli_prepare(
            $mysqli,
            "UPDATE user " .
                "SET cookie_hash=?, cookie_time=now() " .
                "WHERE id=?"
        ))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        if (!mysqli_stmt_bind_param(
            $stmt,
            "si",
            $newHash,
            $user["id"]
        )) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        mysqli_stmt_close($stmt);
        return $newHash;
    }
}
