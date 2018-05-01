<?php
@session_start();
require '../../../config/API_Global.php';
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

            if($op == "nuevoServicio") {                                    // DIFUNTOS
                $editar = false;
                include "./nuevoServicio.php";
            }
            else if($op == "defunciones") include "./defunciones.php";          // listado
            else if($op == "v_defuncion") include "./v_defuncion.php";          // ver
            else if($op == "e_defuncion") {                                     // editar
                $editar = true;
                include "./e_defuncion.php";
            }
            else if($op == "nuevoCliente") {                                // CLIENTES
                $editar = false;
                include "./nuevoCliente.php";
            }
            else if($op == "clientes") include "./clientes.php";                // listado
            else if($op == "v_cliente") include "./v_cliente.php";              // ver
            else if($op == "e_cliente") {                                       // editar
                $editar = true;
                include "./e_cliente.php";
            }
        ?>

    </div> <!-- fin page-wrapper -->

    <script src="func_servicios.js"></script>
    <script>
        /**
         * JQUERY para ajustar los VALUE en función
         * de si estamos viendo o editando
         */
        $(document).ready(function () {
            var editar = "<?php print_r($editar); ?>";
            var hayServicio = "<?php print_r($hayServicio); ?>";
            var input_difunto = $("#form_difunto input");
            var input_servicio = $("#form_servicio input");
            var input_cliente = $("#form_cliente input");
            var input_familiares = $("#form_familiares input");

            if(editar !== "1") {    // Caso general
                input_difunto.attr("value","");
                input_servicio.attr("value","");
                input_cliente.attr("value","");
                input_familiares.attr("value","");
            }

            // Estamos editando pero no existe servicio en difunto
            if(hayServicio !== "1") input_servicio.attr("value","");
        });
    </script>

</body>
</html>
