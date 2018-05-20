
/**
 * Añade nueva linea dinámicamente en FORM_FAMILIARES
 */
var cont_parRolNombres = 1;
function addParRolNombres() {

    cont_parRolNombres++;
    var bloqueCompleto = document.createElement('li');
    bloqueCompleto.setAttribute('class', 'list-group-item');

    var bloqueRol =
        '<div class="col-md-2">' +
            '<label>Rol</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_rol_'+cont_parRolNombres+'" placeholder=""/>'+
            '</div>'+
        '</div>';
    var bloqueNombres =
        '<div class="col-md-8">' +
            '<label>Nombre</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_nombres_'+cont_parRolNombres+'" placeholder=""/>'+
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

function buscarDifunto(info) {
    var nombre = $(".busqueda input").val();
    console.log(nombre);
    console.log(info.name);

    if(nombre !== "") {
        $.post("../../procesa.php", {op: "buscarDifunto",nombreDifunto: nombre}, function (mensaje) {

            var json = JSON.parse(mensaje);
            var divBusqueda = $("#resBusqueda");
            divBusqueda.html(""); // Limpiamos si hay datos mostrados

            console.log(json);

            /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
            var nombre;
            if(info.name === "nuevoCliente") nombre = "c_id_dif";
            else if(info.name === "nuevaEsquela") nombre = "f_id_dif";  // FAMILIARES

           // Construimos la estructura para mostrarla
            for(i=0; i<json.length; i++){

                // Para cada difunto, buscar si tiene ya su Esquela o Recordatoria correspondiente
                // Si la tiene no mostrar
                //

                var estructura = "<div class='row'>" +
                    "<div class='col-md-5 col-md-offset-1' id='nom_dif'>" + json[i]['nombre']+ "</div>" +
                    "<div class='col-md-2'><input type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></div>" +
                    "</div>";
                divBusqueda.append(estructura);
            }
        });
    } else {
        $("#resBusqueda").html("");
    }
}

<!-- ******************************************************* -->


function buscarDifunto2(info) {
    var nombre = $(".busqueda input").val();
    console.log(nombre);
    console.log(info.name);

    if(nombre !== "") {
        $.post("../../procesa.php", {op: "buscarDifunto",nombreDifunto: nombre}, function (mensaje) {

            var json = JSON.parse(mensaje);
            var divBusqueda = $("#resBusqueda");
            divBusqueda.html(""); // Limpiamos si hay datos mostrados

            console.log(json);

            /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
            var nombre;
            if(info.name === "nuevoCliente") nombre = "c_id_dif";
            else if(info.name === "nuevaEsquela") nombre = "f_id_dif";  // FAMILIARES

            // Construimos la estructura para mostrarla
            for(i=0; i<json.length; i++){

                // Para cada difunto, buscar si tiene ya su Esquela o Recordatoria correspondiente
                // Si la tiene no mostrar
                //

                var estructura = "<div class='row'>" +
                                    "<div class='col-md-5 col-md-offset-1'>" + json[i]['nombre']+ "</div>" +
                                    "<div class='col-md-2'>" +
                                        "<input id='id_dif' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' />" +
                                        "<input id='nom_dif' type='hidden' name='"+nombre+"' value='"+json[i]['nombre']+"' />" +
                                    "</div>" +
                                "</div>";
                divBusqueda.append(estructura);
            }
        });
    } else {
        $("#resBusqueda").html("");
    }
}















