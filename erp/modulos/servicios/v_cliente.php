<?php
/* ¡¡ CLIENTE NO ES UNA RELACION 1-1 !! */
/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */

$ref = $_GET['ref'];
$miga = $_GET['miga'];
$id_cliente = null;

if($miga == "" || $miga == "cliente" || $miga == "factura") {                 // CLIENTE || FACTURA

    $id_cliente = $ref;

} else if($miga === "difunto" || $miga === "docs") {    // DIFUNTO || DOCUMENTOS

    // Consultamos el CLIENTE asociado al DIFUNTO
    $modulo = "difunto_cliente";
    $cond = "id_dif='$ref'";
    $difuntoCliente = $ApiClient->select($modulo, $cond);
    $id_cliente = $difuntoCliente[0]->id_cli;

    if(empty($id_cliente)) redirige2("modulos/servicios/main.php?op=clientes");
}

$cliente = $ApiClient->select("cliente", "id='$id_cliente'");
$cliente = $cliente[0];

// Para la navegacion
/* DIFUNTOS del CLIENTE */
$difuntosCliente = $ApiClient->select("difunto_cliente", "id_cli='$id_cliente'");
?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-2"><h1>Cliente:</h1></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4><?= $cliente->nombre ?></h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="espaciar_nav" role="presentation">
                            <a href="main.php?op=e_cliente&ref=<?= $cliente->id ?>">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <?php if(count($difuntosCliente) > 1) { ?>
                                <a href="main.php?op=defunciones&miga=cliente&ref=<?= $cliente->id ?>">Difuntos</a>
                            <?php } else { ?>
                                <a href="main.php?op=v_defuncion&ref=<?= $difuntosCliente[0]->id_dif ?>">Difunto</a>
                            <?php } ?>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../documentos/main.php?op=documentos&miga=cliente&ref=<?= $cliente->id ?>">Documentos</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <?php if(count($difuntosCliente) > 1) { ?>
                                <a href="../contabilidad/main.php?op=facturas&miga=cliente&ref=<?= $cliente->id ?>">Factura</a>
                            <?php } else { ?>
                                <a href="../contabilidad/main.php?op=v_factura&miga=cliente&ref=<?= $cliente->id ?>">Factura</a>
                            <?php } ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->
    <div class="row page_content">
        <div class="col-md-12">
            <div>
                <div class="panel panel-primary">
                    <div class="panel-heading info_seccion"><i class="fa fa-caret-square-o-right"></i>Datos Cliente</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-6"><span>Nombre: </span><?= $cliente->nombre ?></div>
                                    <div class="col-md-3"><span>DNI: </span><?= $cliente->dni ?></div>
                                    <div class="col-md-3"><span>Dirección: </span><?= $cliente->direccion ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-3"><span>Población: </span><?= $cliente->poblacion ?></div>
                                    <div class="col-md-3"><span>Código Postal:: </span><?= $cliente->codigo_postal ?></div>
                                    <div class="col-md-3"><span>Telefono: </span><?= $cliente->telefono ?></div>
                                    <div class="col-md-3"><span>Email: </span><?= $cliente->email ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-3"><span>Cuenta Bancaria: </span><?= $cliente->cuenta_bancaria ?></div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- panel-body -->
                </div> <!-- panel panel-primary -->
            </div>
        </div> <!-- col-md-12 -->
    </div> <!-- row page_content -->
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
            <div id="botonModal" class="btn btn-primary btn-lg btn-block nuevo_servicio_button">Añadir difunto a cliente </div>
        </div>
    </div>
</div> <!--  container-fluid -->

<!-- AÑADIR DIFUNTO A CLIENTE -->
<div class="modal fade" id="modalCliente" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div>DIFUNTOS</div>
            </div>

            <div class="modal-body">
                <!-- *************** BUSCADOR **************** -->
                <div class="row busqueda" >
                    <div class="col-md-8 col-md-offset-4">
                        <form class="navbar-form" role="search" method="post">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" name="nuevoCliente" onkeyup="buscarDifuntoLimitado(this);" placeholder="Buscar difunto">
                            </div>
                        </form>
                        <div id="resBusqueda" style="margin-top: 50px;"></div>
                    </div>
                </div> <!-- busqueda -->
                <!-- *************** FIN BUSCADOR **************** -->

                <div class="boton_modal">
                    <button id="botonModal2" type="button" class="btn btn-info btn-lg">Añadir relación</button>
                </div>
            </div><!-- Fin Modal Body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(function () {     // DOCUMENT READY

        // ABRIMOS MODAL
        $("#botonModal").click(function () {
            $("#modalCliente").modal();
        });

        $("#botonModal2").click(function () {

            var id_cliente = "<?php print_r($id_cliente); ?>";
            var id_difunto = $("#id_difunto").val();

            $.ajax({
                type: "POST",
                url: "../../procesa.php",
                data: {
                        op: "cliente_difunto",
                        id_cli: id_cliente,
                        id_dif: id_difunto,
                    },
                success: function (data) {
                    $("#modalCliente").modal('hide');
                    console.log("data" + data);

                    if(data == 1) alertify.success("Relacion creada con éxito");
                    else alertify.error("Error al crear la relación2.");

                },
                error: function () {
                    alertify.error("Error al crear la relación.");
                }
            });
        });
    });     // FIN DOCUMENT READY
</script>
