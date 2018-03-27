<?php
@session_start();
require '../config/swagger.php';

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
    $datos = array(
        "nombre" => $_POST['nombre'],
        "apellidos" => $_POST['apellidos'],
        "DNI" => $_POST['DNI'],
        "tipo_servicio" => $_POST['tipo_servicio'],
        "tanatorio" => $_POST['tanatorio'],
        "poblacion" => $_POST['natural_de'],
        "provincia" => $_POST['provincia'],
        "calle" => $_POST['calle'],
        "numero" => $_POST['numero'],
        "fecha_nacimiento" => $_POST['fecha_nacimiento'],
        "estado_civil" => $_POST['estado_civil'],
    );

    $datos = json_encode($datos);
//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

    if($ApiClient->nuevoServicio($datos) === true) {
        header("Location: http://localhost/funerariagallego/erp/modulos/servicios/main.php?op=nuevoServicio");
    } else {
        header("Location: http://localhost/funerariagallego/erp/index.php");
    }
}

?>
