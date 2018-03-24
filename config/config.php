<?php
date_default_timezone_set("Europe/Madrid");

//strpos —> Encuentra la posición de la primera ocurrencia de un substring en un string
//$_produccion = strpos($server = $_SERVER["HTTP_HOST"], "toolpoint") !== false;
//$prot = $_produccion ? "https" : "http";
//$host = $_SERVER["HTTP_HOST"] . ($_produccion ? "" : "/toolpoint");

$global_config = (object) array(
    "WWWBASE" => "http://localhost/funerariagallego/erp/",
//    "WWWBASE" => "$prot://$host/",
//    "WWWBASE" => strpos($_SERVER['HTTP_HOST'], 'salesforce') === false ?
//    "http://{$_SERVER['HTTP_HOST']}/salesforce_control/" : "http://previos.desarrollotic.com/salesforce_control/",
    "titulo"=>"Funeraria Gallego",
//    "test" => 1,
//    "mail_from" => "info@toolpoint.es",
//    "web" => "toolpoint.es",
    "empresa" => "Funeraria Gallego",
//    "mppal" => "info@toolpoint.es",
//    "msg_gracias" => "Mensaje enviado. Muchas gracias",
//    "msg_error" => "Error enviando el mensaje",
//    "PASARELA_BASE" => "$prot://$host/pasarelas/",
//    "PASARELA_BASE" => "https://www.toolpoint.es/pasarelas/",
);

/*$tp_config = (object) array(
    "msg_sin_stock" => "Producto agotado. Sin fecha de entrada prevista.",
    "msg_stock_pronto" => "Producto agotado. Con fecha de entrada prevista.",
);*/

$TELEFONO = "663791200";
