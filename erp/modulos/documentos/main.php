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

        if($op == "nuevaEsquela") include "./nuevaEsquela.php";         // ESQUELAS
        else if($op == "esquelas") include "./esquelas.php";            // listado
        else if($op == "v_esquela") include "./v_esquela.php";          // ver
        else if($op == "e_esquela") include "./e_esquela.php";          // editar

        ?>
    </div> <!-- fin page-wrapper -->
</body>
</html>
