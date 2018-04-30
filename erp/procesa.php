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

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Servicios($datos));

        // Preparamos la INSERCION del DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";

      file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

        // El caso más importante es la INSERCION de los datos del DIFUNTO
        if($ApiClient->insert($datos_difunto, $modulo)) {

            // Obtenemos el ID del DIFUNTO
            $cond = "nombre='$datos_difunto->nombre'";
            $campos = "id";
            $id_difunto = $ApiClient->select($modulo, $cond, $campos);
            $id_difunto = $id_difunto[0]->id;

            /* Solo añadimos si se han añadido datos
            exceptuando los de por defecto de los <select> */

            // Preparamos la INSERCION del SERVICIO
            $datos_servicio = $json->servicio;
            $excepciones = ["tanatorio", "tipo_servicio", "compañia"];
            if(!compruebaVacio($datos_servicio, $excepciones)) {
                $datos_servicio->id_dif = $id_difunto;
                $modulo = "servicio";

                if(!$ApiClient->insert($datos_servicio, $modulo)) redirige("index.php");
            }

            // Preparamos la INSERCION del CLIENTE
            $datos_cliente = $json->cliente;
            if(!compruebaVacio($datos_cliente)) {
                $datos_cliente->id_dif = $id_difunto;
                $modulo = "cliente";

                if(!$ApiClient->insert($datos_cliente, $modulo)) redirige("index.php");
            }

            // Preparamos la INSERCION de los FAMILIARES
//            $modulo = "familiares";
//            $datos_familiares = $json->familiares;
//            $datos_familiares->id_dif = $id_difunto;
//            if(!$ApiClient->insert($datos_familiares, $modulo)) redirige("index.php");

            // Si el proceso ha ido bien
            redirige("modulos/servicios/main.php?op=nuevoServicio");

        } else redirige("index.php");

    } else redirige("index.php");

} else if($op == "updateDifunto") {

    $datos = $_POST;
    unset($datos['op']);

    // El SERVICIO  es UPDATE o INSERT?
    $aniadirServicio = false;
    if(isset($datos['aniadirServicio'])) {
        $aniadirServicio = $datos['aniadirServicio'];
        unset($datos['aniadirServicio']);
    }

    if(!empty($datos) && $datos['d_nombre'] !== "") {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Servicios($datos));

        // Preparamos el UPDATE del DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";
        $cond = "id='$datos_difunto->id'";

        //file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

        if($ApiClient->update($datos_difunto, $modulo, $cond)) {

            // UPDATE O INSERT ?????

            // Preparamos el UPDATE del SERVICIO
            $datos_servicio = $json->servicio;
            $modulo = "servicio";
            $cond = "id='$datos_servicio->id'";

            if($ApiClient->update($datos_servicio, $modulo, $cond)) {

                redirige("modulos/servicios/main.php?op=e_defuncion&ref=$datos_difunto->id");

            } else redirige("index.php");

        } else redirige("index.php");
    }
}

?>
