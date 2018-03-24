<div class="container-fluid">
    <div class="row page-header">
        <h1 class="col-md-3">Facturas</h1>
        <div class="col-md-9">
            <a href="main.php?op=nuevaFactura">
                <button type="button" class="btn btn-info btn-lg boton_nuevo">Nueva Factura</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Listado</div>
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
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="iconos_td">
                            <a href="./main.php?op=v_defuncion" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                            <a href="./main.php?op=e_defuncion" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                            <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                            <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                        </td>
                        <td class="id_td">001</td>
                        <td>Nuria Jalon</td>
                        <td>23-Enero-2018</td>
                        <td class="center">A/001445</td>
                        <td class="center">No</td>
                        <td class="center">No</td>
                        <td class="center">1.597,57E</td>
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
                        <td class="center">A/001345</td>
                        <td class="center">Si</td>
                        <td class="center">No</td>
                        <td class="center">1.597,57E</td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- panel-body-->
        </div> <!-- panel -->
    </div> <!-- row page-header -->

</div>
