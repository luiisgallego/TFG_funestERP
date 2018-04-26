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
        <?php $op = $_GET['op'];

        if($op == "nuevaFactura") include "./nuevaFactura.php";         // FACTURAS
        else if($op == "facturas") include "./facturas.php";            // listado
        else if($op == "v_factura") include "./v_factura.php";          // ver
        else if($op == "e_factura") include "./e_factura.php";          // editar

        ?>
    </div> <!-- fin page-wrapper -->
</body>
</html>
