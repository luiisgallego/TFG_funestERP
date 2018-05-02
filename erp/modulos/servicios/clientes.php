<?php $clientes = $ApiClient->select("cliente"); ?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1>Clientes</h1></div>
        <div class="col-md-2 col-md-offset-1">
            <a href="main.php?op=nuevoCliente">
                <button type="button" class="btn btn-primary btn-lg btn-block">Nuevo Cliente</button>
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
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Poblacion</th>
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
                                <td>23-Enero-2018</td>
                            </tr>
                            <?php foreach($clientes as $cliente) { ?>
                                <tr>
                                    <td class="iconos_td">
                                        <a href="./main.php?op=v_cliente&ref=<?= $cliente->id ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=e_cliente&ref=<?= $cliente->id ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                        <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                        <a href="#" title="Imprimir"><i class="fa fa-print fa-fw iconos_a"></i></a>
                                    </td>
                                    <td class="id_td"><?=  $cliente->id; ?></td>
                                    <td><?=  $cliente->nombre; ?></td>
                                    <td><?=  $cliente->telefono; ?></td>
                                    <td><?=  $cliente->poblacion; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!--  container-fluid -->
