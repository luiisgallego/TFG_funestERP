
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

function buscarCliente() {
    var nombre = $("input[name=busqueda]").val();

    if(nombre !== "") {
        $.post("../../procesa.php", {op: "buscarCliente",nombreDifunto: nombre}, function (mensaje) {

//                $("#resBusqueda").html("<p>" +mensaje+ "</p>");
            console.log("RETURN");
            var json = JSON.parse(mensaje);
            if(json == "") $("#resBusqueda").html("<p>NOTHING</p>");
            console.log(json);
            $("#resBusqueda").html("<pre>"+ json[0]['nombre'] +"</pre>");
        });
    } else {
        $("#resBusqueda").html("<p>NOTHING</p>");
    }
}

<!-- ******************************************************* -->
