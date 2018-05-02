
/**
 * Añade nueva linea dinámicamente en FORM_FAMILIARES
 */
//var cont_parRolNombres = 1;
function addParRolNombres() {

   // cont_parRolNombres++;
    var bloqueCompleto = document.createElement('li');
    bloqueCompleto.setAttribute('class', 'list-group-item');

    var bloqueRol =
        '<div class="col-md-2">' +
            '<label>Rol</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_rol" placeholder=""/>'+
            '</div>'+
        '</div>';
    var bloqueNombres =
        '<div class="col-md-8">' +
            '<label>Nombre</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_nombres" placeholder=""/>'+
            '</div>'+
        '</div>';

    bloqueCompleto.innerHTML = bloqueRol + bloqueNombres;
    document.getElementById('parRolNombre').appendChild(bloqueCompleto);
}
<!-- ******************************************************* -->

/**
 * JQUERY para ajustar los FORM en funcion del sexo
 */
var valor = $(".d_sexo");
valor.change(function () {

    if(valor.val() === "Hombre") $(".d_hijo_de").text("Hijo de");
    else $(".d_hijo_de").text("Hija de");
});
<!-- ******************************************************* -->

function buscarDifunto_Cliente() {
    var nombre = $("input[name=busqueda]").val();

    if(nombre !== "") {
        $.post("../../procesa.php", {op: "buscarDifunto_Cliente",nombreDifunto: nombre}, function (mensaje) {

            /*
            Actualmente arriesgamos a tener una sola coincidencia final. Hay que hacer más precisa esta lógica.
            Una buena resolución seria listar las opciones y poder seleccionar la que queramos, posteriormente
            guardar los datos de solo esta.
             */

            var json = JSON.parse(mensaje);

            if(json.length === 1) $("#resBusqueda").html("<input type='hidden' name='c_id_diff' value='"+json[0]['id']+"' />");
            // $("#resBusqueda").html("<pre>"+ json[0]['nombre'] +"</pre>");
        });
    } else {
        //$("#resBusqueda").html("<p>NOTHING</p>");
    }
}

<!-- ******************************************************* -->
