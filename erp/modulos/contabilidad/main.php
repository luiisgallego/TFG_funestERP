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

    <!-- Añadir todas las comprobaciones de necesarias -->

</head>
<body>
    <?php include "../navModulos.php"; ?>
    <div id="page-wrapper">
        <!-- Aqui es donde trabajamos -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contabilidad</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"> <!-- Lo mismo que hacer container-fluid -->
                <div class="panel panel-default">
                    <div class="panel-heading">Facturas</div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID_Factura</th>
                                    <th>Cliente</th>
                                    <th>Fecha Factura</th>
                                    <th>Número Factura</th>
                                    <th>Emitida</th>
                                    <th>Pagada</th>
                                    <th>Total</th>
                                    <!-- Numero factura estará relacionada con ID_Factura -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Iconos</td>
                                    <td>001</td>
                                    <td>Nuria Jalon</td>
                                    <td>23-Enero-2018</td>
                                    <td class="center">A/001445</td>
                                    <td class="center">No</td>
                                    <td class="center">No</td>
                                    <td class="center">1.597,57E</td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Iconos</td>
                                    <td>002</td>
                                    <td>Maria del Mar Ruano</td>
                                    <td>15-Diciembre-2017</td>
                                    <td class="center">A/001345</td>
                                    <td class="center">Si</td>
                                    <td class="center">No</td>
                                    <td class="center">1.597,57E</td>
                                </tr>
                                <tr class="odd gradeA">
                                    <td>Iconos</td>
                                    <td>003</td>
                                    <td>Juan Maria Beltran</td>
                                    <td>10-Octubre-2017</td>
                                    <td class="center">A/001215</td>
                                    <td class="center">Si</td>
                                    <td class="center">Si</td>
                                    <td class="center">1.597,57E</td>
                                </tr>
                                <tr class="even gradeA">
                                    <td>Iconos</td>
                                    <td>004</td>
                                    <td>Jose Carlos Garcia</td>
                                    <td>5-Junio-2017</td>
                                    <td class="center">A/001087</td>
                                    <td class="center">Si</td>
                                    <td class="center">Si</td>
                                    <td class="center">1.597,57E</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- fin page-wrapper -->

</body>
</html>