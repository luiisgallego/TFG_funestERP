<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1>Defunciones</h1></div>
        <div class="col-md-2 col-md-offset-1">
            <a href="main.php?op=nuevoServicio">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nuevo Servicio</button>
            </a>
        </div>
    </div>

    <div class="row page_content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading info_seccion">
                    <i class="fa fa-caret-square-o-right"></i>Listado
                </div>
                <div class="panel-body">
                    <div id="prueba" class="collapse in">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID_Esquela</th>
                                <th>Cliente</th>
                                <th>Fecha Defuncion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="iconos_td">
                                    <a href="./main.php?op=v_defuncion" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                    <a href="./main.php?op=e_defuncion&ref=1" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                    <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                    <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                </td>
                                <td class="id_td">001</td>
                                <td>Nuria Jalon</td>
                                <td>23-Enero-2018</td>
                            </tr>
                            <tr>
                                <td class="iconos_td">
                                    <a href="./main.php?op=v_defuncion" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                    <a href="./main.php?op=e_defuncion" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                    <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                    <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                </td>
                                <td class="id_td">002</td>
                                <td>Maria del Mar Ruano</td>
                                <td>15-Diciembre-2017</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->

</div> <!-- container-fluid -->
