<!-- ****************       FAMILIARES       ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_familiares" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Familiares
        </a>
    </div> <!-- panel-heading -->
    <div id="form_familiares" class="panel-body collapse in">
<!--        <input type="hidden" name="f_id_dif" />-->
        <ul id="parRolNombre" class="list-group diseño_formulario">
            <li class="list-group-item">
                <div class="col-md-2">
                    <label>Rol</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="f_rol_1" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-8">
                    <label>Nombres</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="f_nombres_1" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label></label>
                    <div class="input-group">
                        <input type="button" class="btn btn-success" value="+" onclick="addParRolNombres()" />
                    </div>
                </div>
            </li>
        </ul>
    </div> <!-- #form_servicio panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN  FAMILIARES       ************************* -->
