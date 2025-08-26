var mapa, marcador, centro;

$(document).ready(function(){

 
//click del boton guardar
$("#btn-guardar").click(function(){
$.ajax({
	"url" : appData.uri_ws + "backend/actualizaubi/",
	"dataType": "json",
	"type" : "post",
	"data" : {
		"id" : appData.idusuario,
		"latitud" : marcador.getPosition().lat(),
		"longitud" : marcador.getPosition().lng()
	}
})
.done(function(obj){
	$("#btn-guardar").prop("disabled",true);
	alert(obj.mensaje );
})
.fail(error_ajax);
});

}); //FIN DEL READY




function iniciomapa() {
	
	if (navigator.geolocation) {

		navigator.geolocation.getCurrentPosition(function(pos){
			centro = {
				lat : pos.coords.latitude,
				lng : pos.coords.longitude
			};

		mapa = new google.maps.Map( 
		document.getElementById("mapa"),
		{
			center : centro,
			zoom : 15
		}
		);

if (typeof marcador === "undefined"){
		 mapa.addListener("click",click_listener);
	}

		});
		
	}
	else{
		alert("danger","Tu navegador no permite geolocalización");
	}
}



function click_listener(e){
	marcador = new google.maps.Marker({
				position : e.latLng,
				map : mapa,
				dragable : false
			});

			marcador.addListener("drag",function(){
				$("#btn-guardar").prop("disabled",true);
			});
			google.maps.event.clearListeners(mapa,"click");
			$("#btn-guardar").prop("disabled",false);
}
