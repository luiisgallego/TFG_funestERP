<div class="container-fluid">
    <div class="row page-header"><h1>Nuevo Servicio</h1></div>

    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevoServicio">

        <a href="#datos_basicos" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Básicos
        </a>

        <div id="datos_basicos" class="collapse in">
            <div class="form-group">
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
                <div class="col-md-2">
                    <label>DNI</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="DNI" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
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
                <div class="col-md-2">
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
            </div> <!-- form-group -->

            <div class="form-group">
                <div class="col-md-2">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="natural_de" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Provincia</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="provincia" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Calle</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="calle" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>Número</label>
                    <div class="input-group">
<!--                        <span class="input-group-addon"></span>-->
                        <input type="text" class="form-control" name="numero" placeholder=""/>
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
            </div><!-- form-group -->

            <div class="form-group">
                <div class="col-md-3">
                    <label class="j_hijo_de" text>Hijo de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="hijo_de_h" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="natural_de_hdh" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>y de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="hijo_de_m" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="natural_de_hdm" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Sexo</label>
                    <div class="input-group">
                        <select class="form-control j_sexo" name="sexo" title="sexo">
                            <option>Hombre</option>
                            <option>Mujer</option>
                        </select>
                    </div>

                </div>
            </div> <!-- form-group -->

            <div class="form-group">
                <div class="col-md-3">
                    <label>Fecha defunción</label>
                    <div class="input-group">
                        <span class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></span>
                        <input type="date" class="form-control" name="fecha_defuncion" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha entierro</label>
                    <div class="input-group">
                        <span class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></span>
                        <input type="date" class="form-control" name="fecha_entierro" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Hora entierro</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="time" class="form-control" name="hora_entierro" placeholder=""/>
                    </div>
                </div>
            </div>
        </div> <!-- #datos_basicos -->

        <a href="#datos_extra" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Esquela
        </a>

<!--        <div id="datos_extra" class="collapse in">-->
<!--            <div class="form-group">-->
<!--                <div class="col-md-6">-->
<!--                    <label>y de</label>-->
<!--                    <div class="input-group">-->
<!--                        <span class="input-group-addon"></span>-->
<!--                        <input type="text" class="form-control" name="hijo_de_m" placeholder=""/>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-6">-->
<!--                    <label>Natural de</label>-->
<!--                    <div class="input-group">-->
<!--                        <span class="input-group-addon"></span>-->
<!--                        <input type="text" class="form-control" name="natural_de_hdm" placeholder=""/>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">
            </div>
        </div>
    </form>

</div>

<script>
    $(".j_sexo").change(function () {
        var valor = $("#j_sexo").val();

        if(valor == "Hombre") $(".j_hijo_de").text("Hijo de");
        else $(".j_hijo_de").text("Hija de");
    });
</script>
