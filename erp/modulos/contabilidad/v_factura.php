<style>
    .body_factura {
        /*background: #f2f2f2;*/
        font-family: Arial;
        font-size: 13px;
        line-height: 1.6;
        color: #444;
    }

    #dina4 {
        width: 210mm;
        height: 297mm;
        padding: 20px 60px; /* Margenes folio */
        border: 1px solid #D2D2D2;
        background: #fff;
        margin: 10px auto;
    }
    .tam_img {
        width: 120px;
        height: 120px;
    }
    .separado_row {
        margin-top: 20px;
    }
    .subrayado {
        text-decoration: underline;
    }
    .desglose_factura {
        min-height: 430px;
    }
</style>

<div class="container-fluid">

    <div class="row border_nav">
        <div class="col-md-2"><h2>Factura:</h2></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4>Miguel Ángel del Carmen Garcia Ruiz</h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="espaciar_nav" role="presentation" >
                            <a href="main.php?op=e_factura">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_difunto">Difunto</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_cliente">Cliente</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../documentos/main.php?op=v_esquela">Esquela</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->

    <div class="row body_factura" style="margin-top: 20px;">
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
                        <thead><th></th><th></th></thead>
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
    </div>

</div>

