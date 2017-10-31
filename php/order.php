<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define("is-INDEX-page", true);

include_once ("config.php");
include_once ("db_connect.php");

include_once ("./class/Basket.php");
include_once ("./class/OrderItem.php");
include_once ("./class/Product.php");
include_once ("./class/ProductCategory.php");

include_once './lib/Exception.php';
include_once './lib/PHPMailer.php';


$basket = null;
$response = array();
$response["code"] = "ERROR";
$json = file_get_contents('php://input');
if (isset($json)) {
    $basket = json_decode(json_decode($json, true)["basket"], true);
    $new_basket_id = Basket::add($basket);
    if ($new_basket_id != false && $new_basket_id != null) {
        $orderProducts = "";
        foreach ($basket['products'] as $product) {
            if (OrderItem::add($product, $new_basket_id)) {
                $p = Product::get($product["product_id"]);
                $c = ProductCategory::get($p["product_category_id"]);
                $orderProducts .= '<li class="text li" style="color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;">'
                    . $c["name"] . ' — '
                    . $p["name"] . ' — '
                    . $product["count"] . ' ' . $p["unit"] . '</li>';
            }
        }

        $mail = new PHPMailer;

        $mail->CharSet = "UTF-8";
        $mail->IsHTML(true);
        $mail->setFrom($config["emails"]["work"], 'Piemont.by', false);
        $mail->addAddress($config["emails"]["work"]);
        $mail->addCC($config["emails"]["personal"]);
        $mail->Subject = "Новый заказ #{$new_basket_id} на piemont.by";
        $mail->Body = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head> </head>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <style type="text/css">
        * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        }

        html {
        height: 100%;
        width: 100%;
        }

        body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
        }

        div[style*="margin: 16px 0"] {
        margin: 0 !important;
        }

        table,
        td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        }

        img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        }

        .ReadMsgBody,
        .ExternalClass {
        width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass td,
        .ExternalClass div {
        line-height: 100%;
        }
    </style>
    <!--[if gte mso 9]>
        <style type="text/css">
        li { text-indent: -1em; }
        table td { border-collapse: collapse; }
        </style>
        <![endif]-->
    <title>Новый заказ #{$new_basket_id} на piemont.by</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
        <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml><![endif]-->
    </head>
    <body class="body" style="background-color: #FFFFFF; margin: 0; width: 100%;">
    <table class="bodyTable" role="presentation" width="100%" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; background-color: #FFFFFF; margin: 0;" bgcolor="#FFFFFF">
        <tr>
        <td class="body__content" align="left" width="100%" valign="top" style="color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;">
            <div class="container" style="margin: 0 auto; max-width: 600px; width: 100%;"> <!--[if mso | IE]>
            <table class="container__table__ie" role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-right: auto; margin-left: auto;width: 600px" width="600" align="center">
                <tr>
                <td> <![endif]-->
                    <table class="container__table" role="presentation" border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                    <tr class="container__row">
                        <td class="container__cell" width="100%" align="left" valign="top">
                        <h2 class="header h2" style="margin: 20px 0; line-height: 30px; color: #000000; font-family: Helvetica,Arial,sans-serif;">Новый заказ #{$new_basket_id} на piemont.by</h2>
                        <p class="text p" style="display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;"> <b>Имя:</b> {$basket["name"]}<br/> <b>Телефон:</b> {$basket["phone"]}<br/> <b>Адрес:</b> {$basket["address"]}<br/> <b>Комментарий:</b> {$basket["comment"]}<br/> </p>
                        <h4 class="header h4" style="margin: 20px 0; color: #000000; font-family: Helvetica,Arial,sans-serif;">Заказанные десерты:</h4>
                        <ol class="text ol" style="color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;">
                            {$orderProducts}
                        </ol> <br/> <a href="https://piemont.by/php/index.php" class="a"><span class="a__text">Перейти в панель администратора piemont.by</span></a> </td>
                    </tr>
                    </table> <!--[if mso | IE]> </td>
                </tr>
            </table> <![endif]--> </div>
        </td>
        </tr>
    </table>
    <div style="display:none; white-space:nowrap; font-size:15px; line-height:0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
    </body>
</html>
EOT;
        if ($mail->send()) {
            $response["code"] = "OK";
        }
    }
}

header('Content-type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
