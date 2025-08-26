$(document).ready(function(){

$("#btn-eliminar").click(function(){ 
		$.ajax({
			"url"  : appData.uri_ws+"backend/deleteusuario/",
			"dataType": "json",
			"type":"post",
			"data": {
				"id_usu" : appData.id_usu,
				"id_cli" : appData.idusuario
			}
		})
		.done(function(obj){
		if (obj!="hola") {
		alert("success",obj);
		setTimeout(function(){
			$(location).attr("href",appData.uri_app + "acceso/cierrasesion/"+appData.id_usu+"/"+appData.token);
		},3000);
	}
			
		})
		.fail(error_ajax);
		
	});

	setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);

});//FIN DEL READY

