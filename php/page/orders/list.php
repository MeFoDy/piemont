<?php
if (!defined("is-INDEX-page")) exit();

include_once("class/Order.php");

$withComplete = false;
$withNew = true;
if (isset($_GET["mod"])) {
    if ($_GET["mod"] == "complete") {
        $withComplete = true;
        $withNew = false;
    }
    if ($_GET["mod"] == "all") {
        $withComplete = true;
        $withNew = true;
    }
}
$orders = Order::getAll($withComplete, $withNew);


echo <<<EOD
<h2>Список заказов</h2>
<a class="button" href="index.php?page=orders&action=list">Показать новые</a>
<a class="button" href="index.php?page=orders&action=list&mod=complete">Показать обработанные</a>
<a class="button" href="index.php?page=orders&action=list&mod=all">Показать все</a>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Время</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Комментарий</th>
            <th>Заказ</th>
            <th>Действия</th>
        </tr>
    </thead>
EOD;


foreach ($orders as $id => $items) {
    $order_text = "";
    foreach($items as $order){
        $order_text .= "<li>{$order['product_name']} - {$order['count']} {$order['unit']}</li>";
    }
    $item = $items[0];

echo <<<EOD
    <tr>
        <td data-label="#">{$item["id"]}</td>
        <td data-label="Время">{$item["created_on"]}</td>
        <td data-label="Имя">{$item["customer_name"]}</td>
        <td data-label="Телефон">{$item["phone"]}</td>
        <td data-label="Адрес">{$item["address"]}</td>
        <td data-label="Комментарий">{$item["comment"]}</td>
        <td data-label="Заказ"><ul>{$order_text}</ul></td>
        <td data-label="Действия">
EOD;
if(!$item["basket_is_done"]){
echo <<<EOD
        <a class="button primary" href="index.php?page=orders&action=confirm&id={$item["id"]}">Подтвердить</a>
EOD;
} else {
    echo "<mark class='tertiary'>обработан</mark>";
}
echo <<<EOD
            <a class="button secondary" href="index.php?page=orders&action=remove&id={$item["id"]}" onclick="return confirm('Вы уверены, что хотите удалить заказ?');">&times;</a>
        </td>
    </tr>
EOD;
}



echo "</table>";
