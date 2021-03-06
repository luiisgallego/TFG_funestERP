<?php if($editar_esquela === true || $editar_factura === true) $difunto = $estructura['difunto']; ?>

<!-- ****************    DIFUNTO      ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_difunto" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Difunto
        </a>
    </div> <!-- panel-heading -->
    <div id="form_difunto" class="panel-body collapse in">
        <?php if($editar === true) { ?>
            <input type="hidden" name="d_id" value="<?= $difunto->id ?>" />
        <?php } ?>
        <ul class="list-group diseño_formulario">
            <li class="list-group-item">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input id="d_nombre" type="text" class="form-control" name="d_nombre" value="<?= $difunto->nombre ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>DNI</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_dni" value="<?= $difunto->dni ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Sexo</label>
                    <div class="input-group">
                        <select class="form-control d_sexo" name="d_sexo" title="sexo">
                            <?php if($editar === false) { ?>
                                <option>Hombre</option>
                                <option>Mujer</option>
                            <?php } else {
                                $estados = array('Hombre', 'Mujer');
                                foreach ($estados as $estado){
                                    if($estado == $difunto->sexo) echo '<option selected="selected">' .$estado. '</option>';
                                    else echo '<option>' .$estado. '</option>';
                                }
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
                        <input type="text" class="form-control" name="d_poblacion" value="<?= $difunto->poblacion ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Provincia</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_provincia" value="<?= $difunto->provincia ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Calle</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_calle" value="<?= $difunto->calle ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Número</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="number" class="form-control" name="d_numero" value="<?= $difunto->numero ?>" placeholder=""/>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Código Postal</label>
                    <div class="input-group ">
                        <span class="input-group-addon"></span>
                        <input type="number" class="form-control" name="d_codigo_postal" value="<?= $difunto->codigo_postal ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha nacimiento</label>
                    <div class="input-group ">
                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                        <input type="date" class="form-control" name="d_fecha_nacimiento" value="<?= $difunto->fecha_nacimiento ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Estado civil</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <select class="form-control" name="d_estado_civil" title="estado civil">
                            <?php if($editar === false) { ?>
                                <option>Casado</option>
                                <option>Viudo</option>
                                <option>Soltero</option>
                            <?php } else {
                                $estados = array('Casado', 'Viudo', 'Soltero');
                                foreach ($estados as $estado){
                                    if($estado == $difunto->estado_civil) echo '<option selected="selected">' .$estado. '</option>';
                                    else echo '<option>' .$estado. '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Nombre Pareja</label>
                    <div class="input-group ">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_nombre_pareja" value="<?= $difunto->nombre_pareja ?>" placeholder=""/>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label class="d_hijo_de">Hijo de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_hijo_de" value="<?= $difunto->hijo_de ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_poblacion2" value="<?= $difunto->poblacion2 ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Y de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_hijo_de2" value="<?= $difunto->hijo_de2 ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="d_poblacion3" value="<?= $difunto->poblacion3 ?>" placeholder=""/>
                    </div>
                </div>
            </li>
        </ul>
    </div> <!-- #form_difunto panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN DIFUNTO      ************************* -->
