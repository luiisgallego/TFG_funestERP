<?php

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$estructura = [];
if(!isset($_GET['miga'])) {     // DIFUNTO

    $modulo = "difunto_familiares";
    $identificadores = $ApiClient->select($modulo);

    // Construimos la estructura a mostrar
    foreach ($identificadores as $ids) {

        $modulo = "difunto";
        $cond = "id='$ids->id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $id_dif = $difunto[0]->id;
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "nombre" => $difunto[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "poblacion_entierro" => $servicio[0]->poblacion_entierro,
            "tipo_servicio" => $servicio[0]->tipo_servicio,
        ];

        array_push($estructura, $aux);
    }
}

//file_put_contents (__DIR__."/SOMELOG.log" , print_r($estructura, TRUE).PHP_EOL, FILE_APPEND );

?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1>Esquelas</h1></div>
        <div class="col-md-2 col-md-offset-1">
            <a href="main.php?op=nuevaEsquela">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nueva Esquela</button>
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
                                <th>Fecha Defuncion</th>
                                <th>Población Entierro</th>
                                <th>Tipo Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="iconos_td">
                                    <a href="./main.php?op=v_esquela" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                    <a href="./main.php?op=v_esquela" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                    <a href="./main.php?op=e_esquela" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                    <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                    <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                </td>
                                <td class="id_td">001</td>
                                <td>Nuria Jalon</td>
                                <td>23-Enero-2018</td>
                                <td>DATOS XXX</td>
                                <td>DATOS YYY</td>
                            </tr>
                            <?php foreach($estructura as $datos) { ?>
                                <tr>
                                    <td class="iconos_td">
                                        <a href="./main.php?op=v_esquela&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=v_esquela&misa_funeral=true&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=e_esquela&ref=<?= $datos['id_dif'] ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                        <a href="./plantillaEsquela.php?ref=<?= $datos['id_dif'] ?>" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                        <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                    </td>
                                    <td class="id_td"><?= $datos['id_dif']; ?></td>
                                    <td><?= $datos['nombre']; ?></td>
                                    <td><?= $datos['fecha_defuncion']; ?></td>
                                    <td><?= $datos['poblacion_entierro']; ?></td>
                                    <td><?= $datos['tipo_servicio']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!-- container-fluid -->
