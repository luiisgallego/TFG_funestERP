<?php
$ref = $_GET['ref'];
$difunto = $ApiClient->select("difunto", "id='$ref'");
$difunto = $difunto[0];

$servicio = $ApiClient->select("servicio", "id_dif='$difunto->id'");
$hayServicio = false;
if(!empty($servicio)) {
    $servicio = $servicio[0];
    $hayServicio = true;
}
?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="updateDifunto" />
        <?php if(!$hayServicio) { ?>
            <input type="hidden" name="aniadirServicio" value="true" />
        <?php } ?>

        <div class="row page_header">
            <div class="col-md-2"><h1>Defunción:</h1></div>
            <div class="col-md-10 alinear_nav">
                <div class="row">
                    <div class="col-md-5"><h4><?= $difunto->nombre ?></h4></div>
                    <div class="col-md-2"><input type="submit" class="btn btn-primary btn-block" value="Guardar"></div>
                    <div class="col-md-5">
                        <nav>
                            <ul class="nav nav-tabs">
                                <li class="espaciar_nav" role="presentation" >
                                    <a href="main.php?op=v_defuncion&ref=<?= $difunto->id ?>">Ver</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="main.php?op=v_cliente&miga=difunto&ref=<?= $difunto->id ?>">Cliente</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../documentos/main.php?op=v_esquela&ref=<?= $difunto->id ?>">Esquela</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../contabilidad/main.php?op=v_factura&ref=<?= $difunto->id ?>">Factura</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- row page_header -->

        <div class="row page_content">
            <div class="col-md-12">

                <div class="difunto"> <?php include('../formularios/form_difunto.php'); ?> </div>
<!--                --><?php //if($hayServicio) { ?>
                    <div class="servicio"> <?php include('../formularios/form_servicio.php'); // S ?> </div>
<!--                --><?php //} ?>

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Guardar">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
