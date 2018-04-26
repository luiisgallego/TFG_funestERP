<?php
@session_start();
require '../config/API_Global.php';

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

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

    if($datos['nombre'] !== "") {
        $datos = json_encode($datos);

        if($ApiClient->nuevoServicio($datos) === true) {
            redirige("modulos/servicios/main.php?op=nuevoServicio");
        } else {
            redirige("index.php");
        }
    } else redirige("index.php");
}

function redirige($direccion){
    header("Location: http://localhost/funerariagallego/erp/" . $direccion);
}
?>
