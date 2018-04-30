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
                        <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Apellidos</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="apellidos" value="<?= $datos->apellidos ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>DNI</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="DNI" value="<?= $datos->dni ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Tipo Servicio</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="tipo_servicio" title="tipo servicio">
                            <!--                                                <option value="Particular">Particular</option>-->
                            <!--                                                <option value="Compañia">Compañia</option>-->
                            <!--                                                <option value="Recepción">Recepción</option>-->
                            <?php
                            $estados = array('Particular', 'Compañia', 'Recepción');
                            foreach ($estados as $estado){
                                if($estado == $datos->tipo_servicio) echo '<option selected="selected">' .$estado. '</option>';
                                else echo '<option>' .$estado. '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="natural_de" value="<?= $datos->poblacion ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Provincia</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="provincia" value="<?= $datos->provincia ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Calle</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="calle" value="<?= $datos->calle ?>" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Número</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="numero" value="<?= $datos->numero ?>" />
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Tanatorio</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="tanatorio" title="tanatorio">
                            <?php
                            $estados = array('No', 'Sala 1', 'Sala 2', 'Sala 3');
                            foreach ($estados as $estado){
                                if($estado == $datos->tanatorio) echo '<option selected="selected">' .$estado. '</option>';
                                else echo '<option>' .$estado. '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha nacimiento</label>
                    <div class="input-group ">
                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                        <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $datos->fecha_nacimiento ?>" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Estado civil</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="estado_civil" title="estado civil">
                            <?php
                            $estados = array('Casado', 'Viudo', 'Soltero');
                            foreach ($estados as $estado){
                                if($estado == $datos->estado_civil) echo '<option selected="selected">' .$estado. '</option>';
                                else echo '<option>' .$estado. '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
            </li>
        </ul>
    </div> <!-- #datos_basicos panel-body -->
</div> <!-- panel -->