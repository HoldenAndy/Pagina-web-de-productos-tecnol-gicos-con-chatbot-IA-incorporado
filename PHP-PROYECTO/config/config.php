<?php
define("SITE_URL", "http://localhost/ProyectoFinalTallerWeb/PHP-PROYECTO");
define("CLIENT_ID", "AZxVgbh_H_86jvWU2jq8Ix7mnVu4evmfywvsDYxki9IbinigtlbvgYA7VKOE_w6OJXO3WkGQ8ixO-GEN");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "S/");




define("MAIL_HOST", "smtp.gmail.com");
define("MAIL_USER", "dannyzara775@gmail.com");
define("MAIL_PASS", "rvac xxvb jjlg lyjq");
define("MAIL_PORT", "465");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>