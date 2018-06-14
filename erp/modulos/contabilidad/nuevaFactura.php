<div class="container-fluid">
<!--    <form class="form-horizontal" method="post" action="../../procesa.php">-->
    <form id="formFacturas" class="form-horizontal" method="post">
        <input type="hidden" name="op" value="nuevaFactura" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nueva Factura</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input id="btnNuevaFactura" type="button" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <div class="row busqueda">
                    <div class="col-md-4 col-md-offset-3">
                        <div class="panel panel-danger">
                            <div class="panel-heading info_seccion">
                                <i class="fa fa-caret-square-o-right"></i>Difuntos sin Factura
                            </div>
                            <div class="panel-body">
                                <input type="text" class="form-control" name="nuevaFactura" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">
                                <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th style="width: 10px;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tBdody"></tbody>
                                </table>
                            </div> <!-- panel-body-->
                        </div> <!-- panel -->
                    </div>
                </div>

                <div class="familiares"> <?php include('../formularios/form_facturas.php'); // T ?> </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script src="../func_aux.js"></script>
<script>

    $(document).ready(function () {

        $("#btnNuevaFactura").click(function () {

            if(validarFormFactura()) {
                $.ajax({
                    type: "POST",
                    url: "../../procesa.php",
                    data: $("#formFacturas").serialize(),
                    success: function (data) {
                        if(data != "error") redirigeJS(data);
                        else alertify.error("La inserción ha fallado.");
                    },
                    error: function (data) { alertify.error("error"); }
                });
            }
        });
    });

</script>
