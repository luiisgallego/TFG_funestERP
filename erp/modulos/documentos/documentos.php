<?php

/* MOSTRAREMOS ESQUELAS ( MISAS ) Y RECORDATORIAS

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$ref = $_GET['ref'];
$miga = $_GET['miga'];

$estructura = [];
if($miga === "difunto") {       // DIFUNTO

    $id_dif = $ref;

    // Construimos la estructura a mostrar
    $modulo = "difunto";
    $cond = "id='$id_dif'";
    $difunto = $ApiClient->select($modulo, $cond);

    $modulo = "servicio";
    $cond = "id_dif='$id_dif'";
    $servicio = $ApiClient->select($modulo, $cond);

    $aux = [
        "id_dif" => $id_dif,
        "nombre" => $difunto[0]->nombre,
        "fecha_defuncion" => $servicio[0]->fecha_defuncion,
        "poblacion_entierro" => $servicio[0]->poblacion_entierro,
        "tipo_servicio" => $servicio[0]->tipo_servicio,
        "tipo_documento" => "ESQUELA"
    ];

    array_push($estructura, $aux);

    /************* FALTA AÑADIR LAS RECORDATORIAS *******************/

} else if($miga === "cliente") {    // CLIENTE

    $id_cli = $ref;

    // Se puede dar el caso de que el cliente tenga varios
    // DIFUNTOS y por tanto varios DOCUMENTOS

    // Primero buscamos los DIFUNTOS asociados al cliente
    $modulo = "difunto_cliente";
    $cond = "id_cli='$id_cli'";
    $difunto_cliente = $ApiClient->select($modulo, $cond);

    // Para cada difunto construimos la estructura
    foreach ($difunto_cliente as $datos) {

        $id_dif = $datos->id_dif;
        $modulo = "difunto";
        $cond = "id='$id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "nombre" => $difunto[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "poblacion_entierro" => $servicio[0]->poblacion_entierro,
            "tipo_servicio" => $servicio[0]->tipo_servicio,
            "tipo_documento" => "ESQUELA"
        ];

        array_push($estructura, $aux);
    }

    /************* FALTA AÑADIR LAS RECORDATORIAS *******************/
}

//file_put_contents (__DIR__."/SOMELOG.log" , print_r($estructura, TRUE).PHP_EOL, FILE_APPEND );

?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1>Documentos</h1></div>
        <div class="col-md-2 col-md-offset-1">
<!--            <a href="main.php?op=nuevaEsquela">-->
<!--                <button type="button" class="btn btn-primary btn-lg btn-block">Nueva Esquela</button>-->
<!--            </a>-->
        </div>
    </div>

    <div class="row page_content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading info_seccion">
                    <i class="fa fa-caret-square-o-right"></i>Listado
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>TIPO</th>
                                <th>Nombre Difunto</th>
                                <th>Fecha Defuncion</th>
                                <th>Población Entierro</th>
                                <th>Tipo Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($estructura as $datos) {
                                if($datos['tipo_documento'] === "ESQUELA") { ?>
                                    <tr>
                                        <td class="iconos_td">
                                            <a href="./main.php?op=v_esquela&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                            <a href="./main.php?op=v_esquela&misa_funeral=true&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                            <a href="./main.php?op=e_esquela&ref=<?= $datos['id_dif'] ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                            <a href="./plantillaEsquela.php?ref=<?= $datos['id_dif'] ?>" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                            <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                        </td>
                                        <td class="id_td"><?= $datos['id_dif']; ?></td>
                                        <td>ESQUELA</td>
                                        <td><?= $datos['nombre']; ?></td>
                                        <td><?= $datos['fecha_defuncion']; ?></td>
                                        <td><?= $datos['poblacion_entierro']; ?></td>
                                        <td><?= $datos['tipo_servicio']; ?></td>
                                    </tr>
                                <?php } else if($datos->tipo_documento == "RECORDATORIA") {  ?>

                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!-- container-fluid -->
