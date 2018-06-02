<?php
@session_start();
require '../../../config/API_Global.php';
include_once('../../funciones.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'funerariagallego@gmail.com';
$password = '2031994m';

$inbox = imap_open($hostname,$username,$password) or die('Ha fallado la conexión: ' . imap_last_error());

$fecha ="01-JUN-2018";
$emails = imap_search($inbox,'SINCE "'.$fecha.'"');

$estructura = [];
$cont = 1;
if($emails) {

    foreach($emails as $email_number) {
        $overview = imap_fetch_overview($inbox,$email_number,0);
        $mensaje = imap_fetchbody($inbox,$email_number,2);

        $aux = [
            "id" => $cont,
            "asunto" => $overview[0]->subject,
            "remitente" => $overview[0]->from,
            "fecha" => $overview[0]->date,
            "mensaje" => $mensaje
        ];

        $_SESSION['correos'][$cont] = $aux;
        array_push($estructura, $aux);
        $cont++;
    }
}
imap_close($inbox);

//file_put_contents (__DIR__."/SOMELOG.log" , print_r($_SESSION, TRUE).PHP_EOL, FILE_APPEND );
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('../head_main.php'); ?>
</head>
    <body>

        <?php include "../navModulos.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row page_header">
                    <div class="col-md-3"><h1>Bandeja de Entrada</h1></div>
                    <div class="col-md-2 col-md-offset-1">
                        <button id="nuevoMensaje" type="button" class="btn btn-primary btn-lg btn-block" >Nuevo Mensaje</button>
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
                                            <th>Remitente</th>
                                            <th>Asunto</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php foreach($estructura as $mensaje) { ?>
                                                <tr>
                                                    <td style="width: 50px;">
                                                        <a href="./mensaje.php?id=<?= $mensaje['id'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                                    </td>
                                                    <td><?=  $mensaje['asunto']; ?></td>
                                                    <td><?=  $mensaje['remitente']; ?></td>
                                                    <td><?=  $mensaje['fecha']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                </table>
                            </div> <!-- panel-body-->
                        </div> <!-- panel -->
                    </div> <!-- col-md-12 -->
                </div> <!-- page_content -->
            </div> <!--  container-fluid -->

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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div> <!-- #modalNuevoMensaje -->
        </div> <!-- fin page-wrapper -->

        <script type="text/javascript">
            $(document).ready(function() {

                $("#nuevoMensaje").click(function () {
                    $("#modalNuevoMensaje").modal();
                });
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
