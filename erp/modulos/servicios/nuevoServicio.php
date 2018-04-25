<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevoServicio" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nuevo Servicio</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#datos_basicos" class="info_seccion" data-toggle="collapse">
                            <i class="fa fa-caret-square-o-right"></i>Datos Básicos
                        </a>
                    </div> <!-- panel-heading -->
                    <div id="datos_basicos" class="panel-body collapse in">
                        <ul class="list-group diseño_formulario">
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="nombre" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Apellidos</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="apellidos" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>DNI</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="DNI" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo Servicio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="tipo_servicio" title="tipo servicio">
                                            <option>Particular</option>
                                            <option>Compañia</option>
                                            <option>Recepción</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Natural de</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="natural_de" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Provincia</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="provincia" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Calle</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="calle" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Número</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="numero" placeholder=""/>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Tanatorio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="tanatorio" title="tanatorio">
                                            <option>No</option>
                                            <option>Sala 1</option>
                                            <option>Sala 2</option>
                                            <option>Sala 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha nacimiento</label>
                                    <div class="input-group ">
                                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                                        <input type="date" class="form-control" name="fecha_nacimiento" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Estado civil</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="estado_civil" title="estado civil">
                                            <option>Casado</option>
                                            <option>Viudo</option>
                                            <option>Soltero</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- #datos_basicos panel-body -->
                </div> <!-- panel -->

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#datos_familiares" class="info_seccion" data-toggle="collapse">
                            <i class="fa fa-caret-square-o-right"></i>Datos Familiares ( Esquela )
                        </a>
                    </div> <!-- panel-heading -->
                    <div id="datos_familiares" class="panel-body collapse in">

                    </div> <!-- #datos_familiares panel-body -->
                </div> <!-- panel -->

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script>
    $(".j_sexo").change(function () {
        var valor = $("#j_sexo").val();

        if(valor == "Hombre") $(".j_hijo_de").text("Hijo de");
        else $(".j_hijo_de").text("Hija de");
    });
</script>
