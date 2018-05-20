<?php
// DOMPDF
ob_start();
require_once '../../dompdf/autoload.inc.php';      // include autoloader
use Dompdf\Dompdf;

@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$ref = $_GET['ref'];
$id_dif = $ref;

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
    "familiares" => $familiares
];

// FORMATEMOS LA FECHA
$estructura['servicio']->fecha_defuncion = format_fecha($estructura['servicio']->fecha_defuncion, "defuncion");
$estructura['servicio']->fecha_misa = format_fecha($estructura['servicio']->fecha_misa, "entierro");

// FORMATEMOS LA HORA
$estructura['servicio']->hora_entierro = format_hora($estructura['servicio']->hora_entierro);
$estructura['servicio']->hora_misa = format_hora($estructura['servicio']->hora_misa);

// FORMATEMOS LA EDAD
$estructura['difunto']->fecha_nacimiento = format_edad($estructura['difunto']->fecha_nacimiento);

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
    <link rel="icon" href="../img/favicon.ico">

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
        html, body {
            margin: 0;
            padding: 0;
            overflow: auto;
        }
        body {
            /*background: #f2f2f2;*/
            font-family: Arial;
            font-size: 13px;
            line-height: 1.4;
            color: #444;
            margin-top: 5px;
        }

        .barra_lateral {
            background-color: #0f0f0f;
            width: 15px;
            height: 260mm;
            margin-left: 35px;
        }
        .barra_superior {
            background-color: #0f0f0f;
            width: 200mm;
            height: 15px;
            margin-top: -30px;
            margin-left: 10px;
        }
        .barra_superior_lateral {
            background-color: #0f0f0f;
            width: 15px;
            height: 15mm;
            margin-left: 35px;
            margin-top: 10px;
        }

        .contenido_general {
            /*background-color: #ac2925;*/
            margin-left: 40px;
            padding-top: 20px;
            width: 175mm;
            /*min-height: 500px;*/
            /*width: 650px;*/
            /*height: 500px;*/
        }

        .tam_img {
            max-width: 250px;
            max-height: 250px;
            margin: 0 ;
            display: block;
            margin-bottom: 5px;
            margin-top: 25px;
        }

        .separado_row { margin-bottom: 20px; }
        .separado_row_misa {
            margin-top: 50px;
            margin-bottom: 20px;
        }
        .subrayado { text-decoration: underline; }

        .contenido_central{
            margin-left: 5px;
            margin-right: 10px;
        }
        .contenido_central span { font-weight: bold; }

        .contenido_inferior .separado_row {
            margin-bottom: 20px;
        }
        .misa_funeral {
            text-align: left;
            font-size: 250%;
            font-weight: bold;
            /*margin-right: -100px;*/
            /*margin-top: 100px;*/
            position: absolute;
            margin-top: 50px;
            width: 30px;
        }
    </style>

</head>
<body>

<div id="dina4">
    <div class="row" style="margin-left: 3px;">
        <div class="barra_superior_lateral"></div>
        <div class="barra_superior"></div>
        <div class="barra_lateral">
            <div class="contenido_general">

                <div class="row contenido_superior">
                    <div class="col-md-10 col-md-offset-1" style="text-align: center;">
                        <div class="subrayado misa_funeral"> MISA FUNERAL</div>
                        <img class="tam_img" src="../../img/cruz_esquela.jpg">
                        <div class="separado_row" style="font-size: 170%;">Rogad a Dios por el alma de</div>
                        <div class="separado_row" style="font-size: 220%; font-weight: bold">D. <?= strtoupper($estructura['difunto']->nombre) ?></div>
                        <div class="separado_row" style="font-size: 130%;">Que falleció en <?= $estructura['difunto']->poblacion ?> el
                            <?= $estructura['servicio']->fecha_defuncion ?> a los <?= $estructura['difunto']->fecha_nacimiento ?> años,
                            habiendo recibido los Santos Sacramentos.</div>
                        <div class="separado_row subrayado" style="font-size: 250%; font-weight: bold;"><i>D.E.P.</i></div>
                    </div>
                </div> <!-- contenido_superior -->

                <div class="row contenido_central" style="text-align: justify">
                    <div class="col-md-12">
                        <div style="font-size: 130%;">
                            <?php foreach($estructura['familiares'] as $valor) { ?>
                                <span><?= $valor->rol ?>: </span> <?= $valor->nombres ?>,
                            <?php } ?>
                            <span> Hermanos Políticos, Sobrinos y demas familia.</span> <br>
                            Comunican a sus amistades tan sensible pérdida y les ruegan una oración por el eterno
                            descanso de su alma, y la asistencia al funeral de corpórea in sepulto que tendrá
                            lugar <span class="subrayado">el <?= $estructura['servicio']->fecha_misa ?> a las
                                <?= $estructura['servicio']->hora_entierro ?> </span> en la Parroquia Ntr. Sra. de la Asunción,
                            por cuya asistencia les quedarán eternamente agradecidos.
                        </div>
                    </div>
                </div> <!-- contenido_central-->

                <div class="row contenido_inferior" style="margin-top: 25px;">
                    <div class="col-md-12" style="text-align: center;">
                        <div class="separado_row_misa subrayado" style="font-size: 190%; font-weight: bold;">TANATORIO -- FUNERARIA GALLEGO</div>
                        <div class="subrayado" style="font-size: 120%; font-weight: bold;">C/ SALMERÓN Nº 48 PORCUNA - JAÉN - TFNOS 619 350 884 -- 953 546 031</div>
                    </div>
                </div>

            </div> <!-- contenido_general -->
        </div> <!-- barra_lateral -->
    </div>

</div> <!-- dina4 -->
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
