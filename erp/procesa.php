<?php
@session_start();
require '../config/API_Global.php';
include_once('funciones.php');
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

            // Preparamos la INSERCION de los FAMILIARES y relacion DIFUNTO - FAMILIAR
            $datos_familiares = $json->familiares;

            if(!compruebaVacio($datos_familiares)) {

                $datos_familiares = ajustarFam_Fact($datos_familiares);

                /* Primero hay que generar la relacion DIFUNTO - FAMILIAR */
                $datos_relacion = [
                    "id_dif" => $id_difunto,
                    "esquela" => "1",
                    "r_misa" => "1"
                ];
                $modulo = "difunto_familiares";
                if(!$ApiClient->insert($datos_relacion, $modulo)) redirige("index.php");

                // Ahora obtenemos el ID para guardar en la segunda tabla
                $cond = "id_dif='$id_difunto'";
                $campos = "id_fam";
                $id_fam = $ApiClient->select($modulo, $cond, $campos);
                $id_fam = $id_fam[0]->id_fam;

                /* AÑADIR RESTRICCIÓN:
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
            }

            // Si el proceso ha ido bien
            redirige("modulos/servicios/main.php?op=v_defuncion&ref=$id_difunto");
//            return;

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

} else if($op == "buscarDifunto_Limitado") {

    $nom = $_POST['nombreDifunto'];

    // Obtenemos los datos del posible/s DIFUNTO
    $modulo = "difunto";
    $cond = "nombre LIKE '%$nom%'";
    $campos = "*";
    $res = $ApiClient->select($modulo, $cond, $campos);

    $res_final = [];
    foreach ($res as $resultado) {

        $modulo = "difunto_cliente";
        $id_dif = $resultado->id;
        $cond = "id_dif = $id_dif";
        $campos = "*";
        $aux = $ApiClient->select($modulo, $cond, $campos);

        if(empty($aux))  array_push($res_final, $resultado);
    }

    echo json_encode($res_final);

} else if($op == "cliente_difunto") {

    $datos = $_POST;

    file_put_contents(__DIR__ . "/SOMELOG.log", print_r($datos, TRUE) . PHP_EOL, FILE_APPEND);

    $modulo = "difunto_cliente";
    $aux = [
        "id_dif" => $datos['id_dif'],
        "id_cli" => $datos['id_cli'],
    ];

    if($ApiClient->insert($aux, $modulo)) echo 1;
    else echo 0;

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

    if(!empty($datos)) {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos la INSERCION del PAR FAMILIARES
        /* Hay que insertar cada par 1 a 1, generando para cada uno la estructura de inserción */
        $datos_familiares = $json->familiares;
        $id_dif = $datos_familiares->id_dif;
        unset($datos_familiares->id_dif);

        $datos_familiares = ajustarFam_Fact($datos_familiares);

        /* Primero hay que generar la relacion DIFUNTO - FAMILIAR */
        $datos_relacion = [
            "id_dif" => $id_dif,
            "esquela" => "1",
            "r_misa" => "1"
        ];
        $modulo = "difunto_familiares";
        if(!$ApiClient->insert($datos_relacion, $modulo)) redirige("index.php");

        // Ahora obtenemos el ID para guardar en la segunda tabla
        $cond = "id_dif='$id_dif'";
        $campos = "id_fam";
        $id_fam = $ApiClient->select($modulo, $cond, $campos);
        $id_fam = $id_fam[0]->id_fam;

        /* AÑADIR RESTRICCIÓN:
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

} else if($op == "updateDocumentos") {
    // ONLY UPDATE

    $datos = $_POST;
    $miga = $datos['miga'];
    unset($datos['op']);
    unset($datos['miga']);

    if(!empty($datos)) {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // 1º UPDATE FAMILIARES
        // Los ID necesarios vienen con los formularios desde la edición.
        $datos_familiares = $json->familiares;
        $id_dif = $datos_familiares->id_dif;
        unset($datos_familiares->id_dif);
        $id_fam = $datos_familiares->id_fam;
        unset($datos_familiares->id_fam);

        $datos_familiares = ajustarFam_Fact($datos_familiares);

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

        $dir = ($miga === "esquela") ? "v_esquela" : "v_recordatoria";
        redirige("modulos/documentos/main.php?op=$dir&ref=$id_dif");
    }

} else if($op == "nuevoDocs") {

    file_put_contents (__DIR__."/SOMELOG.log" , print_r("DENTRO", TRUE).PHP_EOL, FILE_APPEND );
    $datos = $_POST;
    file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

//    return json_encode($datos);
//    return "hola

    $res = [
        "datos" => "probando"
    ];

    echo "hola";

} else if($op == "nuevaFactura") {

    $datos = $_POST;
    unset($datos['op']);
    unset($datos['nuevaFactura']); // Valor de la busqueda del difunto

    if(!empty($datos)) {

        // Adaptamos los datos correctamente
        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // Preparamos la INSERCION del PAR FACTURAS
        /* Hay que insertar cada par 1 a 1, generando para cada uno la estructura de inserción */
        $datos_factura = $json->facturas;
        $id_dif = $datos_factura->id_dif;
        unset($datos_factura->id_dif);

        $datos_factura = ajustarFam_Fact($datos_factura);

        /* Primero hay que generar la relacion DIFUNTO - FACTURAS */
        $fecha = date('Y-m-d');
        $datos_relacion = [
            "id_dif" => $id_dif,
            "fecha" => $fecha,
            "total" => "0"
        ];
        $modulo = "difunto_facturas";
        if(!$ApiClient->insert($datos_relacion, $modulo)) redirige("index.php");

        // Ahora obtenemos el ID para guardar en la segunda tabla
        $cond = "id_dif='$id_dif'";
        $campos = "id_fact";
        $id_fact = $ApiClient->select($modulo, $cond, $campos);
        $id_fact = $id_fact[0]->id_fact;

        /* AÑADIR RESTRICCIÓN:
            Si id_dif existe en la tabla de DIFUNTO_FAMILIARES, no añadir */

        $i = 0;
        $importe_total = 0;
        $modulo = "facturas";
        while(count($datos_factura) > $i) {

            $aux = [
                "id_fact" => $id_fact,
                "concepto" => $datos_factura[$i],
                "importe" => $datos_factura[$i+1]
            ];

            if(!$ApiClient->insert($aux, $modulo)) redirige("index.php");

            $importe_total += $datos_factura[$i+1];
            $i = $i+2;
        }

        // Actualizamos el TOTAL de la FACTURA
        $datos_relacion['total'] = $importe_total;
        $modulo = "difunto_facturas";
        $cond = "id_dif='$id_dif'";
        if(!$ApiClient->update($datos_relacion, $modulo, $cond))  redirige("index.php");

        redirige("modulos/contabilidad/main.php?op=v_factura&ref=$id_dif");
    }

} else if($op == "updateFacturas") {

    $datos = $_POST;
    unset($datos['op']);

    if(!empty($datos)) {

        $datos = json_encode($datos);
        $json = json_decode(construyeJSON_Datos($datos));

        // 1º UPDATE FACTURAS
        // Los ID necesarios vienen con los formularios desde la edición.
        $datos_factura = $json->facturas;
        $id_dif = $datos_factura->id_dif;
        unset($datos_factura->id_dif);
        $id_fact = $datos_factura->id_fact;
        unset($datos_factura->id_fact);

        $datos_factura = ajustarFam_Fact($datos_factura);

        // Para actualizar, primero borrarmos y luego insertamos de nuevo
        $modulo = "facturas";
        $cond = "id_fact='$id_fact'";
        if(!$ApiClient->delete($modulo, $cond)) redirige("index.php");

        $i = 0;     // Ahora guardamos de nuevo
        $importe_total = 0;
        while(count($datos_factura) > $i) {

            $aux = [
                "id_fact" => $id_fact,
                "concepto" => $datos_factura[$i],
                "importe" => $datos_factura[$i+1]
            ];

            if(!$ApiClient->insert($aux, $modulo)) redirige("index.php");

            $importe_total += $datos_factura[$i+1];
            $i = $i+2;
        }

        // Actualizamos el TOTAL de la FACTURA
        $modulo = "difunto_facturas";
        $cond = "id_fact='$id_fact'";
        $datos_relacion['total'] = $importe_total;
        if(!$ApiClient->update($datos_relacion, $modulo, $cond))  redirige("index.php");

        // 2º UPDATE DIFUNTO
        $datos_difunto = $json->difunto;
        $modulo = "difunto";
        $cond = "id='$datos_difunto->id'";
        if(!$ApiClient->update($datos_difunto, $modulo, $cond)) redirige("index.php");

        // 3º UPDATE SERVICIO
        $datos_servicio = $json->servicio;
        $modulo = "servicio";
        $cond = "id='$datos_servicio->id'";
        if(!$ApiClient->update($datos_servicio, $modulo, $cond)) redirige("index.php");

        // 4º UPDATE CLIENTE
        $datos_cliente = $json->cliente;
        $modulo = "cliente";
        $cond = "id='$datos_cliente->id'";
        if(!$ApiClient->update($datos_cliente, $modulo, $cond)) redirige("index.php");


//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($json, TRUE).PHP_EOL, FILE_APPEND );

        redirige("modulos/contabilidad/main.php?op=v_factura&ref=$id_dif");
    }

}

?>
