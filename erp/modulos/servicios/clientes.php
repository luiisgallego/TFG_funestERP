<div class="container-fluid">
    <div class="row page_header">
        <h1 class="col-md-3">Clientes</h1>
        <div class="col-md-9">
            <a href="main.php?op=nuevoCliente">
                <button type="button" class="btn btn-info btn-lg boton_nuevo">Nuevo Cliente</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Listado</div>
            <div class="panel-body">
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
                            <a href="./main.php?op=v_cliente" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                            <a href="./main.php?op=e_cliente" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                            <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                            <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                        </td>
                        <td class="id_td">001</td>
                        <td>Nuria Jalon</td>
                        <td>23-Enero-2018</td>
                    </tr>
                    <tr>
                        <td class="iconos_td">
                            <a href="./main.php?op=v_cliente" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                            <a href="./main.php?op=e_cliente" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                            <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                            <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                        </td>
                        <td class="id_td">002</td>
                        <td>Maria del Mar Ruano</td>
                        <td>15-Diciembre-2017</td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- panel-body-->
        </div> <!-- panel -->
    </div> <!-- row -->

</div> <!--  container-fluid -->