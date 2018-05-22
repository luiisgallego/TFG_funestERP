<?php
// DOMPDF
ob_start();
require_once '../../dompdf/autoload.inc.php';      // include autoloader
use Dompdf\Dompdf;

@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Luis Gallego Quero">
    <title>FunestERP</title>
    <link rel="icon" href="../../../img/favicon.ico">

    <!-- Bootstrap -->
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- FontAwesome Icons (http://fontawesome.io) -->
    <link href="../../../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
    <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
    <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

    <style>
        .body_factura {
            /*background: #f2f2f2;*/
            font-family: Arial;
            font-size: 13px;
            line-height: 1.6;
            color: #444;
            margin-left: 10px;
            margin-right: 30px;
        }

        .float_izq { float:left; }

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
        .firma_factura {
            position: absolute;
            bottom: 75px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="row body_factura">
        <div id="dina4">
            <div class="row datos_funeraria">
                <div class="float_izq">
                    <span style="font-size: 13pt; font-weight: bold"><b>TANATORIO - FUNERARIA GALLEGO</b></span><br>
                    <span>LUIS ANT. GALLEGO CESPEDOSA</span><br>
                    <span>C/ CARPINTEROS Nº2</span><br>
                    <span>N.I.F. 25,989,636 - G</span><br>
                    <span>Tlfnos: 953 - 546 - 031 / Móvil: 619 - 350 - 884</span><br>
                    <span>23790 Porcuna ( Jaén )</span>
                </div>
                <div class="datos_fun_dcha">
                    <img class="tam_img pull-right" src="../../img/cruz_esquela.jpg">
                    <img class="tam_img pull-right" src="../../img/cruz_esquela.jpg">
                </div>
            </div> <!-- row datos_funeraria -->

            <div class="row datos_cliente separado_row">
                <div class="float_izq">
                    <div class="float_izq">
                        <span style="background-color: #bfbfbf">CLIENTE</span><br>
                        <span>Nombre:</span><br>
                        <span>Dirección:</span><br>
                        <span>Población:</span><br>
                        <span>C.I.F.</span><br>
                        <span>TLF:</span><br>
                    </div>
                    <div style="margin-left: 100px;">
                        <span></span><br>
                        <span><?= strtoupper($estructura['cliente']->nombre); ?></span><br>
                        <span><?= strtoupper($estructura['cliente']->direccion); ?></span><br>
                        <span><?= strtoupper($estructura['cliente']->poblacion); ?></span><br>
                        <span><?= $estructura['cliente']->dni; ?></span><br>
                        <span><?= $estructura['cliente']->telefono; ?></span><br>
                    </div>
                </div>
                <div style="float:right; margin-right: 50px;">
                    <div class="float_izq subrayado">
                        <span>Fecha Factura:</span><br>
                        <span>Número Factura:</span>
                    </div>
                    <div style="margin-left: 100px;">
                        <span><?= $estructura['relacion']->fecha; ?></span><br>
                        <span>A/001467</span>
                    </div>
                </div>
            </div> <!-- row datos_cliente -->

            <div class="row datos_sepelio separado_row">
                <div class="float_izq">
                    <span class="subrayado">GASTOS DEL SEPELIO:</span><br>
                    <span class="subrayado">FECHA:</span><br>
                    <span class="subrayado">LOCALIDAD:</span><br>
                </div>
                <div style="margin-left: 150px;">
                    <span><?= strtoupper($estructura['difunto']->nombre); ?></span><br>
                    <span><?= strtoupper($estructura['servicio']->fecha_defuncion); ?></span><br>
                    <span><?= strtoupper($estructura['servicio']->poblacion_entierro); ?></span><br>
                </div>
            </div> <!-- row datos_sepelio -->

            <div class="row desglose_factura separado_row">
                <div class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><span style="position:absolute; margin-left: 250px;">SERVICIOS DE FUNERARIA</span></th>
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
                            <?php
                            $base = $estructura['relacion']->total;
                            $iva = $base * 0.21;
                            $total = $base + $iva;
                            ?>
                            <tr>
                                <td><span style="position:absolute; margin-left: 250px;">TOTAL BASE IMPONIBLE</span></td>
                                <td><?= $base; ?></td>
                            </tr>
                            <tr>
                                <td><span style="position:absolute; margin-left: 250px;">21% I.V.A</span></td>
                                <td><?= $iva; ?></td>
                            </tr>
                            <tr>
                                <td><span style="position:absolute; margin-left: 250px;">TOTAL SERVICIO FUNERARIA</span></td>
                                <td><?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- row datos_factura -->

            <div class="row firma_factura separado_row">
                <div class="subrayado">FDO. LUIS ANT. GALLEGO CESPEDOSA</div>
            </div>

        </div> <!-- dina4 -->
    </div> <!-- body_factura -->
</body>
</html>

<?php
$dompdf = new Dompdf();                     // instantiate and use the dompdf class
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();                           // Render the HTML as PDF
$dompdf->setPaper('A4');                // (Optional) Setup the paper size and orientation
$pdf = $dompdf->output();
$filename = 'Esquela.pdf';
$dompdf->stream($filename, array("Attachment" => 0));     // Output the generated PDF to Browser
?>
