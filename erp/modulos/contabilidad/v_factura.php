<?php

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$ref = $_GET['ref'];
$miga = $_GET['miga'];

$estructura = null;

if($miga == "" || $miga === "difunto" || $miga === "docs") {               // FACTURA || DIFUNTO || DOCUMENTOS

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

}else if($miga === "cliente") {                 // CLIENTE

    $id_cli = $ref;

    $modulo = "cliente";
    $cond = "id='$id_cli'";
    $cliente = $ApiClient->select($modulo, $cond);

    $modulo = "difunto_cliente";
    $cond = "id_cli='$id_cli'";
    $rel_dif_cli = $ApiClient->select($modulo, $cond);
    $id_dif = $rel_dif_cli[0]->id_dif;

    $modulo = "difunto";
    $cond = "id='$id_dif'";
    $difunto = $ApiClient->select($modulo, $cond);

    $modulo = "servicio";
    $cond = "id_dif='$id_dif'";
    $servicio = $ApiClient->select($modulo, $cond);

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

//    file_put_contents (__DIR__."/SOMELOG.log" , print_r($estructura, TRUE).PHP_EOL, FILE_APPEND );
}

?>

<style>
    .body_factura {
        /*background: #f2f2f2;*/
        font-family: Arial;
        font-size: 13px;
        line-height: 1.6;
        color: #444;
    }

    #dina4 {
        width: 210mm;
        height: 297mm;
        padding: 20px 60px; /* Margenes folio */
        border: 1px solid #D2D2D2;
        background: #fff;
        margin: 10px auto;
    }
    .tam_img {
        width: 120px;
        height: 120px;
    }
    .separado_row {
        margin-top: 20px;
    }
    .subrayado {
        text-decoration: underline;
    }
    .desglose_factura {
        min-height: 430px;
    }
</style>

<div class="container-fluid">

    <div class="row border_nav">
        <div class="col-md-2"><h2>Factura:</h2></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4><?= $estructura['difunto']->nombre ?></h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="" role="presentation" >
                            <a href="./plantillaFactura.php?ref=<?= $estructura['difunto']->id ?>"><i class="fa fa-download fa-fw"></i></a>
                        </li>
                        <li class="espaciar_nav" role="presentation" >
                            <a href="main.php?op=e_factura&ref=<?= $estructura['difunto']->id ?>">Editar</a>
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
    </div> <!-- row navegacion -->

    <div class="row body_factura" >
        <div id="dina4">

            <div class="row datos_funeraria" style="margin-top: 20px;">
                <div class="col-md-6">
                    <span style="font-size: 12pt;"><b>TANATORIO - FUNERARIA GALLEGO</b></span><br>
                    <span>LUIS ANT. GALLEGO CESPEDOSA</span><br>
                    <span>C/ CARPINTEROS Nº2</span><br>
                    <span>N.I.F. 25,989,636 - G</span><br>
                    <span>Tlfnos: 953 - 546 - 031 / Móvil: 619 - 350 - 884</span><br>
                    <span>23790 Porcuna ( Jaén )</span>
                </div>
                <div class="col-md-6">
                    <img class="tam_img pull-right" src="../../img/cruz_esquela.jpg">
                    <img class="tam_img pull-right" src="../../img/cruz_esquela.jpg">
                </div>
            </div> <!-- row datos_funeraria -->

            <div class="row datos_cliente separado_row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <span style="background-color: #bfbfbf">CLIENTE</span><br>
                            <span>Nombre:</span><br>
                            <span>Dirección:</span><br>
                            <span>Población:</span><br>
                            <span>C.I.F.</span><br>
                            <span>TLF:</span><br>
                        </div>
                        <div>
                            <span></span><br>
                            <span><?= strtoupper($estructura['cliente']->nombre); ?></span><br>
                            <span><?= strtoupper($estructura['cliente']->direccion); ?></span><br>
                            <span><?= strtoupper($estructura['cliente']->poblacion); ?></span><br>
                            <span><?= $estructura['cliente']->dni; ?></span><br>
                            <span><?= $estructura['cliente']->telefono; ?></span><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1 subrayado">
                    <span>Fecha Factura:</span><br>
                    <span>Número Factura:</span>
                </div>
                <div>
                    <span><?= $estructura['relacion']->fecha; ?></span><br>
                    <span>A/001467</span>
                </div>
            </div> <!-- row datos_cliente -->

            <div class="row datos_sepelio separado_row">
                <div class="col-md-12">
                    <span class="subrayado" style="padding-right: 40px;">GASTOS DEL SEPELIO:</span><span><?= strtoupper($estructura['difunto']->nombre); ?></span><br>
                    <span class="subrayado" style="padding-right: 50px;">FECHA:</span><span><?= strtoupper($estructura['servicio']->fecha_defuncion); ?></span><br>
                    <span class="subrayado" style="padding-right: 20px;">LOCALIDAD:</span><span><?= strtoupper($estructura['servicio']->poblacion_entierro); ?></span><br>
                </div>
            </div> <!-- row datos_sepelio -->

            <div class="row desglose_factura separado_row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><span style="margin-left: 150px;">SERVICIOS DE FUNERARIA</span></th>
                                <th>EUROS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($estructura['facturas'] as $valor) { ?>
                                <tr>
                                    <td><?= strtoupper($valor->concepto); ?></td>
                                    <td><?= $valor->importe; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- row datos_factura -->

            <div class="row total_factura separado_row">
                <div class="col-md-12">
                    <table class="table">
                        <thead><th></th><th></th></thead>
                        <tbody>
                            <?php
                                $base = $estructura['relacion']->total;
                                $iva = $base * 0.21;
                                $total = $base + $iva;
                            ?>
                            <tr>
                                <td><span style="margin-left: 150px;">TOTAL BASE IMPONIBLE</span></td>
                                <td><?= $base; ?></td>
                            </tr>
                            <tr>
                                <td><span style="margin-left: 150px;">21% I.V.A</span></td>
                                <td><?= $iva; ?></td>
                            </tr><tr>
                                <td><span style="margin-left: 150px;">TOTAL SERVICIO FUNERARIA</span></td>
                                <td><?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row firma_factura separado_row">
                <div class="col-md-6 col-md-offset-3 subrayado">FDO. LUIS ANT. GALLEGO CESPEDOSA</div>
            </div>

        </div> <!-- dina4 -->
    </div> <!-- body_factura -->
</div>
