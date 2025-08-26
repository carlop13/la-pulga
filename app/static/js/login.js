//LOGIN 

$(document).ready(function(){


//LOGIN
$("#btn-entrar").click(function(){
$(".form-group").keydown(borra_mensajes);
borra_mensajes();

let formato = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;


if ($("#correo").val()=="") {
		error_formulario("correo","El correo es requerído");

		return false;
	}
else if (!formato.test($("#correo").val())) {
		error_formulario("correo","El formato de correo es incorrecto");

		return false;
	}
else if ($("#contrasenia").val()=="") {
		error_formulario("contrasenia","La contraseña es requerído");

		return false;
	}
	else{

$.ajax({
	"url": appData.uri_ws+"backend/verificausuario/",
	"dataType" : "json",
	"type" : "post",
	"data" : {
		"correo" : $("#correo").val(),
		"contrasenia" : $("#contrasenia").val()
	}
})
.done(function(obj){

	if (obj.resultado) {
		var contra = $("#contrasenia").val();
		alert("success",obj.mensaje);
		setTimeout(function(){
			$(location).attr("href",appData.uri_app + "acceso/inicio/"+obj.id_usu+"/"+obj.token+"/"+obj.nomus+"/"+obj.correo+"/"+obj.id_cli+"/"+contra+"/"+obj.tipo+"/"+obj.nomcli);
		},2000);
	}
	else{
		alert("danger", obj.mensaje);
	}

})
.fail(error_ajax);
return true
}


});

});