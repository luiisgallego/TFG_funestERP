<?php
@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$id = $_GET['id'];
$correo = $_SESSION['correos'][$id];
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('../head_main.php'); ?>
    </head>
    <body>

        <?php include "../navModulos.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row page_content" style="margin-top: 20px;">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading info_seccion">
                                <i class="fa fa-caret-square-o-right"></i>Asunto: <?= $correo['asunto'] ?>
                            </div>
                            <div class="panel-body">

                                <h4><b>Remitente:</b> <?= $correo['remitente'] ?></h4>
                                <h4><b>Mensaje</b></h4>
                                <div>
                                    <?= $correo['mensaje'] ?>
                                </div>

                            </div> <!-- panel-body-->
                        </div> <!-- panel -->
                    </div> <!-- col-md-12 -->
                </div> <!-- page_content -->
            </div> <!--  container-fluid -->
        </div> <!-- fin page-wrapper -->
    </body>
</html>
