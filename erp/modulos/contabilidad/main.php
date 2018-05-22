<?php
@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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

            if($op == "nuevaFactura") {                             // FACTURAS
                $editar = false;
                include "./nuevaFactura.php";
            }
            else if($op == "facturas") include "./facturas.php";            // listado
            else if($op == "v_factura") include "./v_factura.php";          // ver
            else if($op == "e_factura") {                                   // editar
                $editar = true;
                $editar_factura = true;
                include "./e_factura.php";
            }
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
            var input_cliente = $("#form_cliente input");
            var input_facturas = $("#form_facturas input");

            if(editar !== "1") {    // Caso general
                input_difunto.attr("value","");
                input_servicio.attr("value","");
                input_cliente.attr("value","");
                input_facturas.attr("value","");
            }
        });
    </script>

    <!-- ALERTIFY -->
<!--    <script rel="stylesheet" href="../../js/alertify/alertify.js"></script>-->
<!--    <link rel="stylesheet" href="../../js/alertify/css/alertify.css">-->
<!--    <link rel="stylesheet" href="../../js/alertify/css/themes/default.css">-->

</body>
</html>
