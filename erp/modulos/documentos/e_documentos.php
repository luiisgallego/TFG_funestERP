<?php
$ref = $_GET['ref'];
$miga = $_GET['miga'];
$estructura = null;

if($miga === "esquela" || $miga === "recordatoria") {       // ESQUELA

    $id_dif = $ref;
    $pagina = ($op === "esquelas") ? "Esquelas" : "Recordatorias";

    // Necesito una estructura con DIFUNTO - SERVICIO - FAMILIARES

    $modulo = "difunto";
    $cond = "id='$id_dif'";
    $difunto = $ApiClient->select($modulo, $cond);

    $modulo = "servicio";
    $cond = "id_dif='$id_dif'";
    $servicio = $ApiClient->select($modulo, $cond);

    $modulo = "difunto_familiares";
    $cond = "id_dif='$id_dif'";
    $relacion = $ApiClient->select($modulo, $cond);

    $modulo = "familiares";
    $id_fam = $relacion[0]->id_fam;
    $cond = "id_fam='$id_fam'";
    $familiares = $ApiClient->select($modulo, $cond);

    $estructura = [
        "difunto" => $difunto[0],
        "servicio" => $servicio[0],
        "familiares" => $familiares,
        "id_fam" => $id_fam
    ];

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($estructura, TRUE).PHP_EOL, FILE_APPEND );
}
?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="updateDocumentos" />
        <input type="hidden" name="miga" value="<?= $miga ?>" />

        <div class="row page_header">
            <div class="col-md-2"><h1><?= $pagina ?>:</h1></div>
            <div class="col-md-10 alinear_nav">
                <div class="row">
                    <div class="col-md-5"><h4><?= $estructura['difunto']->nombre ?></h4></div>
                    <div class="col-md-2"><input type="submit" class="btn btn-primary btn-block" value="Guardar"></div>
                    <div class="col-md-5">
                        <nav>
                            <ul class="nav nav-tabs">
                                <li class="espaciar_nav" role="presentation">
                                    <a href="main.php?op=v_esquela&ref=<?= $estructura['difunto']->id ?>">Ver</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../servicios/main.php?op=v_difunto&ref=<?= $estructura['difunto']->id ?>">Difunto</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../servicios/main.php?op=v_cliente&miga=docs&ref=<?= $estructura['difunto']->id ?>">Cliente</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../contabilidad/main.php?op=v_factura&miga=docs&ref=<?= $estructura['difunto']->id ?>">Factura</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- row page_header -->

        <div class="row page_content">
            <div class="col-md-12">

                <div class="familiares"> <?php  include('../formularios/form_familiares.php'); ?> </div>
                <div class="difunto"> <?php include('../formularios/form_difunto.php'); ?> </div>
                <div class="servicio"> <?php include('../formularios/form_servicio.php'); // S ?> </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Guardar">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
