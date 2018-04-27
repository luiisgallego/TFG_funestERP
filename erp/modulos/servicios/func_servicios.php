<?php

/**
 * Dividimos Array formulario nuevoServicio en secciones
 *
 * @param string $datos (JSON) Datos formulario nuevoServicio
 * @return string JSON {difunto, servicio, cliente, familiares,...}
 */
function construyeJSON_Servicios($datos) {

    // Inicializamos
    $datos = json_decode($datos);
    $aux_difunto = [];
    $aux_familiares = [];

    foreach($datos as $clave => $valor) {

        // Extraemos
        $inicial = substr($clave,0,2);
        $clave = substr($clave,2);

        // Guardamos los distintos bloques en var auxiliares
        if($inicial == "d_") $aux_difunto[$clave] = $valor;
        else if($inicial == "f_") $aux_familiares[$clave] = $valor;
    }

    // Montamos JSON
    $json = [
        "difunto" => $aux_difunto,
        "familiares" => $aux_familiares
    ];

    return json_encode($json);
}

?>
