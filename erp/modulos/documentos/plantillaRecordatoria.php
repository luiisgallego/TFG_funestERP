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
$estructura['servicio']->fecha_entierro = format_fecha($estructura['servicio']->fecha_entierro, "entierro");
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
            font-family: Arial;
            font-size: 13px;
            line-height: 1.3;
            color: #444;
        }

        .tam_img {
            max-width: 50px;
            max-height: 80px;
            margin-bottom: 10px;
        }

        .contenido_general {
            margin-top: 20px;
            text-align: justify;
        }
        .contenido_izquierda {
            float: left;
            max-width: 60mm;
            margin-left: 25px;
        }
        .contenido_derecha {
            float: right;
            max-width: 60mm;
            margin-right: 25px;
            margin-top: 30px;
        }
        .separado_row { margin-bottom: 5px; }
        .separado_row_doble {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="dina6">
        <div class="contenido_general">
            <div class="contenido_izquierda">
                <div style="text-align: center;">
                    <img class="tam_img" src="../../img/cruz_recordatoria.png">
                    <div class="" style="font-size: 70%;">ROGAD A DIOS EN CARIDAD</div>
                    <div class="separado_row" style="font-size: 70%;">por el alma de</div>
                    <div class="separado_row" style="font-size: 80%; font-weight: bold;"><?= strtoupper($estructura['difunto']->nombre) ?></div>
                    <div class="separado_row" style="font-size: 70%;">Que fallecio el<?= $estructura['servicio']->fecha_defuncion ?> a los
                        <?= $estructura['difunto']->fecha_nacimiento ?> años de edad habiendo recibido los santos Sacramentos.
                    </div>
                    <div class="separado_row subrayado" style="font-size: 80%; font-weight: bold;">D.E.P.</div>
                </div>
                <div class="separado_row" style="font-size: 70%;">
                    <?php foreach($estructura['familiares'] as $valor) { ?>
                        <span><?= $valor->rol ?>: </span> <?= $valor->nombres ?>,
                    <?php } ?>
                    Sobrinos, Primos y demás familia.
                </div>
                <div class="" style="font-size: 70%;">Ruegan a sus amistades  encomienden su
                    alma a Dios Nuestro Señor en sus Oraciones  y asistan a la Misa Funeral  que por el
                    eterno descanso de su alma, se celebrara el <?= $estructura['servicio']->fecha_misa ?> a las
                    <?= $estructura['servicio']->hora_misa ?> de la tarde en la Parroquia Ntra Sra de la Asunción
                </div>
            </div>
            <div class="contenido_derecha">
                <div class="separado_row" style="font-size: 70%;">Oh Dios, siempre dispuesto a la misericordia y al perdón,
                    escuchas nuestras súplicas por siervo AURELIA que acabas de llamar a tu presencia, y, porque creyó y
                    esperó en ti, condúcela a la patria verdadera para que goce contigo de la alegría eterna
                </div>
                <div class="separado_row_doble" style="font-size: 70%;">Por nuestro Señor Jesucristo</div>
                <div class="separado_row" style="font-size: 70%;">Señor Dios, perdón de los pecadores y felicidad de los justos,
                    al cumplir con dolor el deber de dar sepultura al cuerpo de nuestra hermana AURELIA  te pedimos le des
                    parte en el gozo de tus elegidos.
                </div>
                <div class="separado_row_doble" style="font-size: 70%;">Por nuestro Señor Jesucristo</div>
                <div class="separado_row" style="font-size: 70%;">Porcuna - Agosto - 2013</div>
            </div>
        </div> <!-- contenido_general -->
    </div> <!-- dina6 -->
</body>
</html>

<?php
$dompdf = new Dompdf();                     // instantiate and use the dompdf class
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('A6', 'landscape');
$dompdf->render();                           // Render the HTML as PDF

$pdf = $dompdf->output();
$filename = 'Recordatoria.pdf';
$dompdf->stream($filename, array("Attachment" => 0));     // Output the generated PDF to Browser
?>
