<!-- ****************       FAMILIARES       ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_familiares" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Familiares
        </a>
    </div> <!-- panel-heading -->
    <div id="form_familiares" class="panel-body collapse in">
        <?php if($editar === true) { ?>
            <input type="hidden" name="f_id_dif" value="<?= $estructura['difunto']->id ?>" />
            <input type="hidden" name="f_id_fam" value="<?= $estructura['id_fam'] ?>" />
        <?php } ?>
        <ul id="parRolNombre" class="list-group diseño_formulario">
            <?php if($editar === true) {
                $cont=0;
                foreach ($estructura['familiares'] as $valor) { ?>
                    <li class="list-group-item">
                        <div class="col-md-2">
                            <label>Rol</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="f_rol<?= $cont ?>1" value="<?= $valor->rol ?>" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label>Nombres</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="f_nombres<?= $cont ?>1" value="<?= $valor->nombres ?>" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label></label>
                            <div class="input-group">
                                <input type="button" class="btn btn-success" value="+" onclick="addParRolNombres()" />
                            </div>
                        </div>
                    </li>
                <?php $cont++; }
            } else { ?>
                <li class="list-group-item">
                    <div class="col-md-2">
                        <label>Rol</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input id="f_rol_1" type="text" class="form-control" name="f_rol_1" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label>Nombres</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input id="f_nombres_1" type="text" class="form-control" name="f_nombres_1" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="input-group">
                            <input type="button" class="btn btn-success" value="+" onclick="addParRolNombres()" />
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div> <!-- #form_facturas panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN  FACTURAS       ************************* -->
