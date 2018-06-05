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
                            <?php foreach($clientes as $cliente) { ?>
                                <tr>
                                    <td class="iconos_td">
                                        <a href="./main.php?op=v_cliente&ref=<?= $cliente->id ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="./main.php?op=e_cliente&ref=<?= $cliente->id ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
<!--                                        <a href="#" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>-->
                                        <a href="#" title="Borrar" name="<?=  $cliente->id; ?>" onclick="borrarCliente(this);"><i class="fa fa-trash fa-fw iconos_a"></i></a>
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

<script>

    function borrarCliente(info) {

        var id = info.name;
        var confirmar = confirm("¿Realmente desea eliminar el cliente con ID = " + id + "?" );

        if(confirmar) {
            $.ajax({
                type: "POST",
                url: "../../procesa.php",
                data: {
                    op: "deleteCliente",
                    id: id
                },
                success: function (data) {

                    if(data == 1) {
                        location.reload();
                    } else alertify.error("Error en el borrado.");

                },
                error: function () {
                    alertify.error("Error en el borrado.");
                }
            });
        }
    }
</script>

