<?php
$ref = $_GET['ref'];
$miga = $_GET['miga'];
$estructura = null;

if($miga == "") {               // FACTURA

    $id_dif = $ref;

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

    $modulo = "difunto_facturas";
    $cond = "id_dif='$id_dif'";
    $relacion = $ApiClient->select($modulo, $cond);

    $modulo = "facturas";
    $id_fact = $relacion[0]->id_fact;
    $cond = "id_fact='$id_fact'";
    $facturas = $ApiClient->select($modulo, $cond);

    $estructura = [
        "difunto" => $difunto[0],
        "servicio" => $servicio[0],
        "cliente" => $cliente[0],
        "relacion" => $relacion[0],
        "facturas" => $facturas
    ];
}

?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="updateFacturas" />
<!--        <input type="hidden" name="miga" value="--><?//= $miga ?><!--" />-->

        <div class="row page_header">
            <div class="col-md-2"><h1>Factura:</h1></div>
            <div class="col-md-10 alinear_nav">
                <div class="row">
                    <div class="col-md-5"><h4><?= $estructura['difunto']->nombre ?></h4></div>
                    <div class="col-md-2"><input type="submit" class="btn btn-primary btn-block" value="Guardar"></div>
                    <div class="col-md-5">
                        <nav>
                            <ul class="nav nav-tabs">
                                <li class="espaciar_nav" role="presentation">
                                    <a href="main.php?op=v_factura&ref=<?= $estructura['difunto']->id ?>">Ver</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../servicios/main.php?op=v_defuncion&ref=<?= $estructura['difunto']->id ?>">Difunto</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../servicios/main.php?op=v_cliente&miga=factura&ref=<?= $estructura['cliente']->id ?>">Cliente</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../documentos/main.php?op=documentos&miga=factura&ref=<?= $estructura['difunto']->id ?>">Documentos</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- row page_header -->

        <div class="row page_content">
            <div class="col-md-12">

                <div class="familiares"> <?php include('../formularios/form_facturas.php'); ?> </div>
                <div class="difunto"> <?php include('../formularios/form_difunto.php'); ?> </div>
                <div class="servicio"> <?php include('../formularios/form_servicio.php'); // S ?> </div>
                <div class="servicio"> <?php include('../formularios/form_cliente.php'); // S ?> </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Guardar">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->


