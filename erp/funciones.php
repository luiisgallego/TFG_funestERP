<?php
/* ----------------------------------------------------------------------
                        FUNCIONES
---------------------------------------------------------------------- */

/**
 * Dividimos Array en secciones
 *
 * @param string $datos (JSON) Datos de formularios
 * @return string JSON {difunto, servicio, cliente, familiares, facturas...}
 */
function construyeJSON_Datos($datos) {

    // Inicializamos
    $datos = json_decode($datos);
    $aux_difunto = [];
    $aux_servicio = [];
    $aux_cliente = [];
    $aux_familiares = [];
    $aux_facturas = [];

    foreach($datos as $clave => $valor) {

        // Extraemos
        $inicial = substr($clave,0,2);
        $clave = substr($clave,2);

        // Guardamos los distintos bloques en var auxiliares
        if($inicial == "d_") $aux_difunto[$clave] = $valor;
        else if($inicial == "s_") $aux_servicio[$clave] = $valor;
        else if($inicial == "c_") $aux_cliente[$clave] = $valor;
        else if($inicial == "f_") $aux_familiares[$clave] = $valor;
        else if($inicial == "t_") $aux_facturas[$clave] = $valor;
    }

    // Montamos JSON
    $json = [
        "difunto" => $aux_difunto,
        "servicio" => $aux_servicio,
        "cliente" => $aux_cliente,
        "familiares" => $aux_familiares,
        "facturas" => $aux_facturas
    ];

    return json_encode($json);
}

/**
 * Comprobamos si el array esta vacio
 *
 * Se le pueden pasar algunas excepciones que
 * tendrán info pero no nos valen
 *
 * @param array $datos Datos a comprobar
 * @param array $excepciones Datos que pueden tener info
 * @return bool true si es vacio
 */
function compruebaVacio($datos, $excepciones = null){

    foreach ($datos as $clave => $valor) {

        if(!empty($valor) && !in_array($clave, $excepciones)) return false;
    }

    return true;
}

function ajustarFam_Fact($datos) {

    $res = [];

    foreach ($datos as $clave => $valor) {
        array_push($res, $valor);
    }

    return $res;
}

function format_fecha($fecha, $op) {

    $fecha = new DateTime($fecha);

    $meses = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

    if($op == "defuncion") {

        $dia = date_format($fecha, "j");
        $mes = $meses[date_format($fecha, "n")];
        $anio = date_format($fecha, "Y");

        $txt = "$dia de $mes del $anio";            // Ej: 19 de Abril del 2018

    } else if($op == "entierro") {

        $mes = $meses[date_format($fecha, "n")];
        $dia_num = date_format($fecha, "j");
        $dia_txt = date_format($fecha, "D");
        if($dia_txt == "Mon") $dia_txt = "Lunes";
        else if($dia_txt == "Tue") $dia_txt = "Martes";
        else if($dia_txt == "Wed") $dia_txt = "Miercoles";
        else if($dia_txt == "Thu") $dia_txt = "Jueves";
        else if($dia_txt == "Fri") $dia_txt = "Viernes";
        else if($dia_txt == "Sat") $dia_txt = "Sábado";
        else if($dia_txt == "Sun") $dia_txt = "Domingo";

        $txt = "$dia_txt $dia_num de $mes ";            // Ej: Viernes 6 de Abril
    }

    return $txt;
}
function format_hora($date) {

    $date = new DateTime($date);

    $hora = date_format($date, "g");
    $min = date_format($date, "i");
    $meridiem = date_format($date, "a");

    $meridiem = ($meridiem == "am") ? "Mañana" : "Tarde";
    $txt = "$hora:$min de la $meridiem";        // Ej: 3:15 de la Tarde

    return $txt;
}

function format_edad($date) {

    $anio_act = new DateTime();
    $anio_nacimiento = new DateTime($date);

    $anio_act = date_format($anio_act, "Y");
    $anio_nacimiento = date_format($anio_nacimiento, "Y");

    $edad = $anio_act - $anio_nacimiento;

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($edad, TRUE).PHP_EOL, FILE_APPEND );

    return $edad;

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
