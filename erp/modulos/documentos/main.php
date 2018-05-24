<?php
@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR |  E_PARSE);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('../head_main.php'); ?>
</head>
<body>
    <?php include "../navModulos.php"; ?>
    <div id="page-wrapper">
        <?php
            $op = $_GET['op'];

            if($op == "nuevaEsquela" || $op == "nuevaRecordatoria") {                                                           // ESQUELAS
                $editar = false;
                include "./nuevaEsquela.php";
            }
            else if($op == "esquelas" || $op == "recordatorias" || $op == "documentos") include "./documentos.php";                     // listado
            else if($op == "v_esquela") include "./v_esquela.php";                                                                      // ver
            else if($op == "e_documentos") {                                                                                            // editar
                $editar = true;
                $editar_esquela = true;
                include "./e_documentos.php";
            }                                                                                   // RECORDATORIO
            else if($op == "v_recordatoria") include "./v_recordatoria.php";                        // ver
            else if($op == "descargarEsquela") include "./plantillaEsquela.php";
            else if($op == "descargarMisa") include "./plantillaMisa.php";
        ?>
    </div> <!-- fin page-wrapper -->

    <script src="../func_aux.js"></script>
    <script>
        /**
         * JQUERY para ajustar los VALUE en función
         * de si estamos viendo o editando
         */
        $(document).ready(function () {
            var editar = "<?php print_r($editar); ?>";
            var input_difunto = $("#form_difunto input");
            var input_servicio = $("#form_servicio input");
            var input_familiares = $("#form_familiares input");

            if(editar !== "1") {    // Caso general
                input_difunto.attr("value","");
                input_servicio.attr("value","");
                input_familiares.attr("value","");
            }
        });
    </script>
</body>
</html>
