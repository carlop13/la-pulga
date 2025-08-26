$( document ).ready(function(){
borra_mensajes();

$("#btn-guardar").click(function(){

$(".form-group").keydown(borra_mensajes);
borra_mensajes();

let formato = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

if ($("#nombre").val()=="") {
		error_formulario("nombre","El nombre es requerído");

		return false;
	}

else if ($("#ap").val()=="") {
		error_formulario("ap","El apellido paterno es requerído");

		return false;
	}

else if ($("#am").val()=="") {
		error_formulario("am","El apellido materno es requerído");

		return false;
	}

else if ($("#correo").val()=="") {
		error_formulario("correo","El correo es requerído");

		return false;
	}

else if (!formato.test($("#correo").val())) {
		error_formulario("correo","El formato de correo es incorrecto");

		return false;
	}

else if ($("#password").val()=="") {
		error_formulario("password","La contraseña es requerída");

		return false;
	}

else if ($("#password").val().length < 8) {
		error_formulario("password","La contraseña debe contener por lo menos 8 caracteres");

		return false;
	}

else if ($("#ciudad").val()=="") {
		error_formulario("ciudad","La ciudad es requerída");

		return false;
	}

else if ($("#col").val()=="") {
		error_formulario("col","La colonia es requerída");

		return false;
	}

else if ($("#calle").val()=="") {
		error_formulario("calle","La calle es requerída");

		return false;
	}

else if ($("#ne").val()=="") {
		error_formulario("ne","El número exterior es requerído");

		return false;
	}

else if ($("#cp").val()=="") {
		error_formulario("cp","El CP es requerído");

		return false;
	}

else if ($("#cp").val().length !== 5) {
		error_formulario("cp","Ingresa un cp válido");

		return false;
	}

else if ($("#tel").val()=="") {
		error_formulario("tel","El teléfono es requerído");

		return false;
	}

else if ($("#tel").val().length !== 10) {
		error_formulario("tel","Ingresa un teléfono válido");

		return false;
	}

else{

 $.ajax({
        "url"   :   appData.uri_ws + "backend/registrausuario/",
        "dataType"  :   "json",
        "type"  :   "post",
        "data"  :   {
		"nombre" : $("#nombre").val(),
		"ap" : $("#ap").val(),
		"am" : $("#am").val(),
		"correo" : $("#correo").val(),
		"password" : $("#password").val(),
		"ciudad" : $("#ciudad").val(),
		"col" : $("#col").val(),
		"calle" : $("#calle").val(),
		"ni" : $("#ni").val(),
		"ne" : $("#ne").val(),
		"cp" : $("#cp").val(),
		"tel" : $("#tel").val()
	}

    })
    .done( function( obj ) {
        if (obj.resultado) {
		alert("success",obj.mensaje);
		setTimeout(function(){
			$(location).attr("href",appData.uri_app + "acceso/login/");
		},3000);
	}
	else{
		alert("danger", obj.mensaje);
	}
    })
    .fail( error_ajax );

}

});

});