<?php
@session_start();
require '../config/API_Global.php';
include_once('func_procesa.php');

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

// Obtenemos la opcion mandada
if($_POST['op']) $op = $_POST['op'];
else $op = $_GET['op'];

if($op == "login") {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($ApiClient->login($user, $pass)) header("Location: http://localhost/funerariagallego/erp/index.php");
    else header("Location: http://localhost/funerariagallego/erp/login.php");

} else if($op == "logout") {

    $ApiClient->logout();
    header("Location: http://localhost/funerariagallego/erp/login.php");

} else if($op == "nuevoServicio") {

    $datos = $_POST;
    unset($datos['op']);

    if(!empty($datos) && $datos['d_nombre'] !== "") {

        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Servicios($datos));
        $modulo = "difunto";

       file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

        if($ApiClient->insert($json->difunto, $modulo)) {
//            $excepciones = ["tanatorio", "tipo_servicio"];
//            $res = compruebaVacio($json->servicio, $excepciones);
//            if($res) {
//                redirige("index.php");
//            } else {
//                redirige("modulos/servicios/main.php?op=nuevoServicio");
//            }
            redirige("modulos/servicios/main.php?op=nuevoServicio");
        } else {
            redirige("index.php");
        }

    } else {
//        $mensaje = "PROBANDO";
//        alerta($mensaje);
        redirige("index.php");
    }
}

?>
