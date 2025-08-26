$( buscar_datos() );

function buscar_datos( consulta ){
	$.ajax({
		url      : appData.uri_app + "../webservice/productos/getproductoropa",
		type     : "POST",
		dataType : "html",
		data     : {
			consulta : consulta,
			valor : appData.idusuario
		},
	})
	.done( function( respuesta ) {
        $( "#datos" ).html( respuesta );
	})
	.fail( function() {
		console.log( "error" );
	})

}


$(document).on( 'keyup' , '#caja_busqueda' , function() {
	var valor = $(this).val();
	buscar_datos(valor);
});