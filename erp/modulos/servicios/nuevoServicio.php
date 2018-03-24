<div class="container-fluid">
    <div class="row page-header"><h1>Nuevo Servicio</h1></div>

    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevoServicio">

        <div class="seccion">
            <div class="info_seccion">
                <span><i class="fa fa-caret-square-o-right"></i>Datos Básicos</span>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="nombre" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Apellidos</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="apellidos" placeholder=""/>
                    </div>
                </div>
            </div> <!-- form-group -->
            <div class="form-group">
                <div class="col-md-3">
                    <label>Natural de</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="natural_de" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Provincia</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="provincia" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Calle</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="calle" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Número</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" name="numero" placeholder=""/>
                    </div>
                </div>
            </div><!-- form-group -->
        </div> <!-- seccion -->



        <div class="form-group">
            <div class="col-md-6">
                <label>Hijo de (simbolo hombre)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="hijo_de_h" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label>Natural de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="natural_de_hdh" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>y de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="hijo_de_m" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label>Natural de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="natural_de_hdm" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>Fecha nacimiento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="fecha_nacimiento" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label>Estado civil</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" name="estado_civil" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-5">
                <label>Fecha defunción</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control" name="fecha_defuncion" placeholder=""/>
                </div>
            </div>
            <div class="col-md-5">
                <label>Fecha entierro</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                    <input type="text" class="form-control" name="fecha_entierro" placeholder=""/>
                </div>
            </div>
            <div class="col-md-2">
                <label>Hora entierro</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control" name="hora_entierro" placeholder=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-6">
                <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">
            </div>
        </div>
    </form>

</div>

