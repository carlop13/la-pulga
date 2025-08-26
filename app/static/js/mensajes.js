function error_formulario(campo,mensaje){
	$("#" + campo ).addClass("is-invalid");
	$("#group-"+campo).append('<div class="invalid-feedback">'+mensaje+'</div>');

	$("#" + campo).focus();
}

function borra_mensajes() {
	$( ".is-invalid" ).removeClass( "is-invalid" );
	$( ".invalid-feedback" ).remove();
}

function error_ajax() {
	alert( "danger", "Error en AJAX" );
}


function alert( tipo, mensaje ) {
	switch( tipo ) {
		case "success":
			icono = "fa-check-circle";
			break;

		case "primary":
		icono = "fa-check-circle";
			break;
		case "secondary":
		icono = "fa-check-circle";
			break;
		case "light":
		icono = "fa-check-circle";
			break;
		case "dark":
		icono = "fa-check-circle";
			break;
		case "info":
			icono = "fa-info-circle";
			break;

		case "warning":
			icono = "fa-exclamation-triangle";
			break;

		case "danger":
			icono = "fa-ban";
			break;

	}
	$("#mensajee").append(
  '<div class="alert alert-' + tipo +
    ' alert-dismissible col col-md-10 p-3" role="alert">' +
    '<i class="fas ' + icono + ' fa-2x"></i> ' +
    mensaje +
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
  '</div>'
);


	setTimeout( function() {
		$( ".alert-dismissible" ).fadeOut( 1000 );
	}, 7000 );
}

function fecha_fancy(sFecha){
	//Convierte un String en arreglo
	aFecha = sFecha.split("-");

	aMes= ["ene","feb","mar","abr","may","jun",
			"jul","ago","sep","oct","nov","dic"]

	return aFecha[2]+ " " + aMes[aFecha[1]-1]+" "+aFecha[0];
}