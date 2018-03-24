<!-- Dentro de page-wrapper -->
<div class="row">
    <div class="page-header padding_home">
        <!--<div class="col-md-3"><h1>Home</h1></div>-->
        <h1 class="col-md-3">Home</h1>
        <div class="col-md-9">

            <a href="./modulos/servicios/main.php?op=nuevoServicio">
                <button type="button" class="btn btn-info btn-lg">Nuevo Servicio</button>
            </a>

        </div>
    </div> <!-- Fin page-header -->
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- CONTENIDO CENTRAL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Rendimiento mensual
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
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
                </div>
                <a href="#" class="btn btn-default btn-block">Ver todas</a>
            </div>
        </div>
     </div>
</div>







