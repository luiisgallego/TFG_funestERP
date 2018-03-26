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
    <link href="estilosFactura.css" rel="stylesheet">
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
    <div id="dina4">

        <div class="row datos_funeraria">
            <div class="col-md-6">
                <span style="font-size: 12pt;"><b>TANATORIO - FUNERARIA GALLEGO</b></span><br>
                <span>LUIS ANT. GALLEGO CESPEDOSA</span><br>
                <span>C/ CARPINTEROS Nº2</span><br>
                <span>N.I.F. 25,989,636 - G</span><br>
                <span>Tlfnos: 953 - 546 - 031 / Móvil: 619 - 350 - 884</span><br>
                <span>23790 Porcuna ( Jaén )</span>
            </div>
            <div class="col-md-6">
                <img class="tam_img pull-right" src="img/cruz_esquela.jpg">
                <img class="tam_img pull-right" src="img/cruz_esquela.jpg">
            </div>
        </div> <!-- row datos_funeraria -->

        <div class="row datos_cliente separado_row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <span style="background-color: #bfbfbf">CLIENTE</span><br>
                        <span>Nombre:</span><br>
                        <span>Dirección:</span><br>
                        <span>Población:</span><br>
                        <span>C.I.F.</span><br>
                        <span>TLF:</span><br>
                    </div>
                    <div>
                        <span></span><br>
                        <span>BENITA QUERO GARCÍA</span><br>
                        <span>C/ PADILLA</span><br>
                        <span>PORCUNA ( JAÉN )</span><br>
                        <span>25972744-V</span><br>
                        <span>666 777 888</span><br>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1 subrayado">
                <span>Fecha Factura:</span><br>
                <span>Número Factura:</span>
            </div>
            <div>
                <span>12 - Marzo - 2.018</span><br>
                <span>A/001467</span>
            </div>
        </div> <!-- row datos_cliente -->

        <div class="row datos_sepelio separado_row">
            <div class="col-md-12">
                <span class="subrayado" style="padding-right: 40px;">GASTOS DEL SEPELIO:</span><span>Dº. MARÍA DEL CARMEN GARCÍA DE LA ROSA</span><br>
                <span class="subrayado" style="padding-right: 50px;">FECHA:</span><span>10 - MARZO - 2.O18</span><br>
                <span class="subrayado" style="padding-right: 20px;">LOCALIDAD:</span><span>PORCUNA ( JAÉN )</span><br>
            </div>
        </div> <!-- row datos_sepelio -->

        <div class="row desglose_factura separado_row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th><span style="margin-left: 150px;">SERVICIOS DE FUNERARIA</span></th>
                            <th>EUROS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                        <tr class="separado_table">
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                        <tr>
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                        <tr>
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                        <tr>
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                        <tr>
                            <td>ARCA O FERETRO</td>
                            <td>461,31 E</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- row datos_factura -->

        <div class="row total_factura separado_row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span style="margin-left: 150px;">TOTAL BASE IMPONIBLE</span></td>
                            <td>1.191,49 E</td>
                        </tr>
                        <tr>
                            <td><span style="margin-left: 150px;">21% I.V.A</span></td>
                            <td>250,21 E</td>
                        </tr><tr>
                            <td><span style="margin-left: 150px;">TOTAL SERVICIO FUNERARIA</span></td>
                            <td>1.441,70 E</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row firma_factura separado_row">
            <div class="col-md-6 col-md-offset-3 subrayado">FDO. LUIS ANT. GALLEGO CESPEDOSA</div>
        </div>

    </div> <!-- dina4 -->
</body>
</html>