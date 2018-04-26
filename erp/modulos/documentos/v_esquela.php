<style>
    body_esquela {
        background: #f2f2f2;
        font-family: Arial;
        font-size: 13px;
        line-height: 1.6;
        color: #444;
    }

    #dina4 {
        width: 210mm;
        height: 297mm;
        /*padding: 0px 0px; !* Margenes folio *!*/
        border: 1px solid #D2D2D2;
        background: #fff;
        margin: 10px auto;
    }

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
        margin-left: 60px;
        padding-top: 20px;
        width: 175mm;
        /*min-height: 500px;*/
        /*width: 650px;*/
        /*height: 500px;*/
    }

    .tam_img {
        max-width: 250px;
        max-height: 250px;
        margin: 0 auto;
        display: block;
        margin-bottom: 10px;
    }

    .separado_row { margin-bottom: 20px; }
    .subrayado { text-decoration: underline; }

    .contenido_central{
        margin-left: 5px;
        margin-right: 10px;
    }
    .contenido_central span {
        font-weight: bold;
    }

    .contenido_inferior .separado_row {
        margin-bottom: 40px;
    }
</style>

<div class="container-fluid">
    <div class="row border_nav">
        <div class="col-md-2"><h2>Esquela:</h2></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4>Jose María del Carmen Garcia Ruiz</h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="espaciar_nav" role="presentation" >
                            <a href="main.php?op=e_esquela">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_difunto">Difunto</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_cliente">Cliente</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../contabilidad/main.php?op=v_factura">Factura</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->

    <div class="row body_esquela">
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
                                <div style="font-size: 140%;">
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

                        <div class="row contenido_inferior" style="margin-top: 40px;">
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
    </div> <!-- row body_esquela -->
</div>
