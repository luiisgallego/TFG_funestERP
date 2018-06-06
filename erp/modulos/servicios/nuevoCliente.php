<div class="container-fluid">
    <form id="formCliente" class="form-horizontal" method="post">
        <input type="hidden" name="op" value="nuevoCliente" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nuevo Cliente</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input id="btnNuevoCliente" type="button" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <!-- *************** BUSCADOR **************** -->
<!--                <div class="row busqueda">-->
<!--                    <div class="col-md-8 col-md-offset-3">-->
<!--                        <form class="navbar-form" role="search" method="post">-->
<!--                            <div class="form-group col-md-8">-->
<!--                                <input type="text" class="form-control" name="nuevoCliente" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">-->
<!--                            </div>-->
<!--                        </form>-->
<!--                        <div id="resBusqueda"> </div>-->
<!--                    </div>-->
<!--                </div> -->
                <!-- *************** FIN BUSCADOR **************** -->

                <div class="row">
                    <div class="col-md-5 col-md-offset-2">
                        <div class="panel panel-danger">
                            <div class="panel-heading info_seccion">
                                <i class="fa fa-caret-square-o-right"></i>Difuntos sin Cliente
                            </div>
                            <div class="panel-body">
                                <input type="text" class="form-control" name="nuevoCliente" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th style="width: 10px;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tBdody"></tbody>
                                </table>
                            </div> <!-- panel-body-->
                        </div> <!-- panel -->
                    </div>
                </div>

                <div class="cliente"> <?php include('../formularios/form_cliente.php'); ?> </div>

            </div> <!-- col-md-12 -->
        </div><!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script>
    window.onload = inicliente();

    function validarForm() {

        var nombre = $("#c_nombre");
        var cont = 0;
        var res = false;

        $('#tBdody input[type=checkbox]:checked').each(function () {
            cont++;
        });

        if(cont == 0) alertify.error("No has seleccionado ningun difunto");
        else if(cont > 1) alertify.error("Solo puedes seleccionar un difunto");
        else if(nombre.val() == "") {
            alertify.error("Faltan datos");
            nombre.focus();
        } else res = true;

        return res;
    }

    $(document).ready(function () {

        $("#btnNuevoCliente").click(function () {

            if(validarForm()) {
                $.ajax({
                    type: "POST",
                    url: "../../procesa.php",
                    data: $("#formCliente").serialize(),
                    success: function (data) {
                        if(data != "error") redirigeJS(data);
                    },
                    error: function (data) { alertify.error("error"); }
                });
            }
        });
    });

    function inicliente() {
        $.post("../../procesa.php", {op: "buscarDifunto_Disponible"}, function (mensaje) {
            console.log("eje");

            var json = JSON.parse(mensaje);
            var divBusqueda = $("#tBdody");

            /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
            var nombre = "c_id_dif";

            // Construimos la estructura para mostrarla
            for(i=0; i<json.length; i++){

                var estructura = "<tr>"+
                    "<td id='nom_dif'>" + json[i]['nombre']+ "</td>" +
                    "<td><input id='id_difunto' class='micheck' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></td>"+
                    "</tr>";
                divBusqueda.append(estructura);
            }
        });
    }
</script>
