<?php
@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
//include_once('./func_servicios.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('../head_main.php'); ?>
    </head>
    <body>

        <?php include "../navModulos.php"; ?>
        <div id="page-wrapper">

            <div class="modal fade" id="modalNuevoMensaje" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Nuevo Mensaje</h4>
                        </div>

                        <div class="modal-body">
                            <label>Dirección:</label><input id="co_direccion" type="email" class="form-control" name="co_direccion" placeholder="" />
                            <label>Asunto:</label><input id="co_asunto" type="text" class="form-control" name="co_asunto" placeholder="" />
                            <label>Mensaje:</label><input id="co_mensaje" type="text" class="form-control" name="co_mensaje" style="height: 150px;" placeholder="" />
                        </div><!-- Fin Modal Body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" id="enviarMensaje" style="float: left;">Enviar Mensaje</button>
<!--                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
                        </div>
                    </div>

                </div>
            </div>

        </div> <!-- fin page-wrapper -->

        <script type="text/javascript">

            $(document).ready(function() {

                // Al cargar abrimos el modal
                $("#modalNuevoMensaje").modal();

                $("#enviarMensaje").click(function () {

                    var direccion = $("#co_direccion").val();
                    var asunto = $("#co_asunto").val();
                    var mensaje = $("#co_mensaje").val();

                    if(direccion != ""){
                        if(validar_email(direccion)) {
                           if(mensaje != "") {

                               $.ajax({
                                   type: "POST",
                                   url: "./procesaMail.php",
                                   data: {
                                       direccion: direccion,
                                       asunto: asunto,
                                       mensaje: mensaje
                                   },
                                   success: function (data) {

                                       console.log(data);

                                       if(data == 1) alertify.success("Mensaje Enviado");
                                       else alertify.error("Error al enviar: " + data);
                                   },
                                   error: function () {
                                       alertify.error("Error.");
                                   }
                               });

                           } else alertify.error("Mensaje vacio");
                        } else alertify.error("Dirección no valida.");
                    } else alertify.error("Dirección vacia.");

                });

            });

            function validar_email( email ) {

                var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                return regex.test(email) ? true : false;

            }

        </script>

    </body>

</html>
