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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- FontAwesome Icons (http://fontawesome.io) -->
    <link href="../../../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
    <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
    <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow: auto;
        }
        body {
            /*background: #f2f2f2;*/
            font-family: Arial;
            font-size: 13px;
            line-height: 1.4;
            color: #444;
            margin-top: 5px;
        }

        /*#dina4 {*/
            /*width: 210mm;*/
            /*height: 297mm;*/
            /*!*padding: 0px 0px; !* Margenes folio *!*!*/
            /*border: 1px solid #D2D2D2;*/
            /*background: #fff;*/
            /*margin: 10px auto;*/
        /*}*/

        .barra_lateral {
            background-color: #0f0f0f;
            width: 15px;
            height: 275mm;
            margin-left: 35px;
        }
        .barra_superior {
            background-color: #0f0f0f;
            width: 200mm;
            height: 15px;
            margin-top: -30px;
            margin-left: 10px;
        }
        .barra_superior_lateral {
            background-color: #0f0f0f;
            width: 15px;
            height: 15mm;
            margin-left: 35px;
            margin-top: 10px;
        }

        .contenido_general {
            /*background-color: #ac2925;*/
            margin-left: 40px;
            padding-top: 20px;
            width: 175mm;
            /*min-height: 500px;*/
            /*width: 650px;*/
            /*height: 500px;*/
        }

        .tam_img {
            max-width: 250px;
            max-height: 250px;
            /*margin: 0 auto;*/
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        .separado_row { margin-bottom: 20px; }
        .subrayado { text-decoration: underline; }

        .contenido_central{
            margin-left: 5px;
            margin-right: 10px;
        }
        .contenido_central span { font-weight: bold; }

        .contenido_inferior .separado_row {
            margin-bottom: 20px;
        }
    </style>

</head>
<body>

    <div id="dina4">
        <div class="row" style="margin-left: 3px;">
            <div class="barra_superior_lateral"></div>
            <div class="barra_superior"></div>
            <div class="barra_lateral">
                <div class="contenido_general">

                    <div class="row contenido_superior">
    <!--                    <img class="tam_img" src="img/cruz_esquela.jpg">-->
                        <div class="col-md-10 col-md-offset-1" style="text-align: center;">
                            <img class="tam_img" src="../../img/cruz_esquela.jpg">
                            <div class="separado_row" style="font-size: 170%;">Rogad a Dios por el alma de</div>
                            <div class="separado_row" style="font-size: 220%; font-weight: bold">D. MANUEL RODRIGUEZ PRIMO</div>
                            <div class="separado_row" style="font-size: 130%;">Que falleció en Zaragoza el 20 de junio del 2014 a los 66 años,
                                habiendo recibido los Santos Sacramentos.</div>
                            <div class="separado_row subrayado" style="font-size: 250%; font-weight: bold;"><i>D.E.P.</i></div>
                        </div>
                    </div> <!-- contenido_superior -->

                    <div class="row contenido_central" style="text-align: justify">
                        <div class="col-md-12">
                            <div style="font-size: 130%;">
                                <span>Su esposa: </span>María Josefa López, <span> Hija: </span> María Josefa Rodriguez López,
                                <span> Hijo Político: </span>Eduardo Dominguez Aguilar, <span> Nieta: </span>Ainara Dominguez Rodriguez,
                                <span> Hermanos: </span>Domingo, Teresa, Herminia y Angel Rodriguez Primo,
                                <span> Hermanos Políticos, Sobrinos y demas familia.</span> <br>
                                Comunican a sus amistades tan sensible pérdida y les ruegan una oración por el eterno
                                descanso de su alma, y la asistencia al funeral de corpórea in sepulto que tendrá
                                lugar <span class="subrayado">el Sábado 21 de Junio a las 6:00 de la Tarde </span>
                                en la Parroquia Ntr. Sra. de la Asunción, por cuya asistencia les quedarán eternamente
                                agradecidos.
                            </div>
                        </div>
                    </div> <!-- contenido_central-->

                    <div class="row contenido_inferior" style="margin-top: 25px;">
                        <div class="col-md-12" style="text-align: center;">
                            <div class="separado_row subrayado " style="font-size: 120%; font-weight: bold;">EL FERETRO LLEGARÁ DIRECTAMENTE A LA PARROQUIA</div>
                            <div class="separado_row subrayado" style="font-size: 190%; font-weight: bold;">TANATORIO -- FUNERARIA GALLEGO</div>
                            <div class="subrayado" style="font-size: 120%; font-weight: bold;">C/ SALMERÓN Nº 48 PORCUNA - JAÉN - TFNOS 619 350 884 -- 953 546 031</div>
                        </div>
                    </div>

                </div> <!-- contenido_general -->
            </div> <!-- barra_lateral -->
        </div>

    </div> <!-- dina4 -->
</body>
</html>
