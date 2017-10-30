<?php
if (!defined("is-INDEX-page")) exit();

include_once("class/Order.php");
$orders = Order::getAll();


echo <<<EOD
<h2>Список заказов</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Адрес</th>
            <th>Телефон</th>
            <th>Имя</th>
            <th>Заказ</th>
            <th>Действия</th>
        </tr>
    </thead>
EOD;


foreach ($orders as $id => $items) {
    $order_text = "";
    foreach($items as $order){
        $order_text = "<li>{$order['product_name']} - {$order['count']}</li>";
    }
    
echo <<<EOD
    <tr>
        <td data-label="#">{$items[0]["id"]}</td>
        <td data-label="Адрес">{$items[0]["address"]}</td>
        <td data-label="Телефон">{$items[0]["phone"]}</td>
        <td data-label="Имя">{$items[0]["customer_name"]}</td>
        <td data-label="Заказ"><ul>{$order_text}</ul></td>
        <td data-label="Действия">
EOD;
if(!$items[0]["basket_is_done"]){
echo <<<EOD
        <a href="index.php?page=orders&action=confirm&id={$items[0]["id"]}">Подтвердить</a>
EOD;
}
echo "
        </td>
    </tr>";
}



echo "</table>";
