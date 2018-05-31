<?php
@session_start();
require '../../config/API_Global.php';
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Luis Gallego Quero">
    <title>FunestERP</title>
    <link rel="icon" href="../../img/favicon.ico">

    <!-- Bootstrap -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link href="../css/estilosERP.css" rel="stylesheet">
    <!-- FontAwesome Icons (http://fontawesome.io) -->
    <link href="../../bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
    <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
    <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/metisMenu/metisMenu.min.js"></script>
    <script src="../js/metisMenuNavegacion.js"></script>

    <!-- ALERTIFY -->
    <link rel="stylesheet" href="../js/alertify/css/alertify.min.css">
    <link rel="stylesheet" href="../js/alertify/css/themes/default.min.css">
    <script src="../js/alertify/alertify.min.js"></script>

    <!-- CALENDAR -->
    <link href='../fullcalendar/fullcalendar.css' rel='stylesheet' />
    <script src='../fullcalendar/lib/moment.min.js'></script>
    <script src='../fullcalendar/lib/jquery-ui.min.js'></script>
    <script src='../fullcalendar/fullcalendar.js'></script>
    <script src='../fullcalendar/locale-all.js'></script>

    <style>
        #wrap2 {
            /*width: 1100px;*/
            margin: auto;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 14px;
            font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
        }
        #calendar {
             margin: auto;
             width: 1000px;
             background-color: rgba(71, 255, 207, 0.15);
             border-radius: 6px;
             box-shadow: 0 1px 2px #C3C3C3;
        }

        #calendar .fc-toolbar.fc-header-toolbar {
            margin-bottom: 20px;
            padding-top: 20px;
        }

        #calendar .fc-toolbar .fc-right {
            margin-right: 30px;
        }

         #calendar .fc-toolbar .fc-left h2 {
            margin-left: 30px;
        }
    </style>

</head>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top navGlobal" role="navigation" style="margin-bottom: 0">
            <?php include "./navSuperior.php"; ?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li><a href="../index.php"><i class="fa fa-home fa-fw"></i>Home</a></li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard fa-fw"></i>Servicios
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="../modulos/servicios/main.php?op=defunciones">Defunciones</a></li>
                                <li><a href="../modulos/servicios/main.php?op=clientes">Clientes</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard fa-fw"></i>Documentos
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="../modulos/documentos/main.php?op=esquelas">Esquelas</a></li>
                                <li><a href="../modulos/documentos/main.php?op=recordatorias">Recordatorias</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard fa-fw"></i>Contabilidad
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="../modulos/contabilidad/main.php?op=facturas">Facturas</a></li>
                            </ul>
                        </li>

                        <li><a href="../modulos/agenda.php"><i class="fa fa-calendar fa-fw"></i>Agenda</a></li>

                        <li>
                            <a href="#">
                                <i class="fa fa-envelope-square fa-fw"></i>Correo
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="#">Nuevo</a></li>
                                <li><a href="#">Bandeja entrada</a></li>
                                <li><a href="#">Bandeja salida</a></li>
                                <li><a href="#">Borradores</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> <!-- FIN NAVEGACION -->
    </div> <!-- FIN WRAPPER -->

    <div id="page-wrapper">

        <!-- CALENDAR -->
        <div id='wrap2'>
            <div id='calendar'></div>
            <div style='clear:both'></div>
        </div>

        <!-- Formulario Eventos -->
        <div class="modal fade" id="modalAgenda" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header"> <h4 class="modal-title">Nuevo Evento</h4> </div>
                    <div class="modal-body">
                        <form id="form_crea_evento">
                            <label>Descripcion:</label><input id="ag_nombre" type="text" class="form-control" name="ag_nombre" placeholder="" />
                            <div class="tipoFecha"  style="margin-top: 10px;">
                                <label>Tipo Fecha:</label>
                                <div class="row">
                                    <div class="col-md-6"><button id="ag_allDay" type="button" class="btn btn-info" onclick="tipoFechaAgenda(this);">Todo el dia</button></div>
                                    <div class="col-md-6"><button id="ag_noAllDay" type="button" class="btn btn-info" onclick="tipoFechaAgenda(this);">Fecha y hora</button></div>
                                </div>
                            </div>
                            <div id="fechaOnly" class="hidden">
                                <label>Fecha:</label>
                                <input id="ag_fechaOnly" type="date" class="form-control" name="ag_fechaOnly" placeholder="" />
                            </div>
                            <div id="fechaYhora" class="hidden">
                                <label>Fecha y hora:</label>
                                <input id="ag_fechaYhora" type="datetime-local" class="form-control" name="ag_fechaYhora" placeholder="" />
                            </div>
                        </form>
                    </div><!-- Fin Modal Body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="aniadirEvento" style="float: left;">Añadir Evento</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- fin page-wrapper -->

    <script>

        $(document).ready(function() {

            /*      Creamos ahora el calendario
             -----------------------------------------------------------------*/

            var calendario = $('#calendar').fullCalendar({

                header: {
                    left: 'title',
                    center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },

                // OPCIONES
                locale: 'es',
                editable: true,         // Para mover los eventos de dia (aun nose si algo mas)
                firstDay: 1,            // 1(Monday) this can be changed to 0(Sunday) for the USA system
    //            selectable: true,     // Para poder seleccionar varios dias a la vez
                defaultView: 'month',   // Vista por defecto mes
                axisFormat: 'h:mm',
                allDaySlot: true,      // Para mostrar el apartado "all day" en dia
                selectHelper: true,
                droppable: true,        // Para que se pueda arrastar externamente

                // Cargamos en el calendario los mapas guardados en la BD
                //events: eventos
            });

            /*      Diferentes funciones para trabajar con el calendario
             -----------------------------------------------------------------*/

            var calendar = calendario.fullCalendar('getCalendar'); // Tomamos la referencia del calendario activo

            // Primero cargamos la info almacenada en la BD para
            // mostrar los eventos guardados
            $.ajax({
                type: "POST",
                url: "../procesa.php",
                data: { op: "ag_getEvents" },
                success: function (data) {
                    var eventos = [];
                    info = JSON.parse(data);

                    for(var i=0; i<info.length; i++){
    //                    eventos.push(info[i]);
                        var title = info[i].title;
                        var start = info[i].start;
                        var allDay = (info[i].allDay == 1) ? true : false;

                        calendario.fullCalendar('renderEvent', {    // Añadimos al calendario
                            title: title,
                            start: start,
                            allDay: allDay
                        });
                    }
                },
                error: function () {
                    alertify.error("Error lectura BD.");
                }
            });

            // Funcion para lanzar el modal al hacer click en el calendario
            calendar.on('dayClick', function (date, allDay, jsEvent, view) {

                // Ajustamos el form a su estado por defecto
                $("#form_crea_evento")[0].reset();
                $(".tipoFecha").removeClass("hidden");
                $("#fechaOnly").addClass("hidden");
                $("#fechaYhora").addClass("hidden");

                $("#modalAgenda").modal();      // Lazamos el modal
            });

            // Funcion para trabajar con el formulario del modal
            $("#aniadirEvento").click(function () {

                $("#modalAgenda").modal('hide');    // Ocultamos el modal

                var nombre = $("#ag_nombre").val();
                var fechaOnly = $("#ag_fechaOnly").val();
                var fechaYhora = $("#ag_fechaYhora").val();

                // Validamos
                if(nombre != "") {
                    if(fechaOnly != "" || fechaYhora != ""){

                        var start = (fechaOnly != "") ? fechaOnly : fechaYhora;
                        var allDay = (fechaOnly != "") ? true : false;
                        var allDayBD = (fechaOnly != "") ? 1 : 0;

                        $.ajax({
                            type: "POST",
                            url: "../procesa.php",
                            data: {
                                op: "ag_addEvent",
                                title: nombre,
                                start: start,
                                allDay: allDayBD
                            },
                            success: function (data) {

                                calendario.fullCalendar('renderEvent', {    // Añadimos al calendario
                                    title: nombre,
                                    start: start,
                                    allDay: allDay,
                                });

                                if(data == 1) alertify.success("Nuevo evento añadido");
                                else alertify.error("Error al crear la relación2.");
                            },
                            error: function () {
                                alertify.error("Error.");
                            }
                        });

                    } else alertify.error("Error 2. Faltan campos por rellenar");
                } else alertify.error("Error 1. Faltan campos por rellenar");

            });

            calendar.on('select', function (start, end, allDay) {   // Descomentar  selectable: true
                var title = prompt('Titulo del nuevo evento:');
                    if (title) {

                        calendario.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                        );
                    }
                    calendario.fullCalendar('unselect');
            });

            calendar.on('drop', function(date, allDay) { // this function is called when something is dropped
                alert("drop");
                // retrieve the dropped element's stored Event Object
    //                var originalEventObject = $(this).data('eventObject');
    //
    //                // we need to copy it, so that multiple events don't have a reference to the same object
    //                var copiedEventObject = $.extend({}, originalEventObject);
    //
    //                // assign it the date that was reported
    //                copiedEventObject.start = date;
    //                copiedEventObject.allDay = allDay;
    //
    //                // render the event on the calendar
    //                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    //                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
    //
    //                // is the "remove after drop" checkbox checked?
    //                if ($('#drop-remove').is(':checked')) {
    //                    // if so, remove the element from the "Draggable Events" list
    //                    $(this).remove();
    //                }
            });

        });

        // Para mostrar un tipo de fecha en funcion de la seleccion en el modal
        function tipoFechaAgenda(datos) {

            $(".tipoFecha").addClass("hidden");                         // Ocultamos la seleccion del tipo fecha

            if(datos.id == "ag_allDay") {
                $("#fechaOnly").removeClass("hidden");      // Añadimos el div de all Day
            } else if(datos.id == "ag_noAllDay") {
                $("#fechaYhora").removeClass("hidden");      // Añadimos el div de all Day
            }
        }

    </script>

</body>
</html>
