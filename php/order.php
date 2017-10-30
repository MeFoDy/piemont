<?php

define("is-INDEX-page", true);

include_once ("config.php");
include_once ("db_connect.php");

include_once ("./class/Basket.php");
include_once ("./class/OrderItem.php");
include_once ("lib/PHPMailerAutoload.php");


$basket = null;
$response = array();
$response["code"] = "OK";
if(isset($_POST['basket'])) {
    $basket = json_decode($_POST['basket']);
    $new_basket_id = Basket::add($basket);
    if($new_basket_id != null){
        foreach($basket['products'] as $product){
            OrderItem::add($product, $new_basket_id);
        }
        $mail = new PHPMailer;
	    $mail->CharSet = "UTF-8";
	    $mail->IsHTML(true);
	    $mail->setFrom('xxxxxx@example.com', 'Piemont inc.');
	    $mail->addAddress('xxxxxx@gmail.com', 'Manager');
	    $mail->Subject = "Новый заказ на piemont.by #{$new_basket_id}";
	    $mail->Body = <<<EOT
Hi, there is new order. Nope. 
EOT;
	    if (!$mail->send()) {
	        $response["code"] = "ERROR";
	    }  
    } else {
        $response["code"] = "ERROR";
    }
}

header('Content-type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
