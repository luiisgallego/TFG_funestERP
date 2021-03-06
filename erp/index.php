<?php
session_start();
require("../config/API_Global.php");
include_once('funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if($_SESSION['login_info'] == "") header("Location: http://localhost/funerariagallego/index.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Luis Gallego Quero">
        <title>FunestERP </title>
        <link rel="icon" href="../img/favicon.ico">

        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- CSS -->
        <link href="css/estilosERP.css" rel="stylesheet">
        <!-- FontAwesome Icons (http://fontawesome.io) -->
        <link href="../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
        <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
        <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bootstrap/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bootstrap/metisMenu/metisMenu.min.js"></script>
        <script src="js/metisMenuNavegacion.js"></script>

        <!-- ALERTIFY -->
        <link rel="stylesheet" href="./js/alertify/css/alertify.min.css">
<!--        <link rel="stylesheet" href=./js/alertify/css/themes/default.min.css">-->
        <script src="./js/alertify/alertify.min.js"></script>

        <!-- LINE CHART -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
    </head>
    <body>
        <?php include "../erp/navegacion.php";  ?>
        <div id="page-wrapper">
            <?php $seccion = "home.php";
                include($seccion);
            ?>
        </div>
    </body>
</html>
