<?php

function send404(){
    if(function_exists('http_responde_code')){
        http_response_code(404);
    } else {
        $protocol = $_SERVER['SERVER_PROTOCOL'] ?: 'HTTP/1.0';
        header("$protocol 404 Not Found");
    }
}

$pagina = array(
    "index.php" => array(
        "php" => "home.php",
        "titulo" => "",
        "descripcion" => "",
    ),
//    "contabilida" => array(
//        "php" => "/contabilidad/main.php",
//        "titulo" => "",
//        "descripcion" => "",
//    ),
    "404" => array(
        "php" => "prueba.php",
        "titulo" => "",
        "descripcion" => "",
    ),
);

$seccion = $_GET["seccion"]; // Ej: index.php
// Si no se encuentra dentro del array, tomaremos como base index (home)
$seccion_base = "index.php";
if(!isset($seccion) || $seccion === "") $seccion = $seccion_base;

if(!$pagina[$seccion] && file_exists($bar = $foo = __DIR__. "../erp/". $seccion . ".php"))
    $src = $foo;
else if($foo = $pagina[$seccion]["php"])
    $src = $foo;
else {
    send404();
    $src = $pagina["404"]["php"];
}

$titulo = $pagina[$seccion]["titulo"] ?: $pagina[$seccion_base]["titulo"];
$descripcion = $pagina[$seccion]["descripcion"] ?: $pagina[$seccion_base]["descripcion"];

if($global_config->titulo)
    $titulo .= ":: " . $global_config->titulo;
