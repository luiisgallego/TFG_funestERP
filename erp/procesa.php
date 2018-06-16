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

    if($ApiClient->login($user, $pass)) redirige("index.php");
    else redirige("login.php");

} else if($op == "logout") {

//    $ApiClient->logout();
    $_SESSION['login_info'] = null;
    header("Location: http://localhost/funerariagallego/erp/login.php");

} else if($op == "registrarUser") {

    $datos = $_POST;
    unset($datos['op']);

    if($datos['nombre'] != "" && $datos['pass'] !=  ""){

        $datos['pass'] = md5($datos['pass']);

        $modulo = "usuarios";
        if(!$ApiClient->insert($datos, $modulo)) echo "error";

    } else echo "error";

    echo 1;

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

                if(!$ApiClient->insert($datos_servicio, $modulo)) echo "error";
            }

            // Preparamos la INSERCION del CLIENTE y relacion DIFUNTO - CLIENTE
            $datos_cliente = $json->cliente;

            if(!compruebaVacio($datos_cliente)) {

                // Primero insertamos el cliente
                $modulo = "cliente";
                if(!$ApiClient->insert($datos_cliente, $modulo)) echo "error";

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
                if(!$ApiClient->insert($difunto_cliente, $modulo)) echo "error";
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
                if(!$ApiClient->insert($datos_relacion, $modulo)) echo "error";

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

                    if(!$ApiClient->insert($aux, $modulo)) echo "error";
                    $i = $i+2;
                }
            }

            echo "modulos/servicios/main.php?op=v_defuncion&ref=$id_difunto";

        } else echo "error";
    } else echo "error";

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

} else if($op == "deleteDifunto") {

    $id = $_POST['id'];

    // Borramos la relacion DIFUNTO - SERVICIO
    $modulo = "servicio";
    $cond = "id_dif='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos la relacion DIFUNTO - CLIENTE
    $modulo = "difunto_cliente";
    $cond = "id_dif='$id'";
    $cliente = $ApiClient->select($modulo, $cond);
    $id_cli = $cliente[0]->id_cli;

    $modulo = "difunto_cliente";
    $cond = "id_dif='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    if($id_cli != ""){
        $modulo = "cliente";
        $cond = "id='$id_cli'";
        if(!$ApiClient->delete($modulo, $cond)) echo "error";
    }

    // Borramos la relacion DIFUNTO - FAMILIARES
    $modulo = "difunto_familiares";
    $cond = "id_dif='$id'";
    $familiares = $ApiClient->select($modulo, $cond);
    $id_fam = $familiares[0]->id_fam;

    if($id_fam != ""){
        $modulo = "familiares";
        $cond = "id_fam='$id_fam'";
        if(!$ApiClient->delete($modulo, $cond)) echo "error";
    }

    $modulo = "difunto_familiares";
    $cond = "id_dif='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos la relacion DIFUNTO - FACTURAS
    $modulo = "difunto_facturas";
    $cond = "id_dif='$id'";
    $facturas = $ApiClient->select($modulo, $cond);
    $id_fact = $facturas[0]->id_fact;

    if($id_fact != ""){
        $modulo = "facturas";
        $cond = "id_fact='$id_fact'";
        if(!$ApiClient->delete($modulo, $cond)) echo "error";
    }

    $modulo = "difunto_facturas";
    $cond = "id_dif='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos el DIFUNTO
    $modulo = "difunto";
    $cond = "id='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    echo 1;

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

            if ($ApiClient->insert($datos_relacion, $modulo)) echo "modulos/servicios/main.php?op=v_cliente&miga=cliente&ref=$id_cliente";
            else echo "error";

        } else echo "error";
    } else echo "error";

} else if($op == "buscarDifunto_Disponible") {

    $nom = $_POST['nombreDifunto'];
    $mod = $_POST['modulo'];

    // Obtenemos los  DIFUNTO
    $modulo = "difunto";

    if($nom != "") {

        $cond = "nombre LIKE '%$nom%'";
        $res = $ApiClient->select($modulo, $cond);

    } else $res = $ApiClient->select($modulo);

    $res_final = [];
    foreach ($res as $resultado) {

        $modulo = $mod;
        $id_dif = $resultado->id;
        $cond = "id_dif = $id_dif";
        $campos = "*";
        $aux = $ApiClient->select($modulo, $cond, $campos);

        if(empty($aux))  array_push($res_final, $resultado);
    }

    echo json_encode($res_final);

} else if($op == "cliente_difunto") {

    $datos = $_POST;

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

} else if($op == "deleteCliente") {

    $id = $_POST['id'];

    // Primero borramos la relacion DIFUNTO - CLIENTE
    $modulo = "difunto_cliente";
    $cond = "id_cli='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos el cliente
    $modulo = "cliente";
    $cond = "id='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    echo 1;

} else if($op == "nuevaEsquela") {

    $datos = $_POST;
    unset($datos['op']);
    unset($datos['nuevaEsquela2']); // Valor de la busqueda del difunto

    if($datos['f_rol_1'] != "" && $datos['f_nombres_1'] != "") {

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
        if(!$ApiClient->insert($datos_relacion, $modulo)) echo "error";

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

            if(!$ApiClient->insert($aux, $modulo)) echo "error";
            $i = $i+2;
        }

        /* Las esquelas las mostramos en función del difunto */
        echo "modulos/documentos/main.php?op=v_esquela&ref=$id_dif";

    } else echo "error";

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

} else if($op == "deleteDocs") {

    $id = $_POST['id'];

    // Borramos los familiares
    $modulo = "familiares";
    $cond = "id_fam='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos la relacion DIFUNTO - FAMILIARES
    $modulo = "difunto_familiares";
    $cond = "id_fam='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    echo 1;

} else if($op == "setEstadoEsqMisa") {

    $id_fam = $_POST['id_fam'];
    $estado = $_POST['estado'];

    if($estado == "esquela_emitida") {

        $datos = [
            "id_fam" => $id_fam,
            "esquela_emitida" => 1,
        ];
    }
    if($estado == "misa_emitida") {

        $datos = [
            "id_fam" => $id_fam,
            "misa_emitida" => 1
        ];
    }
    $modulo = "difunto_familiares";
    $cond = "id_fam='$id_fam'";
    if(!$ApiClient->update($datos, $modulo, $cond)) echo 0;

    echo 1;

} else if($op == "setEstadoRecordatoria") {

    $id_fam = $_POST['id_fam'];
    $estado = $_POST['estado'];

    if($estado == "emitida") {

        $datos = [
            "id_fam" => $id_fam,
            "recordatoria_emitida" => 1,
        ];
    }
    $modulo = "difunto_familiares";
    $cond = "id_fam='$id_fam'";
    if(!$ApiClient->update($datos, $modulo, $cond)) echo 0;

    echo 1;

} else if($op == "nuevaFactura") {

    $datos = $_POST;
    unset($datos['op']);
    unset($datos['nuevaFactura']); // Valor de la busqueda del difunto

    if($datos['t_concepto_1'] != "" && $datos['t_importe_1'] != "") {

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
        if(!$ApiClient->insert($datos_relacion, $modulo)) echo "error";

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

            if(!$ApiClient->insert($aux, $modulo)) echo "error";

            $importe_total += $datos_factura[$i+1];
            $i = $i+2;
        }

        // Actualizamos el TOTAL de la FACTURA
        $datos_relacion['total'] = $importe_total;
        $modulo = "difunto_facturas";
        $cond = "id_dif='$id_dif'";
        if(!$ApiClient->update($datos_relacion, $modulo, $cond))  echo "error";

        echo "modulos/contabilidad/main.php?op=v_factura&ref=$id_dif";

    } else echo "error";

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

        redirige("modulos/contabilidad/main.php?op=v_factura&ref=$id_dif");
    }

} else if($op == "deleteFactura") {

    $id = $_POST['id'];

    // Borramos la factura
    $modulo = "facturas";
    $cond = "id_fact='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    // Borramos la relacion DIFUNTO - FACTURAS
    $modulo = "difunto_facturas";
    $cond = "id_fact='$id'";
    if(!$ApiClient->delete($modulo, $cond)) echo "error";

    echo 1;

} else if($op == "setEstadoFactura") {

    $id_fact = $_POST['id_fact'];
    $estado = $_POST['estado'];

    if($estado == "emitida") {

        $datos = [
            "id_fact" => $id_fact,
            "emitida" => 1,
        ];
    }
    if($estado == "cobrada") {

        $datos = [
            "id_fact" => $id_fact,
            "cobrada" => 1
        ];
    }
    $modulo = "difunto_facturas";
    $cond = "id_fact='$id_fact'";
    if(!$ApiClient->update($datos, $modulo, $cond)) echo 0;

    echo 1;

} else if($op == "ag_addEvent") {

    $datos = $_POST;
    unset($datos['op']);

    $modulo = "agenda";
    if(!$ApiClient->insert($datos, $modulo)) redirige("index.php");

    echo 1;

} else if($op == "ag_getEvents") {

    $modulo = "agenda";
    $campos = "title, start, allDay";
    $info = $ApiClient->select($modulo,null, $campos);

    echo json_encode($info);

}

?>
