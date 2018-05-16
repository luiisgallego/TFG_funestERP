<?php
@session_start();
require '../config/API_Global.php';
include_once('func_procesa.php');
//error_reporting(E_ERROR | E_PARSE);

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($_POST, TRUE).PHP_EOL, FILE_APPEND );

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
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos la INSERCION del DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";

//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

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

            // Preparamos la INSERCION del CLIENTE y relacion DIFUNTO - CLIENTE
            $datos_cliente = $json->cliente;

            if(!compruebaVacio($datos_cliente)) {

                // Primero insertamos el cliente
                $modulo = "cliente";
                if(!$ApiClient->insert($datos_cliente, $modulo)) redirige("index.php");

                // Ahora creamos relacion con difunto
                $cond = "nombre='$datos_cliente->nombre'";
                $campos = "id";
                $id_cliente = $ApiClient->select($modulo, $cond, $campos);
                $difunto_cliente = [
                    "id_dif" => $id_difunto,
                    "id_cli" => $id_cliente[0]->id
                ];

                // Insertamos la relacion
                $modulo = "difunto_cliente";
                if(!$ApiClient->insert($difunto_cliente, $modulo)) redirige("index.php");
            }

            // Preparamos la INSERCION de los FAMILIARES
//            $modulo = "familiares";
//            $datos_familiares = $json->familiares;
//            $datos_familiares->id_dif = $id_difunto;
//            if(!$ApiClient->insert($datos_familiares, $modulo)) redirige("index.php");

            // Si el proceso ha ido bien
            redirige("modulos/servicios/main.php?op=v_defuncion&ref=$id_difunto");

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
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos el UPDATE del DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";
        $cond = "id='$datos_difunto->id'";

        if($ApiClient->update($datos_difunto, $modulo, $cond)) {

            // Tenemos que diferenciar entre UPDATE o INSERT
            if($aniadirServicio) {      // INSERT

                // Preparamos la INSERCION del SERVICIO
                $datos_servicio = $json->servicio;
                $excepciones = ["tanatorio", "tipo_servicio", "compañia"];

                if(!compruebaVacio($datos_servicio, $excepciones)) {

                    $datos_servicio->id_dif = $datos_difunto->id;
                    $modulo = "servicio";

                    if($ApiClient->insert($datos_servicio, $modulo)) redirige("modulos/servicios/main.php?op=v_defuncion&ref=$datos_difunto->id");
                    else redirige("index.php");
                }
            } else {                    // UPDATE

                // Preparamos el UPDATE del SERVICIO
                $datos_servicio = $json->servicio;
                $modulo = "servicio";
                $cond = "id='$datos_servicio->id'";

                if($ApiClient->update($datos_servicio, $modulo, $cond)) redirige("modulos/servicios/main.php?op=v_defuncion&ref=$datos_difunto->id");
                else redirige("index.php");
            }
        } else redirige("index.php");
    }

} else if($op == "nuevoCliente") {

    $datos = $_POST;
    unset($datos['op']);
    unset($datos['nuevoCliente']); // Valor de la busqueda del difunto

    if(!empty($datos) && $datos['c_nombre'] !== "") {

        // Adaptamos los datos correctamente
        $id_dif = $datos['c_id_dif'];
        unset($datos['c_id_dif']);
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos la INSERCION del CLIENTE
        $datos_cliente = $json->cliente;
        $modulo = "cliente";

        if ($ApiClient->insert($datos_cliente, $modulo)) {

            // Obtenemos el ID del CLIENTE
            $cond = "nombre='$datos_cliente->nombre'";
            $campos = "id";
            $id_cliente = $ApiClient->select($modulo, $cond, $campos);
            $id_cliente = $id_cliente[0]->id;

            // Creamos la relacion SERVICIO - CLIENTE
            $datos_relacion = [
                "id_dif" => $id_dif,
                "id_cli" => $id_cliente
            ];
            $modulo = "difunto_cliente";

            if ($ApiClient->insert($datos_relacion, $modulo)) redirige("modulos/servicios/main.php?op=v_cliente&miga=cliente&ref=$id_cliente");
            else redirige("index.php");

        } else redirige("index.php");
    } else redirige("index.php");

} else if($op == "buscarDifunto") {

    $nom = $_POST['nombreDifunto'];

    // Obtenemos los datos del posible/s DIFUNTO
    $modulo = "difunto";
    $cond = "nombre LIKE '%$nom%'";
    $campos = "*";
    $res = $ApiClient->select($modulo, $cond, $campos);

    echo json_encode($res);

} else if($op == "updateCliente") {

    $datos = $_POST;
    unset($datos['op']);

    if(!empty($datos) && $datos['c_nombre'] !== "") {
        
        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos el UPDATE del CLIENTE
        $datos_cliente = $json->cliente;
        $modulo = "cliente";
        $cond = "id='$datos_cliente->id'";

        if($ApiClient->update($datos_cliente, $modulo, $cond))  redirige("modulos/servicios/main.php?op=v_cliente&ref=$datos_cliente->id");
        else redirige("index.php");

    } else redirige("index.php");

} else if($op == "nuevaEsquela") {

    $datos = $_POST;
    unset($datos['op']);
    unset($datos['nuevaEsquela']); // Valor de la busqueda del difunto

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

    if(!empty($datos)) {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos la INSERCION del PAR FAMILIARES
        /* Hay que insertar cada para 1 a 1, generando para cada uno la estructura de inserción */
        $datos_familiares = $json->familiares;
        $id_dif = $datos_familiares->id_dif;
        unset($datos_familiares->id_dif);

        $datos_familiares = ajustarFamiliares($datos_familiares);
//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos_familiares, TRUE).PHP_EOL, FILE_APPEND );

        /* Primero hay que generar la relacion DIFUNTO - FAMILIAR */
        $datos_relacion = [
            "id_dif" => $id_dif
        ];
        $modulo = "difunto_familiares";
        if(!$ApiClient->insert($datos_relacion, $modulo)) redirige("index.php");

        // Ahora obtenemos el ID para guardar en la segunda tabla
        $cond = "id_dif='$id_dif'";
        $campos = "id_fam";
        $id_fam = $ApiClient->select($modulo, $cond, $campos);
//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($id_fam, TRUE).PHP_EOL, FILE_APPEND );
        $id_fam = $id_fam[0]->id_fam;

        /* AÑADIR COMPROBACIÓN:
            Si id_dif existe en la tabla de DIFUNTO_FAMILIARES, no añadir */

        $i = 0;
        $modulo = "familiares";
        while(count($datos_familiares) > $i) {

            $aux = [
                "id_fam" => $id_fam,
                "rol" => $datos_familiares[$i],
                "nombres" => $datos_familiares[$i+1]
            ];

            if(!$ApiClient->insert($aux, $modulo)) redirige("index.php");
            $i = $i+2;
        }

        /* Las esquelas las mostramos en función del difunto */
        redirige("modulos/documentos/main.php?op=v_esquela&ref=$id_dif");
    }

} else if($op == "updateEsquela") {
    // ONLY UPDATE

    $datos = $_POST;
    unset($datos['op']);

    if(!empty($datos)) {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));
        file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

        // 1º UPDATE FAMILIARES
        // Los ID necesarios vienen con los formularios desde la edición.
        $datos_familiares = $json->familiares;
        $id_dif = $datos_familiares->id_dif;
        unset($datos_familiares->id_dif);
        $id_fam = $datos_familiares->id_fam;
        unset($datos_familiares->id_fam);

        $datos_familiares = ajustarFamiliares($datos_familiares);
//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($id_fam, TRUE).PHP_EOL, FILE_APPEND );

        // Para actualizar, primero borrarmos y luego insertamos de nuevo
        $modulo = "familiares";
        $cond = "id_fam='$id_fam'";
        if(!$ApiClient->delete($modulo, $cond)) redirige("index.php");

        $i = 0;     // Ahora guardamos de nuevo
        while(count($datos_familiares) > $i) {

            $aux = [
                "id_fam" => $id_fam,
                "rol" => $datos_familiares[$i],
                "nombres" => $datos_familiares[$i+1]
            ];

            if(!$ApiClient->insert($aux, $modulo)) redirige("index.php");
            $i = $i+2;
        }

        // 2º UPDATE DIFUNTO
        // Preparamos el UPDATE del DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";
        $cond = "id='$datos_difunto->id'";

        if(!$ApiClient->update($datos_difunto, $modulo, $cond)) redirige("index.php");

        // 3º UPDATE SERVICIO
        // Preparamos el UPDATE del SERVICIO
        $datos_servicio = $json->servicio;
        $modulo = "servicio";
        $cond = "id='$datos_servicio->id'";

        if(!$ApiClient->update($datos_servicio, $modulo, $cond)) redirige("index.php");

        redirige("modulos/documentos/main.php?op=v_esquela&ref=$id_dif");
    }

}

?>
