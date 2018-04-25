<pre><?= print_r($_SESSION["login_info"]); ?></pre>

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
        <div class="col-lg-8">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Rendimiento mensual
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions <span class="caret"></span>
                            </button>
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
                    <!-- GRAFICO GOOGLE -->
                </div> <!-- Fin panel-body -->
            </div> <!-- Fin panel -->
        </div>

        <div class="col-lg-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i>Notificaciones
                </div>

                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i>Nueva alerta
                            <span class="pull-right text-muted small">
                                <em>Hace 12 minutos</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i>Nueva alerta
                            <span class="pull-right text-muted small">
                                <em>Hace 12 minutos</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i>Nueva alerta
                            <span class="pull-right text-muted small">
                                <em>Hace 12 minutos</em>
                            </span>
                        </a>
                    </div> <!-- list-group -->
                    <a href="#" class="btn btn-default btn-block">Ver todas</a>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-lg-4 -->
    </div> <!-- row -->

</div> <!-- container-fluid -->












