<?php

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$ref = $_GET['ref'];
$miga = $_GET['miga'];

$estructura = [];

if($miga == "") {             // NAVEGACION

    $modulo = "difunto_facturas";
    $identificadores = $ApiClient->select($modulo);

//     Construimos la estructura a mostrar ( DIFUNTO - SERVICIO - CLIENTE - DIFUNTO_FACTURAS )
    foreach ($identificadores as $ids) {

        $id_dif = $ids->id_dif;

        $modulo = "difunto";
        $cond = "id='$id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $modulo = "difunto_cliente";
        $cond = "id_dif='$id_dif'";
        $rel_dif_cli = $ApiClient->select($modulo, $cond);

        $modulo = "cliente";
        $id_cli = $rel_dif_cli[0]->id_cli;
        $cond = "id='$id_cli'";
        $cliente = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "nombre_difunto" => $difunto[0]->nombre,
            "nombre_cliente" => $cliente[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "fecha_factura" => $ids->fecha,
            "total" => $ids->total,
        ];

        array_push($estructura, $aux);
    }

} else if($miga === "cliente") {        // CLIENTE

    $id_cli = $ref;

    $modulo = "difunto_cliente";
    $cond = "id_cli='$id_cli'";
    $rel_dif_cli = $ApiClient->select($modulo, $cond);

    $identificadores = [];
    foreach ($rel_dif_cli as $datos) {
        $id_dif = $datos->id_dif;
        $modulo = "difunto_facturas";
        $cond = "id_dif='$id_dif'";
        $idss = $ApiClient->select($modulo, $cond);

        array_push($identificadores, $idss[0]);
    }

    // Construimos la estructura a mostrar ( DIFUNTO - SERVICIO - CLIENTE - DIFUNTO_FACTURAS )
    foreach ($identificadores as $ids) {

        $id_dif = $ids->id_dif;

        $modulo = "difunto";
        $cond = "id='$id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $modulo = "difunto_cliente";
        $cond = "id_dif='$id_dif'";
        $rel_dif_cli = $ApiClient->select($modulo, $cond);

        $modulo = "cliente";
        $id_cli = $rel_dif_cli[0]->id_cli;
        $cond = "id='$id_cli'";
        $cliente = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "nombre_difunto" => $difunto[0]->nombre,
            "nombre_cliente" => $cliente[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "fecha_factura" => $ids->fecha,
            "total" => $ids->total,
        ];

        array_push($estructura, $aux);
    }

}
?>

<div class="container-fluid">
    <div class="row page_header">
        <h1 class="col-md-3">Facturas</h1>
        <div class="col-md-2 col-md-offset-1">
            <a href="main.php?op=nuevaFactura">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nueva Factura</button>
            </a>
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
                                <th>Nombre Difunto</th>
                                <th>Nombre Cliente</th>
                                <th>Fecha Defuncion</th>
                                <th>Fecha Factura</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($estructura as $datos) { ?>
                                <tr>
                                    <td class="iconos_td">
                                        <a href="./main.php?op=v_factura&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=e_factura&ref=<?= $datos['id_dif'] ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                        <a href="./plantillaFactura.php?ref=<?= $datos['id_dif'] ?>" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                    </td>
                                    <td class="id_td"><?= $datos['id_dif']; ?></td>
                                    <td><?= $datos['nombre_difunto']; ?></td>
                                    <td><?= $datos['nombre_cliente']; ?></td>
                                    <td><?= $datos['fecha_defuncion']; ?></td>
                                    <td><?= $datos['fecha_factura']; ?></td>
                                    <td><?= $datos['total']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!-- container-fluid -->
