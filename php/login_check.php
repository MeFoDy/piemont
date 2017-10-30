<?php
if (!defined("is-INDEX-page")) exit();

include_once ("./class/User.php");

$isLoggedIn = false;

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $user = User::get($_POST["login"]);
    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        $newHash = User::updateHash($user);
        setUserSession($user["username"], $newHash);
        $isLoggedIn = true;
    }
    else {
        logout();
    }
}
else {
    if (isset($_COOKIE["login"]) && isset($_COOKIE["session_hash"])) {
        $user = User::get($_COOKIE["login"]);
        if (!$user) {
            logout();
        }
        $cookie_time = strtotime($user["cookie_time"]);
        if ($cookie_time + 60 * 17 < time()) {
            logout();
        }
        if (hash_equals($_COOKIE["session_hash"], $user["cookie_hash"])) {
            User::updateHashLifetime($user);
            $isLoggedIn = true;
        }
    }
}
if (!$isLoggedIn) {
    logout();
}
