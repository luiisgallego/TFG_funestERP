<!-- ****************       SERVICIO       ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_servicio" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Servicio
        </a>
    </div> <!-- panel-heading -->
    <div id="form_servicio" class="panel-body collapse">
        <?php if($editar === true) { ?>
            <input type="hidden" name="s_id" value="<?= $servicio->id ?>" />
        <?php } ?>
        <input type="hidden" name="s_id_dif" value="<?= $servicio->id_dif ?>" />
        <ul class="list-group diseño_formulario">
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Fecha Defunción</label>
                    <div class="input-group ">
                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                        <input type="date" class="form-control" name="s_fecha_defuncion" value="<?= $servicio->fecha_defuncion ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Hora Defunción</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="time" class="form-control" name="s_hora_defuncion" value="<?= $servicio->hora_defuncion ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha Entierro</label>
                    <div class="input-group ">
                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                        <input type="date" class="form-control" name="s_fecha_entierro" value="<?= $servicio->fecha_entierro ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Hora Entierro</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="time" class="form-control" name="s_hora_entierro" value="<?= $servicio->hora_entierro ?>" placeholder=""/>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Población Entierro</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="s_poblacion_entierro" value="<?= $servicio->poblacion_entierro ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha Misa</label>
                    <div class="input-group ">
                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                        <input type="date" class="form-control" name="s_fecha_misa" value="<?= $servicio->fecha_misa ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Hora Misa</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="time" class="form-control" name="s_hora_misa" value="<?= $servicio->hora_misa ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Tanatorio</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="s_tanatorio" title="tanatorio">
                            <?php if($editar === false) { ?>
                                <option>No</option>
                                <option>Sala 1</option>
                                <option>Sala 2</option>
                                <option>Sala 3</option>
                            <?php } else {
                                $estados = array('No', 'Sala 1', 'Sala 2', 'Sala 3');
                                foreach ($estados as $estado){
                                    if($estado == $servicio->tanatorio) echo '<option selected="selected">' .$estado. '</option>';
                                    else echo '<option>' .$estado. '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Tipo Servicio</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="s_tipo_servicio" title="tipo_servicio">
                            <?php if($editar === false) { ?>
                                <option>Particular</option>
                                <option>Compañia</option>
                                <option>Recepción</option>
                                <option>Tanatorio</option>
                            <?php } else {
                                $estados = array('Particular', 'Compañia', 'Recepción', 'Tanatorio');
                                foreach ($estados as $estado){
                                    if($estado == $servicio->tipo_servicio) echo '<option selected="selected">' .$estado. '</option>';
                                    else echo '<option>' .$estado. '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Compañia</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="s_compañia" title="compañia">
                            <?php if($editar === false) { ?>
                                <option>Preventiva</option>
                                <option>Santa Lucía</option>
                                <option>Mapre</option>
                            <?php } else {
                                $estados = array('Preventiva', 'Santa Lucía', 'Mapre');
                                foreach ($estados as $estado){
                                    if($estado == $servicio->tipo_servicio) echo '<option selected="selected">' .$estado. '</option>';
                                    else echo '<option>' .$estado. '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label></label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label></label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="" placeholder=""/>
                    </div>
                </div>
            </li>
        </ul>
    </div> <!-- #form_servicio panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN  SERVICIO       ************************* -->