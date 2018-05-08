<?php

/* ----------------------------------------------------------------------
                        FUNCIONES nuevoServicio
---------------------------------------------------------------------- */

/**
 * Dividimos Array en secciones
 *
 * @param string $datos (JSON) Datos de formularios
 * @return string JSON {difunto, servicio, cliente, familiares,...}
 */
function construyeJSON_Datos($datos) {

    // Inicializamos
    $datos = json_decode($datos);
    $aux_difunto = [];
    $aux_servicio = [];
    $aux_cliente = [];
    $aux_familiares = [];

    foreach($datos as $clave => $valor) {

        // Extraemos
        $inicial = substr($clave,0,2);
        $clave = substr($clave,2);

        // Guardamos los distintos bloques en var auxiliares
        if($inicial == "d_") $aux_difunto[$clave] = $valor;
        else if($inicial == "s_") $aux_servicio[$clave] = $valor;
        else if($inicial == "c_") $aux_cliente[$clave] = $valor;
        else if($inicial == "f_") $aux_familiares[$clave] = $valor;
    }

    // Montamos JSON
    $json = [
        "difunto" => $aux_difunto,
        "servicio" => $aux_servicio,
        "cliente" => $aux_cliente,
        "familiares" => $aux_familiares
    ];

    return json_encode($json);
}

function compruebaVacio($datos, $excepciones = null){

    foreach ($datos as $clave => $valor) {

        if(!empty($valor) && !in_array($clave, $excepciones)) return false;
    }

    return true;
}

function ajustarFamiliares($datos_familiares) {

    $res = [];

    foreach ($datos_familiares as $clave => $valor) {
        array_push($res, $valor);
    }

    return $res;

}

/* ----------------------------------------------------------------------
                        FUNCIONES AUXILIARES
---------------------------------------------------------------------- */

function redirige($direccion){
    header("Location: http://localhost/funerariagallego/erp/" . $direccion);
}

function alerta($mensaje) {
    echo "<script>alert('$mensaje');</script>";
}

?>
