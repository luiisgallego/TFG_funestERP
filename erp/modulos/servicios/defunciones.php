<?php

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$miga = $_GET['miga'];

$defunciones = [];
if($miga == "") {     // DIFUNTO
    $defunciones = $ApiClient->select("difunto");
} else {

    $miga = $_GET['miga'];
    $ref = $_GET['ref'];

    if($miga === "cliente"){    // CLIENTE

        // Consultamos los DIFUNTOS asociados al CLIENTE
        $modulo = "difunto_cliente";
        $cond = "id_cli='$ref'";
        $difuntosCliente = $ApiClient->select($modulo, $cond);

        // Tomamos los datos de cada DIFUNTO
        foreach ($difuntosCliente as $par) {
            $modulo = "difunto";
            $cond = "id='$par->id_dif'";
            $aux = $ApiClient->select($modulo, $cond);
            array_push($defunciones, $aux[0]);
        }
    }
}

/* Creamos union de datos DIFUNTO - SERVICIO para tabla */
$serv = [];
foreach ($defunciones as $def) {
    $servicio = $ApiClient->select("servicio", "id_dif='$def->id'");

    if(!empty($servicio)) $serv[$def->id] = $servicio[0];
    else $serv[$def->id] = (object)["tipo_servicio" => "", "tanatorio" => "", "fecha_defuncion" => ""];
}

?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1>Defunciones</h1></div>
        <div class="col-md-2 col-md-offset-1">
            <a href="main.php?op=nuevoServicio">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nuevo Servicio</button>
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
                    <!-- *************** BUSCADOR **************** -->
<!--                    <div class="row busqueda" >-->
<!--                        <div class="col-md-8 col-md-offset-4">-->
<!--                            <form class="navbar-form" role="search" method="post">-->
<!--                                <div class="form-group col-md-8">-->
<!--                                    <input type="text" class="form-control" name="nuevoCliente" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">-->
<!--                                </div>-->
<!--                            </form>-->
<!--                            <div  style="margin-top: 50px;"></div>-->
<!--                        </div>-->
<!--                    </div> <!-- busqueda -->
                    <!-- *************** FIN BUSCADOR **************** -->
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha Defuncion</th>
                                <th>Tanatorio</th>
                                <th>Población</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($defunciones as $def){ ?>
                                <tr>
                                    <td class="iconos_td_defunciones">
                                        <a href="./main.php?op=v_defuncion&ref=<?= $def->id ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=e_defuncion&ref=<?= $def->id ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
<!--                                        <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>-->
                                        <a href="#" title="Borrar"><i class="fa fa-trash fa-fw iconos_a"></i></a>
                                    </td>
                                    <td class="id_td"><?=  $def->id; ?></td>
                                    <td><?= $def->nombre; ?></td>
                                    <td><?= $serv[$def->id]->tipo_servicio; ?></td>
                                    <td><?= $serv[$def->id]->fecha_defuncion; ?></td>
                                    <td><?= $serv[$def->id]->tanatorio; ?></td>
                                    <td><?= $def->poblacion; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!-- container-fluid -->
