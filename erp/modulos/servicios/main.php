<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Luis Gallego Quero">
    <title>FunestERP</title>
    <link rel="icon" href="../../../img/favicon.ico">

    <!-- Bootstrap -->
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link href="../../css/estilosERP.css" rel="stylesheet">
    <!-- FontAwesome Icons (http://fontawesome.io) -->
    <link href="../../../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
    <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
    <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../bootstrap/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../bootstrap/metisMenu/metisMenu.min.js"></script>
    <script src="../../js/metisMenuNavegacion.js"></script>

    <!-- Añadir todas las comprobaciones de login necesarias -->

</head>
<body>
    <?php include "../navModulos.php"; ?>
    <div id="page-wrapper">
        <?php $op = $_GET['op'];

        if($op == "nuevoServicio") include "./nuevoServicio.php";       // DIFUNTOS
        else if($op == "defunciones") include "./defunciones.php";      // listado
        else if($op == "v_defuncion") include "./v_defuncion.php";      // ver
        else if($op == "e_defuncion") include "./e_defuncion.php";      // editar
        else if($op == "nuevoCliente") include "./nuevoCliente.php";    // CLIENTES
        else if($op == "clientes") include "./clientes.php";      // listado
        else if($op == "v_cliente") include "./v_cliente.php";      // ver
        else if($op == "e_cliente") include "./e_cliente.php";      // editar

        ?>
    </div> <!-- fin page-wrapper -->
</body>
</html>