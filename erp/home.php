<?php

/**
 *      GRAFICO RENDIMIENTO MENSUAL
 */

$modulo = "difunto_facturas";
$facturas = $ApiClient->select($modulo);

$estructura = [];
$meses = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
$cont_fact_emitir = 0;
$cont_fact_cobrar = 0;

foreach ($facturas as $factura) {

    $fecha = new DateTime($factura->fecha);
//    $dia = date_format($fecha, "j");
    $mes = $meses[date_format($fecha, "n")];

    if($estructura[$mes] == null){
        $estructura[$mes] = 1;
    } else $estructura[$mes]++;

    // Para las notificaciones
    if($factura->emitida == 0) {
        $cont_fact_emitir++;
        $cont_fact_cobrar++;
    } else if($factura->cobrada == 0) {
        $cont_fact_cobrar++;
    }
}

/**
 *      NOTIFICACIONES
 */

$notificaciones = [];
$fecha_act = date('Y-m-d');
$hora_act = date('H:i:s');

// MISAS FUNERALES proximas
$modulo = "servicio";
$cond = "fecha_misa >= '$fecha_act'";
$misas = $ApiClient->select($modulo, $cond, "");

$txt = "<span class='not_numero'>" . count($misas) . "</span>" . "misas funerales próximas.";
$aux = ["misas", count($misas) , $txt];
array_push($notificaciones, $aux);

// DOCUMENTOS sin emitir
$modulo = "difunto_familiares";
$documentos = $ApiClient->select($modulo);

$cont_esquelas = 0;
$cont_misas = 0;
$cont_recordatorias = 0;
foreach ($documentos as $documento) {

    if($documento->esquela_emitida == 0) $cont_esquelas++;
    if($documento->misa_emitida == 0) $cont_misas++;
    if($documento->recordatoria_emitida == 0) $cont_recordatorias++;
}

$txt = "<span class='not_numero'>" . $cont_esquelas . "</span>" . "esquelas sin emitir";
$aux = ["esquelas", $cont_esquelas , $txt];
array_push($notificaciones, $aux);
$txt = "<span class='not_numero'>" . $cont_misas . "</span>" . "misas sin emitir";
$aux = ["misas_funerales", $cont_misas , $txt];
array_push($notificaciones, $aux);
$txt = "<span class='not_numero'>" . $cont_recordatorias . "</span>" . "recordatorias sin emitir";
$aux = ["recordatorias", $cont_recordatorias , $txt];
array_push($notificaciones, $aux);

// Reutilizamos FACTURAS del grafico
$txt = "<span class='not_numero'>" . $cont_fact_emitir . "</span>" . "facturas sin emitir";
$aux = ["fact_sin_emitir", $cont_fact_emitir , $txt];
array_push($notificaciones, $aux);
$txt = "<span class='not_numero'>" . $cont_fact_cobrar . "</span>" . "facturas sin cobrar";
$aux = ["fact_sin_cobrar", $cont_fact_cobrar, $txt];
array_push($notificaciones, $aux);

//file_put_contents (__DIR__."/SOMELOG.log" , print_r($notificaciones, TRUE).PHP_EOL, FILE_APPEND );

?>

<!-- Dentro de page-wrapper -->
<div class="container-fluid">

    <div class="row page_header">
        <div class="col-md-3"><h1>Home</h1></div>
        <div class="col-md-2 col-md-offset-1">
            <a href="./modulos/servicios/main.php?op=nuevoServicio">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nuevo Servicio</button>
            </a>
        </div>
    </div>

    <div class="row"> <!-- CONTENIDO CENTRAL -->
        <div class="col-md-8">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Rendimiento mensual
                    <div class="pull-right">
                        <div class="btn-group">
<!--                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">-->
<!--                                Mes <span class="caret"></span>-->
<!--                            </button>-->
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="chart_div"></div>  <!-- GRAFICA -->
                </div> <!-- Fin panel-body -->
            </div> <!-- Fin panel -->
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw" style="margin-right: 10px;"></i>Notificaciones
                </div>

                <div class="panel-body">
                    <div class="list-group">

                        <?php foreach ($notificaciones as $notificacion) {
                            if($notificacion[1] != 0) { ?>
                            <div class="list-group-item">
                                <i class="fa fa-comment fa-fw not"></i><?= $notificacion[2] ?>
<!--                                <span class="pull-right text-muted small">-->
<!--                                    <em>Hace 12 minutos</em>-->
<!--                                </span>-->
                            </div>
                            <?php } ?>
                        <?php } ?>

                    </div> <!-- list-group -->
<!--                    <a href="#" class="btn btn-default btn-block">Ver todas</a>-->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-lg-4 -->
    </div> <!-- row -->

</div> <!-- container-fluid -->

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var aux = JSON.parse('<?php print_r(json_encode($estructura)); ?>');

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Meses');
        data.addColumn('number', 'Servicios');

        (aux.Enero !== undefined) ? data.addRow(['Enero', aux.Enero]) : data.addRow(['Enero', 0]);
        (aux.Febrero !== undefined) ? data.addRow(['Febrero', aux.Febrero]) : data.addRow(['Febrero', 0]);
        (aux.Marzo !== undefined) ? data.addRow(['Marzo', aux.Marzo]) : data.addRow(['Marzo', 0]);
        (aux.Abril !== undefined) ? data.addRow(['Abril', aux.Abril]) : data.addRow(['Abril', 0]);
        (aux.Mayo !== undefined) ? data.addRow(['Mayo', aux.Mayo]) : data.addRow(['Mayo', 0]);
        (aux.Junio !== undefined) ? data.addRow(['Junio', aux.Junio]) : data.addRow(['Junio', 0]);
//        (aux.Julio !== undefined) ? data.addRow(['Julio', aux.Julio]) : data.addRow(['Julio', 0]);
//        (aux.Agosto !== undefined) ? data.addRow(['Agosto', aux.Agosto]) : data.addRow(['Agosto', 0]);
//        (aux.Septiembre !== undefined) ? data.addRow(['Septiembre', aux.Septiembre]) : data.addRow(['Septiembre', 0]);
//        (aux.Octubre !== undefined) ? data.addRow(['Octubre', aux.Octubre]) : data.addRow(['Octubre', 0]);
//        (aux.Noviembre !== undefined) ? data.addRow(['Noviembre', aux.Noviembre]) : data.addRow(['Noviembre', 0]);
//        (aux.Diciembre !== undefined) ? data.addRow(['Diciembre', aux.Diciembre]) : data.addRow(['Diciembre', 0]);

        var options = {
            hAxis: {
                title: 'Mes'
            },
            vAxis: {
                title: 'Servicios'
            },
            height: 450,
            colors: ['#76a7fa']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
