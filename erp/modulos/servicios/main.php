<?php
@session_start();
require '../../../config/API_Global.php';
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
        $estado = "hola";

        if($op == "nuevoServicio") include "./nuevoServicio.php";       // DIFUNTOS
        else if($op == "defunciones") include "./defunciones.php";          // listado
        else if($op == "v_defuncion") include "./v_defuncion.php";          // ver
        else if($op == "e_defuncion") {                                     // editar
            include "./e_defuncion.php";
            $estado = "editar";
        }
        else if($op == "nuevoCliente") include "./nuevoCliente.php";    // CLIENTES
        else if($op == "clientes") include "./clientes.php";                // listado
        else if($op == "v_cliente") include "./v_cliente.php";              // ver
        else if($op == "e_cliente") include "./e_cliente.php";              // editar

        ?>

    </div> <!-- fin page-wrapper -->

    <script src="func_servicios.js"></script>
</body>
</html>
